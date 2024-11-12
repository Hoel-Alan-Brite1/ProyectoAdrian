<?php
$mysqli = new mysqli("localhost", "root", "", "projectfinal");

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}
?>
