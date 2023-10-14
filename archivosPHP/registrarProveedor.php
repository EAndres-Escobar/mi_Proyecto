<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están vacíos
    if (empty($_POST["NombresRP"]) || empty($_POST["ApellidosRP"]) || empty($_POST["DocumentoRP"]) || empty($_POST["CorreoRP"]) || empty($_POST["CelularRP"])) {
        // Campos vacíos, muestra un mensaje de error en el modal
        echo "<h3 class='error'>Todos los campos son obligatorios.</h3>";
    } else {
        $nombres = trim($_POST['NombresRP']);
        $apellidos = trim($_POST['ApellidosRP']);
        $documento = trim($_POST['DocumentoRP']);
        $correo = trim($_POST['CorreoRP']);
        $celular = trim($_POST['CelularRP']);
        $entidad = trim($_POST['EntidadRP']);

        // Establecer la zona horaria a la de Bogotá, Colombia
        date_default_timezone_set('America/Bogota');

        // Crear un objeto DateTime con la fecha actual
        $fecha = new DateTime();

        // Formatear la fecha al formato que espera MySQL
        $fecha_formateada = $fecha->format('Y-m-d');

        $save_proveedores = "INSERT INTO proveedores (nombres, apellidos, documentoid, email, celular, entidad, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($save_proveedores);
        $stmt->bind_param("sssssss", $nombres, $apellidos, $documento, $correo, $celular, $entidad, $fecha_formateada);
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
