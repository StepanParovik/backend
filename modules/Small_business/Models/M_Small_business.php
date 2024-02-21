<?php
namespace Modules\Small_business\Models;
use CodeIgniter\Model;


/**
 * Модель Плановых проверок
 *
 * @author parovik
 * @copyright (C) 2024 Parovik S.A.
 */
class M_Small_business extends Model{

    protected $table = 'small_business_entity';
    protected $primaryKey = 'id'; // Первичный ключ
    protected $allowedFields = ['subject_name', 'inn', 'kpp', 'is_del']; // Разрешенные поля для обновления

    /**
     * Сохранение
     * @param $data
     * @return string
     */
    public function savedb($data)
    {
        $this->db->table($this->table)->insert($data);
        $query = $this->db->table($this->table)
            ->orderBy('create_date', 'DESC')
            ->limit(1)
            ->select('id')
            ->get();
        $row = $query->getRow();
        // Возвращаем значение UUID
        return $row->id;
    }

    public function get_count_active()
    {
        $count = $this->db->table('small_business_entity')
            ->where('is_del', false)
            ->select('count(*)')
            ->countAllResults();

        return $count;
    }
}