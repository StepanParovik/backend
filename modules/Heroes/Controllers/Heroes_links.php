<?php
namespace Modules\Heroes\Controllers;
use CodeIgniter\Controller;
use Modules\Heroes\Models\M_link_;

/**
 * Контроллер управления связями
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class Heroes_links extends Controller{

    /**
     * Сохранение связи
     */
    public function add_link($smull_bisness_id, $heroes_id){
        $M_link_smallbusiness = new M_link_();
        $data = [
            'heroes_id' => $heroes_id,
            'small_business_entity_id'  => $smull_bisness_id,
        ];
        $small_business_data = $M_link_smallbusiness->savedb($data);
        $response = array('success' => true,
            'small_business_data' => $small_business_data);
        echo json_encode($response);
    }
}
