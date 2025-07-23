<?php
session_start();

// Conexión a la base de datos
$servidor = "localhost";
$bd = "tienda_protesis";
$user = "root";
$pass = "";
$conexion = mysqli_connect($servidor, $user, $pass, $bd);

if ($conexion === false) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si es login de usuario con usuario y password
    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        $usuario = $conexion->real_escape_string($_POST['usuario']);
        $password = $_POST['password'];

        // Asumo que en la tabla 'usuarios' el campo usuario es 'email' o 'nombre'?
        // Cambia 'email' por 'nombre' si corresponde
        $sql = "SELECT id, contraseña, nombre FROM usuarios WHERE email='$usuario' AND estado='activo'";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['contraseña'])) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombre'] = $user['nombre'];
                header("Location: index.php");
                exit();
            } else {
                echo "⚠ Contraseña incorrecta.";
            }
        } else {
            echo "⚠ Usuario no encontrado o bloqueado.";
        }

    // Verificar si es login de encargado con DNI y acceso
    } elseif (!empty($_POST['dni']) && !empty($_POST['acceso'])) {
        $dni = $conexion->real_escape_string($_POST['dni']);
        $acceso = $conexion->real_escape_string($_POST['acceso']);

        $sql = "SELECT * FROM encargados WHERE dni_encargado='$dni' AND acceso_encargado='$acceso'";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) === 1) {
            $_SESSION['encargado_dni'] = $dni;
            header("Location: lobby.html");
            exit();
        } else {
            echo "⚠ DNI o clave de acceso incorrectos.";
        }
    } else {
        echo "⚠ Por favor completá todos los campos.";
    }
} else {
?>

<!-- Formulario de Login Unificado -->
<h2>Iniciar Sesión</h2>

<form method="POST" action="">
    <h3>Login de Usuario</h3>
    Usuario (email): <input type="text" name="usuario"><br>
    Contraseña: <input type="password" name="password"><br>

    <h3>Login de Encargado</h3>
    DNI: <input type="text" name="dni"><br>
    Clave de acceso: <input type="text" name="acceso"><br>

    <br><button type="submit">Ingresar</button>
</form>

<?php
}
?>