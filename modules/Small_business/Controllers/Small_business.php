<?php
namespace Modules\Small_business\Controllers;

use App\Controllers\BaseController;
use Modules\Small_business\Models\M_Small_business;

/**
 * Контроллер управления письмами
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class Small_business extends BaseController{
    /**
     * Форма добавления
     * @return string
     */
    public function get_form($data = []){
        helper(['form']);
        return view('Modules\Templates\Views\menu')
            . view('Modules\Small_business\Views\form', $data);
    }

    /**
     * Отображение таблицы
     * @param $link
     * @return string
     */
    public function get_table($heroes_id = null){
        $M_Small_business = new M_Small_business();
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $total   = (int) $M_Small_business->get_count_active();
        // Получение данных для текущей страницы
        $data['data'] = $M_Small_business->paginate($perPage, 'group1', $page);
        $data['pager'] = $M_Small_business->pager->makeLinks($page, $perPage, $total);
        $data['heroes_id'] = $heroes_id;

        if(!is_null($heroes_id)){
            return view ('Modules\Small_business\Views\table', $data);
        }else{
            return view('Modules\Templates\Views\menu')
                . view ('Modules\Small_business\Views\table', $data);
        }
    }


    /**
     * @param $uuid
     * @return string
     */
    public function edit($uuid)
    {
        $M_Small_business = new M_Small_business();
        $data['data'] = $M_Small_business->find($uuid);
        return $this->get_form($data);
    }


    /**
     * @param string $uuid
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete_record(string $uuid)
    {
        $M_Small_business = new M_Small_business();
        $M_Small_business->delete($uuid);
        return redirect()->to('/small_business');
    }

    /**
     * Сохранение данных с формы
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function save_form()
    {
        helper(['form', 'url']);

        $data = [
            'subject_name' => $this->request->getVar('subject_name'),
            'inn'  => $this->request->getVar('inn'),
            'kpp' => $this->request->getVar('kpp'),
        ];

        // Проверяем валидацию
        //if($this->validate(config('Modules\Small_business\Config\Config')->rules)){
            $id = $this->request->getVar('id');

            // Проверяем редактирование или добавление
            if ($id === ""){
                $uuid = $this->save_record($data);
            }
            else{
                $M_Small_business = new M_Small_business();
                $M_Small_business->update($id, $data);
            }
        //}

        $response = array('success' => true);
        echo json_encode($response);
    }

    /**
     * @param $data
     * @return string
     */
    public function save_record($data){
        $M_Small_business = new M_Small_business();
        return $M_Small_business->savedb($data);
    }

    /**
     * @param array $importData
     * @return bool|void
     */
    public function validateImport(array $importData){
        $validation = \Config\Services::validation();
        $validation->reset();
        $validation->setRules(config('Modules\Small_business\Config')->rules);
        if (!$validation->run($importData)) {
            return false;
        } else {
            return true;
        }
    }
}
