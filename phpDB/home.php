<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php"); // Redirigir a la página de inicio de sesión
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Inicio</title>
</head>

<body>
<nav id="cabecera">
    <ul class="nav-main">
        <li>

        </li>
    </ul>
    <div class="icono">

        <h1><i class="bi bi-file-earmark-person"> </i>ITO-Vitae</h1>
    </div>

    <ul class="nav-menu-right">
        <li>

        </li>
    </ul>
</nav>
<br><br><br><br><br><br><br><br>
<div class="gracias">
    <?php
    echo "Bienvenid@ " . $_SESSION['user_name'];
    ?>
</div><br><br><br><br>
<div class="contenedorboton">
    <a href="../formulario.php"><button type="button">Crear CV</button></a>
    <a href="procesocerrar.php"><button type="button">Cerrar sesión</button></a>
</div>
</body>
</html>