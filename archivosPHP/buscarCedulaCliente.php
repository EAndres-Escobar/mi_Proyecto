<?php
include("conexion.php");

$codigoC = isset($_POST['Cedula-Cliente']) ? $conex->real_escape_string($_POST['Cedula-Cliente']) : '';

$sql = "SELECT documentoid, nombres, apellidos 
        FROM clientes 
        WHERE documentoid = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param('s', $codigoC);
$stmt->execute();
$resultC = $stmt->get_result();

if ($resultC->num_rows > 0) {
    while ($row = $resultC->fetch_assoc()) {
        echo json_encode($row);
    }
}

$stmt->close();
$conex->close();
