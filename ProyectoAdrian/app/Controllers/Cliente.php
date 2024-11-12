<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Cliente extends BaseController
{
    public function dashboard()
    {
        return view('cliente/dashboard', ['titulo' => 'Panel de Cliente']);
    }
}
