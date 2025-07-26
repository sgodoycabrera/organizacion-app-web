<?php
include("conexion.php");

echo "<h1>Listado de Donaciones</h1>";

$sql = "
SELECT d.id_donacion, d.monto, d.fecha, p.nombre AS proyecto, don.nombre AS donante
FROM DONACION d
JOIN PROYECTO p ON d.id_proyecto = p.id_proyecto
JOIN DONANTE don ON d.id_donante = don.id_donante
ORDER BY d.fecha DESC
";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Monto (CLP)</th><th>Fecha</th><th>Proyecto</th><th>Donante</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_donacion']}</td>
                <td>{$row['monto']}</td>
                <td>{$row['fecha']}</td>
                <td>{$row['proyecto']}</td>
                <td>{$row['donante']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay donaciones registradas.</p>";
}

echo "<br><a href='index.php'>Volver al inicio</a>";
?>
