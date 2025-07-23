<?php
// CONEXION.PHP
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "proyecto";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer codificación
$conn->set_charset("utf8");
?>
