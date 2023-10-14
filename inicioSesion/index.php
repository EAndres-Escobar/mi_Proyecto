<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio de sesión</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="logo/edsof.png" type="image/x-icon">
</head>

<body>

    <img src="logo/edsof.png" class="logoEdsoft" alt="Logo empresa EdSoft">
    <form action="login.php" method="POST">

        <?php
        // Mostrar mensaje de error si está configurado
        if (isset($_GET["error"]) && $_GET["error"] == "1") {
            echo '<div class="error-message">Credenciales incorrectas. Intente de nuevo.</div>';
        } elseif (isset($_GET["error"]) && $_GET["error"] == "2") {
            echo '<div class="error-message">Por favor, complete todos los campos.</div>';
        }
        ?>
        <h2 class="inicio">INICIAR SESIÓN</h2>
        <p>Bienvenido</p>

        <div class="input-wrapper">
            <input type="user" id="user" name="user" placeholder="Nombre de usuario" required>
            <i class="fas fa-user"></i>
        </div>

        <div class="input-wrapper">
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <i class="fas fa-lock"></i>
        </div>

        <button class="btn" type="submit"><b>Iniciar Sesión</b></button>
        <a href="pagina.php">Recuperar Contraseña</a>
    </form>
</body>

</html>