<?php

namespace App\Controllers;

use App\Models\UserModel;

class Registro extends BaseController
{
    public function index()
    {
        return view('registro');
    }

    public function guardar()
    {
        $userModel = new UserModel();

        $data = [
            'username'   => $this->request->getPost('username'),
            'password'   => $this->request->getPost('password'),
            'nombre'     => $this->request->getPost('nombre'),
            'apellido1'  => $this->request->getPost('apellido1'),
            'apellido2'  => $this->request->getPost('apellido2'),
            'correo'     => $this->request->getPost('correo'),
            'celular'    => $this->request->getPost('celular'),
            'rol'        => 'cliente', // Valor predeterminado
            'habilitado' => 1
        ];

        if ($userModel->registerUser($data)) {
            return redirect()->to('/registro')->with('mensaje', 'Usuario registrado exitosamente.');
        } else {
            return redirect()->to('/registro')->with('mensaje', 'Error en el registro.');
        }
    }
}
