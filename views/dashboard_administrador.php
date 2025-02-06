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
        <div id="panel-admin">
            <a href="crear_usuario.php" class="btn btn-primary">Crear Nuevo Usuario</a>
            <a href="../backend/informes.php?reporte_dia=<?php echo date('Y-m-d'); ?>" class="btn btn-success">Generar Informe Diario</a>
            <a href="ver_informes.php" class="btn btn-info">Ver Informes</a>
        </div>
    </div>
</body>
</html>