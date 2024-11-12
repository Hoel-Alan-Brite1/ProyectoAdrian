<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Vendedor extends BaseController
{
    public function dashboard()
    {
        return view('vendedor/dashboard', ['titulo' => 'Panel de Vendedor']);
    }
}
