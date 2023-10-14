<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están vacíos
    if (empty($_POST["Nombres"]) || empty($_POST["Apellidos"]) || empty($_POST["Documento"]) || empty($_POST["Correo"]) || empty($_POST["Celular"])) {
        // Campos vacíos, muestra un mensaje de error en el modal
        echo "<h3 class='error'>Todos los campos son obligatorios.</h3>";
    } else {
        $nombres = trim($_POST['Nombres']);
        $apellidos = trim($_POST['Apellidos']);
        $documento = trim($_POST['Documento']);
        $correo = trim($_POST['Correo']);
        $celular = trim($_POST['Celular']);

        // Establecer la zona horaria a la de Bogotá, Colombia
        date_default_timezone_set('America/Bogota');

        // Crear un objeto DateTime con la fecha actual
        $fecha = new DateTime();

        // Formatear la fecha al formato que espera MySQL
        $fecha_formateada = $fecha->format('Y-m-d');

        $save_cliente = "INSERT INTO clientes (nombres, apellidos, documentoid, email, celular, fecha) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($save_cliente);
        $stmt->bind_param("ssssss", $nombres, $apellidos, $documento, $correo, $celular, $fecha_formateada);
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
