<?php
namespace Modules\File\Config;

use CodeIgniter\Config\BaseConfig;

class Config extends BaseConfig
{

    public $max_upload_size = 10240;
    public $allowed_types = 'gif|jpg|jpeg|png|webp|pdf|doc|docx';
    public $mime_in_upload =',image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';
}