<?php
namespace Modules\Auth\Controllers;
use CodeIgniter\Controller;
use Modules\User\models\M_user;


/**
 * Контроллер управления авторизацией
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class Auth extends Controller{
    /**
     * Отображение страницы авторизации
     * @return void
     */
    public function index()
    {
        helper(['form']);
        echo view('Modules\Auth\Views\auth');
    }


    /**
     *
     * Вход в систему
     * @param array $formData [
     *  string login;
     *  string password
     * ]
     * @return bool
     */
    public function loginAuth(array $formData): bool
    {
        $session = session();
        $M_user = new M_user;
        $login = $formData['login'];
        $password = $formData['password'];

        $data = $M_user->where('login', $login)->first();
        if($data){
            $pass = $data['password'];
            $auth_password = password_verify($password,$pass);
            if($auth_password){
                $ses_data = [
                    'id' => $data['id'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'patronymic' => $data['patronymic'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return true;
            }else{
                $session->setFlashdata('msg','Не верный пароль');
                return false;
            }
        }else{
            $session->setFlashdata('msg','Не верный логин');
            return false;
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}