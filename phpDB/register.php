<?php
require 'connection.php';
$pdo = connection();

$email = $_POST['email'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];

$Query = "SELECT * FROM users WHERE user_name ='" . $user_name . "'";
$Result = $pdo->query($Query);

if ($Result === false) {
    die("Error al ejecutar la consulta: " . $pdo->error);
}

if ($Result->rowCount() == 0) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (user_name, email, password) VALUES (:user_name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('user_name', $user_name);
    $stmt->bindValue('email', $email);
    $stmt->bindValue('password', $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }
} else {

    ?>
    <p>Usuario ya existente</p>
    <br>
    <button><a href="register.php">Volver</a></button>
    <?php
    exit;
}
?>

