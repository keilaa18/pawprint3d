<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: procesar login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
    <nav>
        <ul>
            <li><a href="productos.php">Ver Productos</a></li>
            <li><a href="carrito.php">Mi Carrito</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<main>
    <p>Este es tu panel personal. Desde aquí podés gestionar tus compras.</p>
</main>

<?php include("footer.php"); ?>

</body>
</html>
