<?php
require 'phpDB/connection.php';
$conn = connection();

session_start();
header('Content-Type: text/html; charset=UTF-8');

$error_message = "";

if (isset($_POST['user_name']) && isset($_POST['password'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM users WHERE user_name = :user_name");
    $query->bindParam(':user_name', $user_name);
    $query->execute();

    if ($query->rowCount() > 0) {
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $row["password"])) {
            $_SESSION['user_name'] = $user_name;
            header("Location: phpDB/home.php");
            exit;
        } else {
            $error_message = "Contraseña incorrecta";
        }
    } else {
        $error_message = "Usuario no encontrado";
    }
} else {
    $error_message = "Por favor, complete todos los campos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="img_login/bibliotec.jpg">

</head>
<body style="background-image: url('img_login/bibliotec.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
<div class="login-container">
    <h1 class="titulo">Bienvenido</h1>
    <img src="img_login/Leer.png" alt="zorro" class="zorroimg">
    <p>Bienvenido de nuevo, Te extrañamos</p>

    <!-- Imagen del zorro -->


    <!-- Formulario de inicio de sesión -->
    <form action="index.php" method="post">
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input class="user_name" name="user_name" type="text" placeholder="NombreUsuario" required>
        </div>

        <div class="input-container">
            <i class="fas fa-key"></i>
            <input class="password" name="password" type="password" placeholder="Contraseña" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>

    <!-- Iconos de redes sociales -->
    <div class="social-login">
        <div class="iconos">
            <img src="img_login/icono-google.png" alt="Google">
        </div>
        <div class="iconos">
            <img src="img_login/icono-apple.png" alt="Apple">
        </div>
        <div class="iconos">
            <img src="img_login/icono-facebook.png" alt="Facebook">
        </div>
    </div>

    <a href="registro.html">¿Aún no estás registrado? Regístrate aquí.</a>
    <!-- Mostrar mensaje de error si existe -->
    <?php if (!empty($error_message)): ?>
        <div>
            <p><?php echo $error_message; ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>