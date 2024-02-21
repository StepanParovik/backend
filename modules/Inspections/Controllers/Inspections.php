<?php
namespace Modules\Inspections\Controllers;

use App\Controllers\BaseController;
use Modules\Inspections\Config\Config;
use Modules\Inspections\Models\M_inspections;
use Modules\File\Controllers\File;
use Modules\Rubricators\Controllers\Rubricators;
use Modules\Small_business\Controllers\Small_business;
use Modules\Rubricators\Models\M_rubricators;
use Modules\Inspections\Models\M_link_smallbusiness;
use Modules\Excel\Controllers\Excel;
use CodeIgniter\Database\ConnectionInterface;


/**
 * Контроллер управления письмами
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class Inspections extends BaseController{

    protected $db;

    protected $config;

    /**
     * @param ConnectionInterface $db
     */
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->config = new Config();
    }

    /**
     * Загрузка формы
     * @return string
     */
    public function get_form($data = []){
        helper(['form']);
        $C_Rubricators = new Rubricators();
        $category = 2;
        $data['rubricators'] = $C_Rubricators->list_rubricators($category);
        $data['spinner'] = view('Modules\Templates\Views\spinner');
        return view('Modules\Templates\Views\menu')
            . view('Modules\Inspections\Views\form', $data);
    }

    /**
     * Загрузка таблицы
     *
     * @return string
     */
    public function load_table() {
        $M_Inspections = new M_inspections();
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $total   = (int) $M_Inspections->get_count_active();

        $data = $this->get_row_table();

        $data['table_body'] = view('Modules\Inspections\Views\table_body', $data);
        $data['spinner'] = view('Modules\Templates\Views\spinner');
        return view('Modules\Templates\Views\menu')
            . view ('Modules\Inspections\Views\table_header', $data);
    }

    /**
     * Поиск по таблице
     *
     * @return
     */
    public function table_search(){
        $search = [
            'subject_name' => $this->request->getVar('subject_name'),
            'period_start' => $this->request->getVar('period_start'),
            'period_end' => $this->request->getVar('period_end')
        ];

        $data = $this->get_row_table($search);
        $response = array(
            'success' => true,
            'results' => view('Modules\Inspections\Views\table_body', $data),
            'pagination' => $data['pager']
        );
        echo json_encode($response);
    }

    /**
     * Получение данных таблицы
     *
     * @param array $search
     * @return array
     */
    public function get_row_table(array $search = null) {
        $M_Inspections = new M_inspections();

        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        //TODO Переделать на порлучение в модели
        $total   = (int) $M_Inspections->get_count_active();

        if (!empty($search)) {
            $search = [
                'subject_name' => $this->request->getVar('subject_name'),
                'period_start' => $this->request->getVar('period_start'),
                'period_end' => $this->request->getVar('period_end')
            ];
        }

        return $M_Inspections->getPagination($perPage, $page, $total, $search);
    }

    /**
     * Форма редактирования
     * @return string
     */
    public function edit($uuid)
    {
        $M_Inspections = new M_inspections();
        $data['data'] = $M_Inspections->get_edit($uuid);
        return $this->get_form($data);
    }

    /**
     * @param string $uuid
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete_record(string $uuid)
    {
        $M_Inspections = new M_inspections();
        $M_Inspections->delete($uuid);
        return redirect()->to('/inspections');
    }

    /**
     * Сохранение записи
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function save_form()
    {
        helper(['form', 'url']);

        $files = $this->request->getFiles();
        if ($files['attached'][0]->hasMoved()) {
            $this->validate_data($files);
        }

        $M_Inspections = new M_inspections();
        $id = $this->request->getVar('id');
        $data = [
            'control_body' => $this->request->getVar('control_body'),
            'period_start' => $this->request->getVar('period_start'),
            'period_end' => $this->request->getVar('period_end'),
            'planned_duration' => $this->request->getVar('planned_duration'),
        ];
        $data = esc($data);
        // проверяем редактирование или добавление
        if ($id === '') {
            $M_Inspections->savedb($data);
        } else {
            $M_Inspections->update($id, $data);
        }
        $response = array('success' => true);
        echo json_encode($response);
    }

    /**
     * Валидация данных формы
     * $data массив данных для сохранения в бд
     * @return true|false
     */
    public function validate_data($files)
    {
        helper(['form']);
        $config = config('Modules\Inspections\Config');
        // Проверяем валидацию полей
        if ($this->validate($config->rules)) {
            $C_File = new File();
            // Проверяем валидацию файлов
            if ($C_File->validateFile('attached', $files)) {
                return true;
            }
        } else {
            $response = array('success' => false);
            echo json_encode($response);
            exit();
        }
    }

    public function exportToExcel()
    {
        // Выборка данных из таблицы
        $M_Inspections = new M_inspections();
        $data = $M_Inspections->get_all();
        $data_array = array();
        // преобразовываем обьект в массив (метод вставки fromArray работает только с массивами)
        foreach ($data as $item) {
            $item->period_start = date("d.m.Y");
            $item->period_end = date("d.m.Y");
            $data_array[] = get_object_vars($item);
        }
        $C_Excel = new Excel();

        // Создание Excel-файла
        $writer = $C_Excel->exportToExcel($data_array);
        $filename = date('Ymd_isu'). '_ПереченьПлановыхПроверок' . '.xlsx';
        $writer->save($filename);

        // Отправка файла пользователю
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        readfile($filename);
    }

    public function validateImport($importData){
        $validation = \Config\Services::validation();
        $validation->setRules(config('Modules\Inspections\Config')->rules);
        if (!$validation->run($importData)) {
            return false;
        } else {
            return true;
        }
    }

    public function importFromExcel()
    {
        $uploadedFile = $_FILES['file'];;
        if (!empty($uploadedFile)) {
            $filePath = WRITEPATH . 'uploads/' . $uploadedFile['name'];
            move_uploaded_file($uploadedFile['tmp_name'], $filePath);
            $C_Excel = new Excel();
            $M_link_smallbusiness = new M_link_smallbusiness();
            $M_Inspections = new M_Inspections();
            $M_Rubricators = new M_Rubricators();
            $C_Small_business = new Small_business();
            $counter = 0;

            $sheetData = $C_Excel->importFromExcel($filePath);
            $this->db->transStart();
            // Подготавливаем данные для вставки
            foreach ($sheetData as $row) {
                $counter++;

                // Выполняем импорт с определенного номера строки
                if ($counter >= $this->config->str_num) {
                    //Все поля, кроме planned_duration обязательные
                    if (!is_null($row[0]) || !is_null($row[1]) || !is_null($row[2]) || !is_null($row[3]) || !is_null($row[4]) || !is_null($row[5])) {
                        // Подготовка данных для таблицы субьектов
                        $smallBusinessData = [
                            'subject_name' => $row[0],
                            'inn' => $row[1],
                            'kpp' => $row[2]
                        ];

                        // Подготовка данных для таблицы проверок
                        // Поиск рубрики по названию
                        $rubricatorId = $M_Rubricators->get_id($row[3], 2);
                        $inspectionData = [
                            'period_start' => $row[4],
                            'period_end' => $row[5],
                            'planned_duration' => $row[6],
                            'control_body' => $rubricatorId[0]['id']
                        ];

                        // Валидация и вставка данных в бд
                        if ($this->validateImport($inspectionData) && $C_Small_business->validateImport($smallBusinessData)) {
                            $smallBusinessId = $C_Small_business->save_record($smallBusinessData);
                            $InspectionId = $M_Inspections->savedb($inspectionData);
                            // Вставка данных в таблицу связей
                            $linkData = [
                                'small_business_entity_id' => $smallBusinessId,
                                'inspections_id' => $InspectionId
                            ];
                            $M_link_smallbusiness->savedb($linkData);
                        } else {
                            return false; // вывалить экзепшн, данные не соответствуют требуемому формату
                        }
                    } else {
                        break; // вывалить экзепшн, не все обязательные поля заполнены
                    }
                }
            }
            $this->db-> transComplete();
            // Удаление загруженного файла после импорта
            unlink($filePath);
            return true;
        }
        else {
            return false; // вывалить экзепшн, с самим файлом что-то не то
        }
    }
}
