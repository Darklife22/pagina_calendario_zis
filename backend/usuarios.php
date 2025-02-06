<!-- backend/usuarios.php -->
<?php
session_start();
require_once 'db.php';

if ($_SESSION['rol'] !== 'administrador') {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $contraseña, $rol);
    $stmt->execute();
    header("Location: ../views/dashboard_admin.php?user_added=1");
    exit();
}
?>