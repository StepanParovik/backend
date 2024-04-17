<?php

namespace Modules\main\Controllers;

use CodeIgniter\RESTful\ResourceController;


/**
 * Контроллер настроек приложения
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class MainController extends ResourceController{

    /**
     * Получение базовых настроек приложения
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index()
    {
        return  $this->respond(lang('main.main'));
    }
}