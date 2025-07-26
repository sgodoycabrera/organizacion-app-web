<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $email = $_POST["email"];
  $direccion = $_POST["direccion"];
  $telefono = $_POST["telefono"];

  $sql = "INSERT INTO DONANTE (nombre, email, direccion, telefono)
          VALUES (?, ?, ?, ?)";

  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("ssss", $nombre, $email, $direccion, $telefono);

  if ($stmt->execute()) {
    echo "✅ Donante registrado correctamente.<br><a href='registrar.html'>Volver</a>";
  } else {
    echo "❌ Error: " . $stmt->error;
  }

  $stmt->close();
}
?>
