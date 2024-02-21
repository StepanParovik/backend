<?php
namespace Modules\User\Controllers;
use CodeIgniter\Controller;
use Modules\User\Models\M_user;


/**
 * Контроллер управления пользователями
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class User extends Controller{
    /**
     * Отображение формы добавления
     * @return string
     */
    public function index(){
        helper(['form']);
        $data = [];
        return view('Modules\Templates\Views\menu')
        . view('Modules\User\Views\сreateuser', $data);
    }

    /**
     * Валидация формы добавления
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    public function validate_data(){
        helper(['form']);
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name'  => 'required|min_length[2]|max_length[50]',
            'patronymic' => 'required|min_length[2]|max_length[50]',
            'login'      => 'required|min_length[2]|max_length[50]',
            'password'   => 'required|min_length[4]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ];

        if($this->validate($rules)){
            $M_user = new M_user();
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name'  => $this->request->getVar('last_name'),
                'patronymic' => $this->request->getVar('patronymic'),
                'login'      => $this->request->getVar('login'),
                'password'   => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $M_user->savedb($data);
            return redirect()->to('/user');
        }else{
            $data['validation'] = $this->validator;
            echo view('Modules\User\Views\сreateuser', $data);
        }
    }

    /**
     * Получение и вывод списка пользователей
     * @return string
     */
    public function list_users(){
        $M_user = new M_user();
        $data['user'] = $M_user->getUsers();
        return view('Modules\Templates\Views\menu')
        . view ('Modules\User\Views\users', $data);
    }
}
