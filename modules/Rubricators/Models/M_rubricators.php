<?php
namespace Modules\Rubricators\Models;
use CodeIgniter\Model;


/**
 * Модель Рубрикаторов
 *
 * @author parovik
 * @copyright (C) 2024 Parovik S.A.
 */
class M_rubricators extends Model{

    protected $table = 'rubricators';

    /**
     * Получение рубрик по категории
     * @return array
     */
    public function get_rubricators($category)
    {
        $query = $this->db->table('rubricators')
            ->select('*')
            ->where('parant_id', $category)
            ->orderBy('name', 'asc')
            ->get();

        return $query->getResult();
    }

    /**
     * Получение id рубрики по имени и категории (для импорта)
     * @return array
     */
    public function get_id($name, $category): array
    {
        $query = $this->db->table('rubricators')
            ->select('id')
            ->where('name', $name)
            ->where('parant_id', $category)
            ->get();
        return $query->getResult('array');
    }
}