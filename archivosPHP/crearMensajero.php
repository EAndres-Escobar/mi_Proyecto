
<?php
include("conexion.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están vacíos
    if (empty($_POST["NombresMensajero"]) || empty($_POST["ApellidosMensajero"]) || empty($_POST["DocumentoMensajero"]) || empty($_POST["CorreoMensajero"]) || empty($_POST["CelularMensajero"])) {
        // Campos vacíos, muestra un mensaje de error en el modal
        echo "<h3 class='error'>Todos los campos son obligatorios.</h3>";
    } else {
        $nombresMensajero = trim($_POST['NombresMensajero']);
        $apellidosMensajero = trim($_POST['ApellidosMensajero']);
        $documentoMensajero = trim($_POST['DocumentoMensajero']);
        $correoMensajero = trim($_POST['CorreoMensajero']);
        $celularMensajero = trim($_POST['CelularMensajero']);

        // Establecer la zona horaria a la de Bogotá, Colombia
        date_default_timezone_set('America/Bogota');

        // Crear un objeto DateTime con la fecha actual
        $fecha = new DateTime();

        // Formatear la fecha al formato que espera MySQL
        $fecha_formateada = $fecha->format('Y-m-d');

        $save_Mensajero = "INSERT INTO mensajeros (nombresM, apellidosM, documentoidM, emailM, celularM, fechaM) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($save_Mensajero);
        $stmt->bind_param("ssssss", $nombresMensajero, $apellidosMensajero, $documentoMensajero, $correoMensajero, $celularMensajero, $fecha_formateada);
        $resultadoMensajero = $stmt->execute();

        if ($resultadoMensajero) {
            // Éxito, muestra un mensaje de éxito en el modal
            echo "<h3 class='success'>Tu registro se ha completado</h3>";
        } else {
            // Error, muestra un mensaje de error en el modal
            echo "<h3 class='error'>Ocurrió un error</h3>";
        }
    }
}
