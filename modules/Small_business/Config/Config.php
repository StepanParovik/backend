<?php

namespace Modules\Small_business\Config;

use CodeIgniter\Config\BaseConfig;

class Config extends BaseConfig
{
    // Правила валидации
    public array $rules = [
        'subject_name' => 'required|min_length[2]|max_length[255]',
        'inn' => 'required|min_length[8]|max_length[11]|integer',
        'kpp' => 'required|min_length[10]|max_length[10]|integer',
    ];
}