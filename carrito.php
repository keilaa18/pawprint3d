<?php
session_start();
require 'CONEXION.PHP';

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $id = $_POST['id'];

    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = 1;
    } else {
        $_SESSION['carrito'][$id]++;
    }
}

// Eliminar producto del carrito
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    unset($_SESSION['carrito'][$id]);
}

// Obtener productos del carrito
$productos = [];
$total = 0;

if (!empty($_SESSION['carrito'])) {
    $ids = implode(',', array_keys($_SESSION['carrito']));
    $sql = "SELECT * FROM productos WHERE id IN ($ids)";
    $result = $conn->query($sql);

    while ($fila = $result->fetch_assoc()) {
        $id = $fila['id'];
        $cantidad = $_SESSION['carrito'][$id];
        $fila['cantidad'] = $cantidad;
        $fila['subtotal'] = $cantidad * $fila['precio'];
        $productos[] = $fila;
        $total += $fila['subtotal'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1>Tu Carrito</h1>
    <nav>
        <ul>
            <li><a href="productos.php">Volver a Productos</a></li>
        </ul>
    </nav>
</header>

<main>
    <?php if ($productos): ?>
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                    <td><?php echo $p['cantidad']; ?></td>
                    <td>$<?php echo number_format($p['subtotal'], 2); ?></td>
                    <td><a href="carrito.php?eliminar=<?php echo $p['id']; ?>">Eliminar</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><strong>Total: $<?php echo number_format($total, 2); ?></strong></p>
        <button onclick="alert('Compra finalizada. ¡Gracias!')">Finalizar Compra</button>
    <?php else: ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>
</main>

<?php include("footer.php"); ?>

</body>
</html>
