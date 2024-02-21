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
     * Вход в систему
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function loginAuth(){
        $session = session();
        $M_user = new M_user;
        $login = $this->request->getVar('login');
        $password = $this->request->getVar('password');

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
                return redirect()->to('/user');
            }else{
                $session->setFlashdata('msg','Не верный пароль');
                return redirect()->to('auth');
            }
        }else{
            $session->setFlashdata('msg','Не верный логин');
            return redirect()->to('auth');
        }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}