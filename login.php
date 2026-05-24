<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infonet_db";

$conn = new mysqli($servername, $username, $password, $dbname);

$email = isset($_POST['login_email']) ? trim($_POST['login_email']) : '';
$password_user = isset($_POST['login_password']) ? $_POST['login_password'] : '';

if (empty($email) || empty($password_user)) {
    header("Location: index.php#login-seccion");
    exit();
}

// Seleccionamos solo las columnas que sí existen en tu tabla clientes
$sql = "SELECT id, nombre, email, password FROM clientes WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password_user, $user['password'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        // Guardamos el servicio real del usuario en la sesión global
        $_SESSION['usuario_servicio'] = $user['servicio_contratado'];
        
        header("Location: panel.php");
        exit();
    }
}

header("Location: index.php#login-seccion");

$stmt->close();
$conn->close();