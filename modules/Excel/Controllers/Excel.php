<?php
namespace Modules\Excel\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

/**
 * Контроллер управления письмами
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class Excel extends Controller{

    /**
     * @return Xlsx
     */
    public function exportToExcel($data_array)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Заголовки столбцов
        $sheet->fromArray(array('Ид', 'Дата создания', 'СМП', 'Контролирующий орган', 'Дата начала', 'Дата окончания', 'Плановая длительность'), NULL, 'A1');
        // Данные
        $sheet->fromArray($data_array, NULL, 'A2');

        // Определяем диапазон заголовков таблицы
        $headerRange = 'A1:G1';

        // Устанавливаем стиль для жирного шрифта
        $boldStyle = [
            'font' => [
                'bold' => true,
            ],
        ];

        $sheet->getStyle($headerRange)->applyFromArray($boldStyle);

        // Автоподбор ширины столбцов
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

// Чтобы установить автоподбор высоты строк, необходимо использовать комбинацию autoSize и autoFit
        foreach ($sheet->getRowIterator() as $row) {
            $sheet->getRowDimension($row->getRowIndex())->setRowHeight(-1);
        }
// Устанавливаем границы для всей таблицы
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A1:'.$lastColumn.$lastRow)->applyFromArray($styleArray);
        $writer = new Xlsx($spreadsheet);
        return $writer;

    }

    /**
     * Импорт данных в реестр Heroes
     *
     * @return array
     */
    public function importFromExcel($filePath)
    {

        $spreadsheet = IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        return $sheetData;
    }
}