<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$result = $conexion->query("SELECT * FROM perros WHERE usuario_id = $usuario_id");

echo "<h2>Mis perros</h2>";
echo "<a href='perros_crear.php'>Agregar perro</a> | <a href='index.php'>Inicio</a><br><br>";

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Raza</th><th>Edad</th><th>Peso</th><th>Tipo amputación</th><th>Tiempo desde cirugía</th><th>Movilidad</th><th>Candidato</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['raza']) . "</td>";
        echo "<td>" . $row['edad'] . "</td>";
        echo "<td>" . $row['peso'] . "</td>";
        echo "<td>" . htmlspecialchars($row['tipo_amputacion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tiempo_desde_cirugia']) . "</td>";
        echo "<td>" . htmlspecialchars($row['movilidad_actual']) . "</td>";
        echo "<td>" . ($row['es_candidato'] ? 'Sí' : 'No') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No tenés perros cargados.";
}