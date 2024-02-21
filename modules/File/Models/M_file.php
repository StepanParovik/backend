<?php
namespace Modules\File\Models;
use CodeIgniter\Model;


/**
 * Модель файлов
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class M_file extends Model{
    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email_id', 'filename', 'updated_at'];

    /**
     * Сохранение
     * @param $data
     * @param $id
     * @return integer
     */
    public function savedb($data)
    {
        $this->db->table('files')->insert($data);
        return true;
    }

    /**
     * Получение файлов
     * @return array
     */
    public function getFile($id_card)
    {

    }
}