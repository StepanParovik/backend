<?php
namespace Modules\Inspections\Models;
use CodeIgniter\Model;


/**
 * Модель Плановых проверок
 *
 * @author parovik
 * @copyright (C) 2024 Parovik S.A.
 */
class M_inspections extends Model{

    protected $table = 'inspections';
    protected $primaryKey = 'id'; // Первичный ключ
    protected $allowedFields = ['control_body', 'period_start', 'period_end', 'planned_duration']; // Разрешенные поля для обновления

    /**
     * Сохранение
     * @param $data
     * @param $id
     * @return integer
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

    /**
     * Получение всех проверок
     * @return array|\CodeIgniter\Database\ResultInterface|false|string
     */
    public function get_all()
    {
        $query = $this->db->table('inspections i')
            ->join('rubricators r', 'r.id = i.control_body', 'left')
            ->join('link_inspections_smallbusines lis', 'lis.inspections_id = i.id', 'left')
            ->join('small_business_entity sbe', 'sbe.id = lis.small_business_entity_id', 'left')
            ->where('i.is_del', false)
            ->select('i.id, i.create_date, sbe.subject_name, r.name, i.period_start, i.period_end, i.planned_duration')
            ->get();

        return $query->getResult();
    }

    public function get_edit($uuid)
    {
        $query = $this->db->table('inspections i')
            ->join('rubricators r', 'r.id = i.control_body', 'left')
            ->join('link_inspections_smallbusines lis', 'lis.inspections_id = i.id', 'left')
            ->join('small_business_entity sbe', 'sbe.id = lis.small_business_entity_id', 'left')
            ->where('i.is_del', false)
            ->where('i.id', $uuid)
            ->select('i.id, i.create_date, sbe.subject_name, sbe.inn ,sbe.kpp, r.name, i.period_start, i.period_end, i.planned_duration')
            ->get();

        return $query->getRow();
    }


    public function getPagination(?int $perPage = null, int $page = null, int $total = null, array $search = null): array
    {
        $this->builder()
            ->join('rubricators r', 'r.id = inspections.control_body', 'left')
            ->join('link_inspections_smallbusines lis', 'lis.inspections_id = inspections.id', 'left')
            ->join('small_business_entity sbe', 'sbe.id = lis.small_business_entity_id', 'left')
            ->where('inspections.is_del', false)
            ->select('inspections.id, inspections.create_date, sbe.subject_name, r.name, inspections.period_start, inspections.period_end, inspections.planned_duration');

        if (!empty($search)) {
            if ($search['period_start'] !== '') {
                $this->builder->where('inspections.period_start >=', $search['period_start']);
            }
            if ($search['period_end'] !== '') {
                $this->builder->where('inspections.period_end <=', $search['period_end']);
            }
            if ($search['subject_name'] !== '') {
                $this->builder->like('sbe.subject_name', $search['subject_name']);
            }
        }

        return [
            'data'  => $this->paginate($perPage, 'group1', $page),
            'pager' => $this->pager->makeLinks($page, $perPage, $total),
        ];
    }

    public function get_count_active()
    {
        $count = $this->db->table($this->table)
            ->where('is_del', false)
            ->select('count(*)')
            ->countAllResults();

        return $count;
    }
}