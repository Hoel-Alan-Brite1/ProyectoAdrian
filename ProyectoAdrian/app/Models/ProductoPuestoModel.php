<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoPuestoModel extends Model
{
    protected $table = 'productos_puestos';
    protected $primaryKey = 'id_producto_puesto';
    protected $allowedFields = ['producto_id', 'puesto_id', 'stock', 'precio_unitario', 'habilitado', 'fecha_creacion', 'fecha_actualizacion'];

    public function getProductosConDetalles()
    {
        return $this->select('productos_puestos.*, productos.nombre_producto, productos.descripcion, categorias.nombre_categoria AS categoria, puestos.nombre_puesto AS tienda, productos.imagen')
            ->join('productos', 'productos_puestos.producto_id = productos.id_producto')
            ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
            ->join('puestos', 'productos_puestos.puesto_id = puestos.id_puesto')
            ->where('productos_puestos.habilitado', 1)
            ->get() // Usa get() para devolver el resultado
            ->getResult(); // Devuelve como objetos
    }

    public function getDistinctCategorias()
    {
        return $this->db->table('categorias')
            ->select('id_categoria, nombre_categoria')
            ->get()
            ->getResult();
    }

    public function getDistinctTiendas()
    {
        return $this->db->table('puestos')
            ->select('nombre_puesto AS tienda')
            ->distinct()
            ->get()
            ->getResult();
    }
}
