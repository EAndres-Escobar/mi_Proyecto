<?php
include("conexion.php");

$nombreP = isset($_POST['search-name-inventory']) ? $conex->real_escape_string($_POST['search-name-inventory']) : '';
$codigoP = isset($_POST['search-code-inventory']) ? $conex->real_escape_string($_POST['search-code-inventory']) : '';

if (!empty($codigoP) && !empty($nombreP)) {
    $sql = "SELECT codigoP, nombreProducto, fechaIngreso, fechaVencimiento, laboratorio, lote, registroSanitario, precioVenta
            FROM inventario 
            WHERE codigoP = ? AND nombreProducto = ?";
} else {
    $sql = "SELECT codigoP, nombreProducto, fechaIngreso, fechaVencimiento, laboratorio, lote, registroSanitario, precioVenta
            FROM inventario 
            WHERE codigoP = ? OR nombreProducto = ?";
}

$stmt = $conex->prepare($sql);
$stmt->bind_param('ss', $codigoP, $nombreP);
$stmt->execute();
$resultP = $stmt->get_result();

if ($resultP) {
    if ($resultP->num_rows > 0) {
        while ($row = $resultP->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["codigoP"] . "</td>";
            echo "<td>" . $row["nombreProducto"] . "</td>";
            echo "<td>" . $row["fechaIngreso"] . "</td>";
            echo "<td>" . $row["fechaVencimiento"] . "</td>";
            echo "<td>" . $row["laboratorio"] . "</td>";
            echo "<td>" . $row["lote"] . "</td>";
            echo "<td>" . $row["registroSanitario"] . "</td>";
            echo "<td>" . $row["precioVenta"] . "</td>";
            echo "</tr>";
        }
    }
}

$stmt->close();
$conex->close();
