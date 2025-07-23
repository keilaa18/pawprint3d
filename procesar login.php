<?php
<?php
session_start();
require 'CONEXION.PHP';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);

    if ($usuario && $clave) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($clave, $fila['clave'])) {
                $_SESSION['usuario'] = $fila['usuario'];

                // 👇 Registro del inicio de sesión
                $sql_log = "INSERT INTO logins (usuario) VALUES (?)";
                $stmt_log = $conn->prepare($sql_log);
                $stmt_log->bind_param("s", $usuario);
                $stmt_log->execute();
                $stmt_log->close();

                header("Location: panel cliente.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
?>
<form method="POST" action="procesar login.php">
    <h2>Iniciar Sesión</h2>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="clave" placeholder="Contraseña" required><br>
    <button type="submit">Entrar</button>
</form>
<?php } ?>
