<?php
namespace Modules\Inspections\Controllers;
use CodeIgniter\Controller;
use Modules\Inspections\Models\M_link_smallbusiness;

/**
 * Контроллер управления связями
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class Inspections_links extends Controller{

    /**
     * Сохранение связи
     */
    public function add_link($smull_bisness_id, $inspections_id){
        $M_link_smallbusiness = new M_link_smallbusiness();
        $data = [
            'inspections_id' => $inspections_id,
            'small_business_entity_id'  => $smull_bisness_id,
        ];
        $small_business_data = $M_link_smallbusiness->savedb($data);
        $response = array('success' => true,
            'small_business_data' => $small_business_data);
        echo json_encode($response);
    }
}
