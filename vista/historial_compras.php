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

// Verificar si la sesión tiene un ID de cliente válido
if (!isset($_SESSION['id'])) {
    die("Error: No hay un cliente autenticado en la sesión.");
}

$sql = "SELECT v.id_venta, v.id_cliente, v.id_producto, v.cantidad, v.precio, v.total, v.fecha, v.estado, 
                p.imagen AS producto_imagen,
                p.producto AS producto_nombre, 
                u.nombre AS cliente_nombre, 
                u.apellidos AS cliente_apellidos
        FROM ventas v
        INNER JOIN productos p ON v.id_producto = p.id
        INNER JOIN usuarios u ON v.id_cliente = u.id
        WHERE v.id_cliente = :id_cliente AND v.estado = 'entregado'"; 

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id_cliente', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
$ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agrupar las ventas por cliente
$ventas_por_cliente = [];
foreach ($ventas as $venta) {
    $ventas_por_cliente[$venta['id_cliente']][] = $venta;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas con Estado Diferente a 'Carro'</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/ventas_activas.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                
                <th>Cliente</th>
                <th>Producto</th>
                <th>Imagen</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>SubTotal</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ventas_por_cliente as $id_cliente => $ventas_cliente):
                $total_cliente = 0;
                $cliente_nombre = $ventas_cliente[0]['cliente_nombre'];
            ?>
                <?php foreach ($ventas_cliente as $venta): ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($venta['cliente_nombre'] . " " . $venta['cliente_apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($venta['producto_nombre']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($venta['producto_imagen']); ?>" alt="Imagen del producto"></td>
                        <td><?php echo htmlspecialchars($venta['cantidad']); ?></td>
                        <td>$<?php echo number_format($venta['precio'], 2); ?></td>
                        <td>$<?php echo number_format($venta['total'], 2); ?></td>
                        <td><?php echo htmlspecialchars($venta['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($venta['estado']); ?></td>
                    </tr>
                    <?php $total_cliente += $venta['total']; ?>
                <?php endforeach; ?>

                <!-- Fila de total para el cliente -->
                <tr class="total-row">
                    <td colspan="5" class="text-right"><strong>Total</strong></td>
                    <td class="text-right"><strong>$<?php echo number_format($total_cliente, 2); ?></strong></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>