<?php
namespace Modules\Inspections\Models;
use CodeIgniter\Model;
use Modules\Small_business\Models\M_Small_business;

/**
 * Модель связи с субьектами малого предпринимательства
 *
 * @author parovik
 * @copyright (C) 2024 Parovik S.A.
 */
class M_link_smallbusiness extends Model{

    protected $table = 'link_inspections_smallbusines';
    protected $primaryKey = 'id'; // Первичный ключ
    protected $allowedFields = ['inspections_id','small_business_entity_id']; // Разрешенные поля для обновления

    /**
     * Сохранение
     * @param $data
     * @param $id
     * @return array|\CodeIgniter\row_array|\CodeIgniter\row_array[]|int|object|object[]
     */
    public function savedb($data, $id = 0)
    {
        $this->db->table($this->table)->insert($data);
        $M_Small_business = new M_Small_business;
        return $M_Small_business->find($data['small_business_entity_id']);
    }
}