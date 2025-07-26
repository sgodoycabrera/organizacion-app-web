<?php
include("conexion.php");

// Obtener todos los IDs y nombres de proyectos
$proyectos = [];
$result = $conexion->query("SELECT id_proyecto, nombre FROM PROYECTO");
while ($row = $result->fetch_assoc()) {
    $proyectos[] = $row['id_proyecto'];
}

// Obtener todos los IDs y nombres de donantes
$donantes = [];
$result = $conexion->query("SELECT id_donante, nombre FROM DONANTE");
while ($row = $result->fetch_assoc()) {
    $donantes[] = $row['id_donante'];
}

// Verificar que haya al menos 1 proyecto y 1 donante
if (count($proyectos) == 0 || count($donantes) == 0) {
    die("Error: Debes tener al menos un proyecto y un donante registrados para insertar donaciones.");
}

// Preparar array con 10 donaciones con montos y fechas arbitrarias
$donaciones = [
    ['monto' => 10000, 'fecha' => '2025-07-15'],
    ['monto' => 15000, 'fecha' => '2025-07-16'],
    ['monto' => 20000, 'fecha' => '2025-07-17'],
    ['monto' => 5000,  'fecha' => '2025-07-18'],
    ['monto' => 12000, 'fecha' => '2025-07-19'],
    ['monto' => 25000, 'fecha' => '2025-07-20'],
    ['monto' => 18000, 'fecha' => '2025-07-21'],
    ['monto' => 22000, 'fecha' => '2025-07-22'],
    ['monto' => 8000,  'fecha' => '2025-07-23'],
    ['monto' => 14000, 'fecha' => '2025-07-24'],
];

// Preparar la inserción
$stmt = $conexion->prepare("INSERT INTO DONACION (monto, fecha, id_proyecto, id_donante) VALUES (?, ?, ?, ?)");

foreach ($donaciones as $index => $donacion) {
    // Asignar proyecto y donante de forma cíclica para no salirnos de los arrays
    $id_proyecto = $proyectos[$index % count($proyectos)];
    $id_donante  = $donantes[$index % count($donantes)];

    $stmt->bind_param("dsii", $donacion['monto'], $donacion['fecha'], $id_proyecto, $id_donante);
    $stmt->execute();
}

echo "✅ Se insertaron las 10 donaciones correctamente.<br>";
echo "<a href='mostrar_donaciones.php'>Ver donaciones</a>";

$stmt->close();
?>
