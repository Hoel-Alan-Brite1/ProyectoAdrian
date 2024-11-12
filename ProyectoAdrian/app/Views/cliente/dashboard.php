<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1><?= esc($titulo); ?></h1>
        <p>Bienvenido al Panel de Cliente.</p>
        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</body>
</html>
