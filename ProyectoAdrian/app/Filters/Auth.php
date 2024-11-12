<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión primero.');
        }

        if ($arguments && !in_array($session->get('rol'), $arguments)) {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado para tu rol.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after
    }
}
