<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Mercadito Friki</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Mercadito Friki</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('newlogin'); ?>">Iniciar Sesión</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h2>Productos</h2>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <label for="tienda">Tienda</label>
            <select id="tienda" class="form-control" onchange="filtrarProductos()">
                <option value="">Todas las tiendas</option>
                <?php foreach ($tiendas as $tienda): ?>
                    <option value="<?= esc($tienda->tienda); ?>"><?= esc($tienda->tienda); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="categoria">Categoría</label>
            <select id="categoria" class="form-control" onchange="filtrarProductos()">
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= esc($categoria->nombre_categoria); ?>"><?= esc($categoria->nombre_categoria); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Productos -->
    <div class="row" id="productos-container">
        <?php foreach ($productos as $producto): ?>
            <div class="col-md-4 producto-item" data-tienda="<?= esc($producto->tienda); ?>" data-categoria="<?= esc($producto->categoria); ?>">
                <div class="card mb-4">
                    <img src="<?= base_url('uploads/' . esc($producto->imagen)); ?>" class="card-img-top" alt="<?= esc($producto->nombre_producto); ?>" style="height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($producto->nombre_producto); ?></h5>
                        <p class="card-text"><?= esc($producto->descripcion); ?></p>
                        <p class="card-text"><strong>Precio:</strong> <?= esc($producto->precio_unitario); ?> Bs</p>
                        <p class="card-text"><strong>Tienda:</strong> <?= esc($producto->tienda); ?></p>
                        <p class="card-text"><strong>Stock:</strong> <?= esc($producto->stock); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function filtrarProductos() {
    var tiendaSeleccionada = document.getElementById('tienda').value.toLowerCase();
    var categoriaSeleccionada = document.getElementById('categoria').value.toLowerCase();
    var productos = document.getElementsByClassName('producto-item');

    Array.from(productos).forEach(function(producto) {
        var tiendaProducto = producto.getAttribute('data-tienda').toLowerCase();
        var categoriaProducto = producto.getAttribute('data-categoria').toLowerCase();

        producto.style.display = 
            (tiendaSeleccionada === "" || tiendaProducto.includes(tiendaSeleccionada)) &&
            (categoriaSeleccionada === "" || categoriaProducto.includes(categoriaSeleccionada))
            ? "block" : "none";
    });
}
</script>

</body>
</html>
