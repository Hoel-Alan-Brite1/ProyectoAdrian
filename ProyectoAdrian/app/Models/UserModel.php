<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios'; // Tabla actualizada según la nueva BD
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

    public function registerUser($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT); // Hash de contraseña
        return $this->insert($data);
    }
}
