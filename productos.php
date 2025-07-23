<?php
require 'CONEXION.PHP';

$sql = "SELECT id, nombre, descripcion, precio, imagen FROM productos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1>Productos Disponibles</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="carrito.php">Ver Carrito</a></li>
        </ul>
    </nav>
</header>

<main class="productos">
    <?php while ($fila = $resultado->fetch_assoc()): ?>
        <div class="producto">
            <img src="images/<?php echo htmlspecialchars($fila['imagen']); ?>" alt="">
            <h2><?php echo htmlspecialchars($fila['nombre']); ?></h2>
            <p><?php echo htmlspecialchars($fila['descripcion']); ?></p>
            <p>Precio: $<?php echo number_format($fila['precio'], 2); ?></p>
            <form method="POST" action="carrito.php">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <button type="submit" name="agregar">Agregar al carrito</button>
            </form>
        </div>
    <?php endwhile; ?>
</main>

<?php include("footer.php"); ?>

</body>
</html>
