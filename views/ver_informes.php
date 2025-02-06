<?php
session_start();
if ($_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit();
}
require_once '../backend/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Informes - Zis Calendar</title>
    <link href="../assets/css/estilos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('../partials/navbar.php'); ?>
    <div class="container mt-4">
        <h2 class="text-center">Ver Informes</h2>
        <form method="GET">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>">
            <button type="submit">Filtrar</button>
        </form>

        <?php
        if (isset($_GET['fecha'])) {
            $fecha = $_GET['fecha'];
            $result = $conn->query("SELECT u.nombre, i.nombre_actividad, i.descripcion, i.archivo_pdf, i.fecha FROM informes i JOIN usuarios u ON i.usuario_id = u.id_usuario WHERE DATE(i.fecha) = '$fecha'");

            if ($result->num_rows > 0) {
                echo "<table id='tabla-informes'>";
                echo "<tr><th>Usuario</th><th>Actividad</th><th>Descripción</th><th>Archivo</th><th>Fecha</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['nombre_actividad'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td><a href='" . $row['archivo_pdf'] . "' target='_blank'>Ver PDF</a></td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se encontraron informes para la fecha seleccionada.</p>";
            }
        }
        ?>
    </div>
</body>
</html>