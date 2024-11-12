<?php

namespace App\Controllers;

use App\Models\ProductoPuestoModel;

class Home extends BaseController
{
    protected $productoPuestoModel;

    public function __construct()
    {
        $this->productoPuestoModel = new ProductoPuestoModel();
    }

    public function index()
    {
        $data['productos'] = $this->productoPuestoModel->getProductosConDetalles();
        $data['categorias'] = $this->productoPuestoModel->getDistinctCategorias();
        $data['tiendas'] = $this->productoPuestoModel->getDistinctTiendas();

        return view('home', $data);
    }
}
