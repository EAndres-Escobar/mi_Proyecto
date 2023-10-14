<?php
include("conexion.php");

$codigoV = isset($_POST['codigo_vendedor']) ? $conex->real_escape_string($_POST['codigo_vendedor']) : '';

$sql = "SELECT idUsuario, nombres, apellidos 
        FROM empleados 
        WHERE idUsuario = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param('s', $codigoV);
$stmt->execute();
$resultV = $stmt->get_result();

if ($resultV->num_rows > 0) {
    while ($row = $resultV->fetch_assoc()) {
        echo json_encode($row);
    }
}

$stmt->close();
$conex->close();
