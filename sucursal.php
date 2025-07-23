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
//extraer datos del formulario
$direccion = $_POST['direccion'];
$contacto = $_POST['contacto'];
$encargado = $_POST['encargado'];

// Verificar si la dirección ya está registrada
$verificar_direccion_sql = "SELECT * FROM sucursales WHERE `direccion-sucursal` = '$direccion'";
$verificar_direccion_query = mysqli_query($conexion, $verificar_direccion_sql);

if (mysqli_num_rows($verificar_direccion_query) > 0) {
    // La dirección ya está registrada, mostrar mensaje de error y detener el script
    die("La dirección ya está registrada en otra sucursal");
}