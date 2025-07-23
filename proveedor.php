<?php
session_start();
if ($_SESSION["usuario_tipo"] !== "proveedor") {
    header("Location: ../login.php");
    exit;
}
echo "<h1>Bienvenido proveedor, " . $_SESSION["usuario_nombre"] . "</h1>";
echo '<a href="../logout.php">Cerrar sesión</a>';