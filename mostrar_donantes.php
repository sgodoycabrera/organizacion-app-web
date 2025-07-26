<?php
include("conexion.php");

echo "<h1>📁 Lista de Donantes</h1>";

$sql = "SELECT * FROM DONANTE";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  echo "<table border='1' cellpadding='10'>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Teléfono</th>
          </tr>";

  while ($row = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id_donante']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['email']}</td>
            <td>{$row['direccion']}</td>
            <td>{$row['telefono']}</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "<p>No hay donantes registrados.</p>";
}

echo "<br><a href='index.php'>⬅️ Volver al inicio</a>";
?>
