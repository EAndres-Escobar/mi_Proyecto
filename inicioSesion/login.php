<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["user"]) || empty($_POST["password"])) {

        header("Location: index.php?error=2");
        exit();
    }


    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "edsoftdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }


    $user = $_POST["user"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM empleados WHERE idUsuario = ? AND passwordE = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $_SESSION["usuario"] = $user;
        header("Location: ../pagina.php");
    } else {

        header("Location: index.php?error=1");
    }

    $stmt->close();
}
