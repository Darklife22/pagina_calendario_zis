<?php
session_start();
if ($_SESSION['rol'] !== 'miembro') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Miembro - Zis Calendar</title>
    <link href="../assets/css/estilos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('../partials/navbar.php'); ?>
    <div class="container mt-4">
        <h2 class="text-center">Subir Informe Diario</h2>
        <form id="formulario-informe" action="../backend/informes.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre_actividad" class="form-label">Nombre de la Actividad</label>
                <input type="text" class="form-control" name="nombre_actividad" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="archivo_pdf" class="form-label">Subir Informe (PDF)</label>
                <input type="file" class="form-control" name="archivo_pdf" accept="application/pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Subir Informe</button>
        </form>
    </div>
</body>
</html>