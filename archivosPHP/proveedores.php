<?php
include("conexion.php");

$nombreP = isset($_POST['search-name-suppliers']) ? $conex->real_escape_string($_POST['search-name-suppliers']) : '';
$cedulaP = isset($_POST['search-code-suppliers']) ? $conex->real_escape_string($_POST['search-code-suppliers']) : '';

if (!empty($cedulaP) && !empty($nombreP)) {
    $sql = "SELECT nombres, apellidos, documentoid, email, celular, entidad 
            FROM proveedores 
            WHERE documentoid = ? AND nombres = ?";
} else {
    $sql = "SELECT nombres, apellidos, documentoid, email, celular, entidad
            FROM proveedores 
            WHERE documentoid = ? OR nombres = ?";
}

$stmt = $conex->prepare($sql);
$stmt->bind_param('ss', $cedulaP, $nombreP);
$stmt->execute();
$resultP = $stmt->get_result();

if ($resultP->num_rows > 0) {
    while ($row = $resultP->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombres"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . $row["documentoid"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["celular"] . "</td>";
        echo "<td>" . $row["entidad"] . "</td>";
        echo "</tr>";
    }
}

$stmt->close();
$conex->close();
