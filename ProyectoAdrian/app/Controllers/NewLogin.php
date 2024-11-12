<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class NewLogin extends Controller
{
    public function index()
    {
        helper(['form', 'url']);
        return view('new_login');
    }

    public function process()
    {
        $session = session();
        $model = new LoginModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->getUserByUsername($username);

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
                        return redirect()->to('newlogin/index');
                }
            } else {
                $session->setFlashdata('error', 'Contraseña incorrecta.');
                return redirect()->to('newlogin/index');
            }
        } else {
            $session->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to('newlogin/index');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
