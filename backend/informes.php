<!-- backend/informes.php -->
<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_actividad = $_POST['nombre_actividad'];
    $descripcion = $_POST['descripcion'];
    $usuario_id = $_SESSION['usuario_id'];

    if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] === UPLOAD_ERR_OK) {
        $archivo_nombre = $_FILES['archivo_pdf']['name'];
        $archivo_tmp = $_FILES['archivo_pdf']['tmp_name'];
        $archivo_destino = '../uploads/' . basename($archivo_nombre);

        if (move_uploaded_file($archivo_tmp, $archivo_destino)) {
            $stmt = $conn->prepare("INSERT INTO informes (usuario_id, nombre_actividad, descripcion, archivo_pdf, fecha) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param("isss", $usuario_id, $nombre_actividad, $descripcion, $archivo_destino);
            $stmt->execute();
            header("Location: ../views/dashboard_miembro.php?success=1");
            exit();
        }
    }
    header("Location: ../views/dashboard_miembro.php?error=1");
}

if ($_SESSION['rol'] === 'administrador' && isset($_GET['reporte_dia'])) {
    $fecha = $_GET['reporte_dia'];
    $result = $conn->query("SELECT u.nombre, i.nombre_actividad, i.descripcion, i.archivo_pdf, i.fecha FROM informes i JOIN usuarios u ON i.usuario_id = u.id_usuario WHERE DATE(i.fecha) = '$fecha'");

    echo "<h2>Informe del $fecha</h2><table border='1'><tr><th>Usuario</th><th>Actividad</th><th>Descripción</th><th>Archivo</th><th>Fecha</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['nombre']}</td><td>{$row['nombre_actividad']}</td><td>{$row['descripcion']}</td><td><a href='{$row['archivo_pdf']}'>Ver PDF</a></td><td>{$row['fecha']}</td></tr>";
    }
    echo "</table>";
}
?>