<?php
include("conexion.php");

$codigoP = isset($_POST['Codigo-Producto2']) ? $conex->real_escape_string($_POST['Codigo-Producto2']) : '';

$sql = "SELECT codigoP, nombreProducto, PrecioVenta 
        FROM inventario 
        WHERE codigoP = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param('s', $codigoP);
$stmt->execute();
$resultC = $stmt->get_result();

if ($resultC->num_rows > 0) {
    while ($row = $resultC->fetch_assoc()) {
        echo json_encode($row);
    }
}

$stmt->close();
$conex->close();
