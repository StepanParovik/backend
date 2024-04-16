<?php

namespace Modules\main\Controllers;

use App\Controllers\BaseController;


/**
 * Контроллер настроек приложения
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class MainController  extends BaseController{

    /**
     * Получение базовых настроек приложения
     * @return array
     */
    public function index(): array
    {
        return  lang('ru');
    }
}