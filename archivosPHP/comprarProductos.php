<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están vacíos
    if (
        empty($_POST["codigo_compra"]) || empty($_POST["nombre_compra"]) || empty($_POST["fecha_vencimiento_compra"])
        || empty($_POST["laboratorio_compra"]) || empty($_POST["lote_compra"])
        || empty($_POST["registro_sanitario_compra"]) || empty($_POST["precio_venta_compra"])
    ) {
        // Campos vacíos, muestra un mensaje de error en el modal
        echo "<h3 class='error'>Todos los campos son obligatorios.</h3>";
    } else {
        $codigoC = trim($_POST['codigo_compra']);
        $nombreC = trim($_POST['nombre_compra']);
        $fechaVencimientoC = trim($_POST['fecha_vencimiento_compra']);
        $laboratorioC = trim($_POST['laboratorio_compra']);
        $loteC = trim($_POST['lote_compra']);
        $registroSanitarioC = trim($_POST['registro_sanitario_compra']);
        $precioVentaC = trim($_POST['precio_venta_compra']);

        // Establecer la zona horaria a la de Bogotá, Colombia
        date_default_timezone_set('America/Bogota');

        // Crear un objeto DateTime con la fecha actual
        $fecha = new DateTime();

        // Formatear la fecha al formato que espera MySQL
        $fecha_formateada = $fecha->format('Y-m-d');

        $save_compra = "INSERT INTO inventario (codigoP, nombreProducto, fechaVencimiento, laboratorio, lote, registroSanitario, precioVenta, fechaIngreso) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($save_compra);
        $stmt->bind_param("ssssssss", $codigoC, $nombreC, $fechaVencimientoC, $laboratorioC, $loteC, $registroSanitarioC, $precioVentaC, $fecha_formateada);
        $resultado = $stmt->execute();

        if ($resultado) {
            // Éxito, muestra un mensaje de éxito en el modal
            echo "<h3 class='success'>Tu registro se ha completado</h3>";
        } else {
            // Error, muestra un mensaje de error en el modal
            echo "<h3 class='error'>Ocurrió un error</h3>";
        }
    }
}
