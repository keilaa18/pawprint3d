<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $raza = $conexion->real_escape_string($_POST['raza']);
    $edad = (int)$_POST['edad'];
    $peso = (float)$_POST['peso'];
    $tipo_amputacion = $conexion->real_escape_string($_POST['tipo_amputacion']);
    $tiempo_desde_cirugia = $conexion->real_escape_string($_POST['tiempo_desde_cirugia']);
    $movilidad_actual = $conexion->real_escape_string($_POST['movilidad_actual']);
    $es_candidato = isset($_POST['es_candidato']) ? 1 : 0;

    $sql = "INSERT INTO perros (usuario_id, nombre, raza, edad, peso, tipo_amputacion, tiempo_desde_cirugia, movilidad_actual, es_candidato) VALUES 
    ($usuario_id, '$nombre', '$raza', $edad, $peso, '$tipo_amputacion', '$tiempo_desde_cirugia', '$movilidad_actual', $es_candidato)";
    if ($conexion->query($sql) === TRUE) {
        echo "Perro agregado correctamente. <a href='perros_listar.php'>Ver perros</a>";
    } else {
        echo "Error: " . $conexion->error;
    }
} else {
?>
<form method="POST" action="">
    Nombre: <input type="text" name="nombre" required><br>
    Raza: <input type="text" name="raza"><br>
    Edad: <input type="number" name="edad" min="0"><br>
    Peso: <input type="number" step="0.01" name="peso"><br>
    Tipo de amputación: <input type="text" name="tipo_amputacion"><br>
    Tiempo desde cirugía: <input type="text" name="tiempo_desde_cirugia"><br>
    Movilidad actual: <textarea name="movilidad_actual"></textarea><br>
    ¿Es candidato? <input type="checkbox" name="es_candidato"><br>
    <button type="submit">Agregar perro</button>
</form>
<?php
}
?>
