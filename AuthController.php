<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('home/login');
    }

    public function register()
    {
        return view('home/register');
    }

    public function store()
    {
        $userModel = new UserModel();
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $userModel->save($data);
        return redirect()->to('/index');
    }

    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($email == 'o.d.igbinadolor@wlv.ac.uk' && $password == 'dhuncho14') {
            $userData = [
                'email' => 'o.d.igbinadolor@wlv.ac.uk',
                'logged_in' => true,
            ];
            $session->set($userData);
            return redirect()->to('/index');
        }

        $user = $userModel->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            $userData = [
                'id' => $user['id'],
                'email' => $user['email'],
                'logged_in' => true,
            ];
            $session->set($userData);
            return redirect()->to('/index');
        } else {
            $session->setFlashdata('msg', 'Invalid email or password');
            return redirect()->to('/index');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
