<?php
if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = "Sin identificar";
} else {
    if (isset($_REQUEST['nombre'], $_REQUEST['tipo'], $_REQUEST['id'])) {
        $_SESSION['nombre'] = $_REQUEST['nombre'];
        $_SESSION['tipo'] = $_REQUEST['tipo'];
        $_SESSION['id'] = $_REQUEST['id'];
    }
}

include_once "encabezado.php";
include_once "../modelo/servidor.php";

// Conectar a la base de datos
$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta();

// Consulta SQL para obtener los datos ordenados por fecha (más reciente primero)
$sql = "SELECT * FROM contactanos ORDER BY fecha DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mensajes.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
</head>
<body>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Motivo</th>
                <th>Mensaje</th>
                <th class="fecha-columna" >Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si la consulta devolvió resultados
            if ($resultado->rowCount() > 0) {  // Cambié num_rows por rowCount
                // Mostrar cada fila de la base de datos
                while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nombre']) ." ". htmlspecialchars($row['apellidos']) .  "</td>";
                    echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['motivo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mensaje']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
