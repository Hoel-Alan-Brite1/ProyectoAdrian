<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'username', 
        'password', 
        'nombre', 
        'apellido1', 
        'apellido2', 
        'correo', 
        'celular', 
        'rol', 
        'habilitado', 
        'fecha_creacion', 
        'fecha_actualizacion'
    ];
    protected $returnType = 'array';

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
