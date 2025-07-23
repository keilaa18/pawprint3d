<?php
require 'CONEXION.PHP';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $correo = trim($_POST['correo']);
    $clave = trim($_POST['clave']);

    if ($usuario && $correo && $clave) {
        $claveHash = password_hash($clave, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (usuario, correo, clave) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $usuario, $correo, $claveHash);

        if ($stmt->execute()) {
            echo "Registro exitoso. <a href='index.php'>Ir al inicio</a>";
        } else {
            echo "Error al registrar: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
?>
<form method="POST" action="registro.php">
    <h2>Registro</h2>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="email" name="correo" placeholder="Correo" required><br>
    <input type="password" name="clave" placeholder="Contraseña" required><br>
    <button type="submit">Registrarse</button>
</form>
<?php } ?>
