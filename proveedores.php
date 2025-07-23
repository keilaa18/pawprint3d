<?php
//Conexión a la base de datos 
$servidor = "localhost";
$bd = "swift-bites";
$user = "root";
$pass = "";
$conexion = mysqli_connect($servidor, $user, $pass, $bd);
//crear conexion
if ($conexion === false) {
    die("Error de conexión: " . mysqli_connect_error());
}
//extraer datos del formulario html
$categoria = $_POST['categoria'];
$contacto = $_POST['contacto'];
$jefe = $_POST['jefe'];

// Verificar si la categoría ya está registrada
$verificar_categoria_sql = "SELECT * FROM proovedores WHERE `cate-proovedor` = '$categoria'";
$verificar_categoria_query = mysqli_query($conexion, $verificar_categoria_sql);

if (mysqli_num_rows($verificar_categoria_query) > 0) {
    // La categoría ya está registrada, mostrar mensaje de error y salir
    die("La categoría ya está registrada.");
}
