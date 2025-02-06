<!-- views/dashboard_admin.php -->
<?php
session_start();
if ($_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador - Zis Calendar</title>
    <link href="../assets/css/estilos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('../partials/navbar.php'); ?>
    <div class="container mt-4">
        <h2 class="text-center">Panel del Administrador</h2>
        <a href="../backend/informes.php" class="btn btn-success">Generar Informe Diario</a>
        <a href="../backend/usuarios.php" class="btn btn-secondary">Gestionar Usuarios</a>
    </div>
</body>
</html>
