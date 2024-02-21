<?php
namespace Modules\Rubricators\Controllers;

use CodeIgniter\Controller;
use Modules\Rubricators\Models\M_rubricators;

/**
 * Контроллер рубрикаторов
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class Rubricators extends Controller{
    /**
     * Получение списка рубрик по категории
     * @return array
     */
    public function list_rubricators($category){
        $M_rubricators = new M_rubricators();
        $list[] = $M_rubricators->get_rubricators($category);
        return $list;
    }
}