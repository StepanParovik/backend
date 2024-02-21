<?php

namespace Modules\Inspections\Config;

use CodeIgniter\Config\BaseConfig;

class Config extends BaseConfig
{
    // Правила валидации
    public array $rules = [
        'control_body' => 'required|integer',
        'period_start' => 'required|valid_date',
        'period_end' => 'required|valid_date',
        'planned_duration' => 'min_length[2]|max_length[5000]',
    ];

    // Номер строки, с которой начинается импорт записей
    public int $str_num = 2;
}