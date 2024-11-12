<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PuestoModel;

class AdminController extends BaseController
{
    public function index()
    {
        $puestoModel = new PuestoModel();
        $puestos = $puestoModel->where('administrador_id', session()->get('user')['id_usuario'])->findAll();

        return view('admin/index', ['puestos' => $puestos]);
    }

    public function crearVendedor()
    {
        if ($this->request->getMethod() === 'post') {
            $usuarioModel = new UsuarioModel();

            $data = [
                'username'   => $this->request->getPost('username'),
                'password'   => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'nombre'     => $this->request->getPost('nombre'),
                'apellido1'  => $this->request->getPost('apellido1'),
                'correo'     => $this->request->getPost('correo'),
                'celular'    => $this->request->getPost('celular'),
                'rol'        => 'vendedor',
            ];

            if ($usuarioModel->insert($data)) {
                return redirect()->to('/admin')->with('success', 'Vendedor creado exitosamente.');
            } else {
                return redirect()->back()->withInput()->with('error', $usuarioModel->errors());
            }
        }

        return view('admin/crear_vendedor');
    }

    public function crearPuesto()
    {
        if ($this->request->getMethod() === 'post') {
            $puestoModel = new PuestoModel();

            $data = [
                'nombre_puesto'    => $this->request->getPost('nombre_puesto'),
                'descripcion'      => $this->request->getPost('descripcion'),
                'administrador_id' => session()->get('user')['id_usuario'],
            ];

            if ($puestoModel->insert($data)) {
                return redirect()->to('/admin')->with('success', 'Puesto creado exitosamente.');
            } else {
                return redirect()->back()->withInput()->with('error', $puestoModel->errors());
            }
        }

        return view('admin/crear_puesto');
    }
}
