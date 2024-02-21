<?php
namespace Modules\User\Models;
use CodeIgniter\Model;


/**
 * Модель пользователей
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class M_user extends Model{
    protected $table = 'users';

    /**
     * Сохранение информации о пользователе
     * @param $data
     * @param $id
     * @return int
     */
    public function savedb($data, $id = 0)
    {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('users', $data);
        } else {
            $this->db->table('users')->insert($data);
        }
        return $id;
    }

    /**
     * Получение списка пользователей
     * @return array
     */
    public function getUsers()
    {
        return $this->findAll();
    }
}