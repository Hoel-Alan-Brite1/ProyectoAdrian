<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        helper(['form', 'url']);

        if ($this->request->getMethod() === 'post') {
            $session = session();
            $model = new UserModel();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $model->where('username', $username)->first();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $sessionData = [
                        'id_usuario' => $user['id_usuario'],
                        'username'   => $user['username'],
                        'rol'        => $user['rol'],
                        'logged_in'  => true,
                    ];
                    $session->set($sessionData);

                    // Redirigir según el rol
                    switch ($user['rol']) {
                        case 'administrador':
                            return redirect()->to('/admin/dashboard');
                        case 'vendedor':
                            return redirect()->to('/vendedor/dashboard');
                        case 'cliente':
                            return redirect()->to('/cliente/dashboard');
                        default:
                            $session->setFlashdata('error', 'Rol no reconocido.');
                            return redirect()->to('auth/login');
                    }
                } else {
                    $session->setFlashdata('error', 'Contraseña incorrecta.');
                    return redirect()->to('auth/login');
                }
            } else {
                $session->setFlashdata('error', 'Usuario no encontrado.');
                return redirect()->to('auth/login');
            }
        }
        return view('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
