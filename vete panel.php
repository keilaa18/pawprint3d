<?php
session_start();
if ($_SESSION["usuario_tipo"] !== "veterinario") {
    header("Location: ../login.php");
    exit;
}
echo "<h1>Bienvenido veterinario, " . $_SESSION["usuario_nombre"] . "</h1>";
echo '<a href="../logout.php">Cerrar sesión</a>';
// Simulación de datos del veterinario (puedes traer esto de la base de datos)
$veterinario = [
    "nombre" => $_SESSION["usuario_nombre"],
    "email" => "veterinario@example.com",
    "especialidad" => "Traumatología Animal",
    "matricula" => "VT123456"
];

// Simulación de mascotas (ideal traer de la BD según la clínica)
$mascotas = [
    ["id" => 1, "nombre" => "Luna", "especie" => "Perro"],
    ["id" => 2, "nombre" => "Milo", "especie" => "Gato"],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Veterinario</title>
  <style>
   body {
  font-family: 'Poppins', sans-serif;
  background: #fff8f1;
  margin: 0;
  padding: 0;
  color: #000;
}

.container {
  max-width: 1000px;
  margin: 30px auto;
  padding: 20px;
  background: #ffffff;
  box-shadow: 0 0 10px rgba(0,0,0,0.08);
  border-radius: 15px;
}

.perfil {
  border-bottom: 2px solid #ffb980;
  padding-bottom: 15px;
  margin-bottom: 20px;
}

.perfil h2 {
  margin: 0;
  color: #ff914d;
}

.formulario {
  margin-top: 20px;
}

.formulario label {
  display: block;
  margin-top: 10px;
  font-weight: 600;
  color: #333;
}

.formulario input,
.formulario textarea,
.formulario select {
  width: 100%;
  padding: 10px 12px;
  margin-top: 4px;
  border: 2px solid #ffb980;
  border-radius: 10px;
  font-size: 16px;
  background-color: #fffaf3;
  transition: border-color 0.3s ease;
}

.formulario input:focus,
.formulario textarea:focus,
.formulario select:focus {
  outline: none;
  border-color: #ff914d;
  background-color: #fff2e5;
}

.formulario button {
  margin-top: 20px;
  padding: 12px 18px;
  background-color: #ff914d;
  color: white;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.formulario button:hover {
  background-color: #e07a2f;
}

.logout {
  float: right;
  margin-top: -50px;
  color: #ff914d;
  font-weight: bold;
  text-decoration: none;
}

.logout:hover {
  color: #e07a2f;
  text-decoration: underline;
}
</style>
</head>
<body>
  <div class="container">
    <div class="logout">
      <a href="../logout.php">Cerrar sesión</a>
    </div>

    <div class="perfil">
      <h2>Bienvenido Dr. <?= htmlspecialchars($veterinario['nombre']) ?></h2>
      <p><strong>Email:</strong> <?= $veterinario['email'] ?></p>
      <p><strong>Especialidad:</strong> <?= $veterinario['especialidad'] ?></p>
      <p><strong>Matrícula:</strong> <?= $veterinario['matricula'] ?></p>
    </div>

    <div class="formulario">
      <h3>Evaluar Mascota</h3>
      <form method="POST" action="guardar_evaluacion.php">
        <label for="mascota">Seleccionar mascota</label>
        <select name="mascota_id" id="mascota" required>
          <option value="">-- Selecciona --</option>
          <?php foreach ($mascotas as $mascota): ?>
            <option value="<?= $mascota['id'] ?>"><?= $mascota['nombre'] ?> (<?= $mascota['especie'] ?>)</option>
          <?php endforeach; ?>
        </select>

        <label for="medidas">Medidas</label>
        <textarea name="medidas" id="medidas" rows="3" placeholder="Ej: Largo del muñón, circunferencia..." required></textarea>

        <label for="observaciones">Observaciones clínicas</label>
        <textarea name="observaciones" id="observaciones" rows="4" placeholder="Ej: Estado de salud general, recomendaciones..." required></textarea>

        <label for="apto">¿Apto para prótesis?</label>
        <select name="apto" id="apto" required>
          <option value="">-- Selecciona --</option>
          <option value="sí">Sí</option>
          <option value="no">No</option>
        </select>

        <button type="submit">Guardar evaluación</button>
      </form>
    </div>
  </div>
</body>
</html>
