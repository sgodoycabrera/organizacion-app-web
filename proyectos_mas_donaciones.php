<?php
include("conexion.php");

$sql = "
SELECT p.nombre AS proyecto,
       COUNT(d.id_donacion) AS num_donaciones,
       SUM(d.monto) AS total_recaudado
FROM PROYECTO p
JOIN DONACION d ON p.id_proyecto = d.id_proyecto
GROUP BY p.id_proyecto
HAVING COUNT(d.id_donacion) > 2
ORDER BY total_recaudado DESC
";

$result = $conexion->query($sql);

echo "<h1>Proyectos con más de 2 donaciones</h1>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Proyecto</th><th>Cantidad de Donaciones</th><th>Total Recaudado (CLP)</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['proyecto']}</td>
                <td>{$row['num_donaciones']}</td>
                <td>{$row['total_recaudado']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay proyectos con más de dos donaciones.</p>";
}

echo "<br><a href='index.php'>Volver al inicio</a>";
?>
