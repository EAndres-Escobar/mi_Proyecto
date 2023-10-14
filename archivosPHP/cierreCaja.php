<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están vacíos
    if (
        empty($_POST["efectivo_inicial"]) || empty($_POST["ventas_efectivo"]) || empty($_POST["ventas_tarjeta"])
        || empty($_POST["nombre_gastos"]) || empty($_POST["gasto"]) || empty($_POST["nombre_usuario"])
    ) {
        // Campos vacíos, muestra un mensaje de error en el modal
        echo "<h3 class='error'>Todos los campos son obligatorios.</h3>";
    } else {
        $efectivo = trim($_POST['efectivo_inicial']);
        $ventas = trim($_POST['ventas_efectivo']);
        $tarjeta = trim($_POST['ventas_tarjeta']);
        $nombreGasto = trim($_POST['nombre_gastos']);
        $valorGasto = trim($_POST['gasto']);
        $nombreUsuario = trim($_POST['nombre_usuario']);

        // Establecer la zona horaria a la de Bogotá, Colombia
        date_default_timezone_set('America/Bogota');

        // Crear un objeto DateTime con la fecha actual
        $fecha = new DateTime();

        // Formatear la fecha al formato que espera MySQL
        $fecha_formateada = $fecha->format('Y-m-d');

        $save_caja = "INSERT INTO caja (efectivo_inicial, ventas_efectivo, ventas_tarjeta, nombre_gastos, gasto, nombre_usuario, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($save_caja);
        $stmt->bind_param("sssssss", $efectivo, $ventas, $tarjeta, $nombreGasto, $valorGasto, $nombreUsuario, $fecha_formateada);
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
