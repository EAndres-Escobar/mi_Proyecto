<?php
include("conexion.php");

$nombreC = isset($_POST['search-name-customers']) ? $conex->real_escape_string($_POST['search-name-customers']) : '';
$cedulaC = isset($_POST['search-code-customers']) ? $conex->real_escape_string($_POST['search-code-customers']) : '';

if (!empty($cedulaC) && !empty($nombreC)) {
    $sql = "SELECT nombres, apellidos, documentoid, email, celular 
            FROM clientes 
            WHERE documentoid = ? AND nombres = ?";
} else {
    $sql = "SELECT nombres, apellidos, documentoid, email, celular 
            FROM clientes 
            WHERE documentoid = ? OR nombres = ?";
}

$stmt = $conex->prepare($sql);
$stmt->bind_param('ss', $cedulaC, $nombreC);
$stmt->execute();
$resultC = $stmt->get_result();

if ($resultC->num_rows > 0) {
    while ($row = $resultC->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombres"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . $row["documentoid"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["celular"] . "</td>";
        echo "</tr>";
    }
}

$stmt->close();
$conex->close();
