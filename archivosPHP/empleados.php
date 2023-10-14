<?php
include("conexion.php");

$nombreE = isset($_POST['search-name-empleados']) ? $conex->real_escape_string($_POST['search-name-empleados']) : '';
$cedulaE = isset($_POST['search-code-empleados']) ? $conex->real_escape_string($_POST['search-code-empleados']) : '';

if (!empty($cedulaE) && !empty($nombreE)) {
    $sql = "SELECT nombres, apellidos, documentoid, email, celular, cargo, foto 
            FROM empleados 
            WHERE documentoid = ? AND nombres = ?";
} else {
    $sql = "SELECT nombres, apellidos, documentoid, email, celular, cargo, foto  
            FROM empleados 
            WHERE documentoid = ? OR nombres = ?";
}

$stmt = $conex->prepare($sql);
$stmt->bind_param('ss', $cedulaE, $nombreE);
$stmt->execute();
$resultE = $stmt->get_result();

if ($resultE->num_rows > 0) {
    while ($row = $resultE->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombres"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . $row["documentoid"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["celular"] . "</td>";
        echo "<td>" . $row["cargo"] . "</td>";
        echo "<td>" . $row["foto"] . "</td>";
        echo "</tr>";
    }
}

$stmt->close();
$conex->close();
