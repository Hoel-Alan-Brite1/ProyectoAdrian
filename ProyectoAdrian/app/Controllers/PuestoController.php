<?php

namespace App\Controllers;

use App\Models\ProductoPuestoModel;
use App\Models\ProductoModel;

class PuestoController extends BaseController
{
    public function index($puesto_id)
    {
        $productoPuestoModel = new ProductoPuestoModel();
        $productos = $productoPuestoModel->where('puesto_id', $puesto_id)->findAll();

        return view('puestos/index', ['productos' => $productos]);
    }

    public function asignarProducto($puesto_id)
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();

        if ($this->request->getMethod() === 'post') {
            $productoPuestoModel = new ProductoPuestoModel();

            $data = [
                'producto_id' => $this->request->getPost('producto_id'),
                'puesto_id'   => $puesto_id,
                'precio_unitario' => $this->request->getPost('precio_unitario'),
                'stock'       => $this->request->getPost('stock'),
            ];

            if ($productoPuestoModel->insert($data)) {
                return redirect()->to("/puestos/$puesto_id")->with('success', 'Producto asignado exitosamente.');
            } else {
                return redirect()->back()->withInput()->with('error', $productoPuestoModel->errors());
            }
        }

        return view('puestos/asignar_producto', ['productos' => $productos]);
    }
}
