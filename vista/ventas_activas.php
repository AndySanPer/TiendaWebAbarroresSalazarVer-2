<?php
if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = "Sin identificar";
} else {
    if (isset($_REQUEST['nombre'])) { 
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

// Consulta para obtener solo las ventas con estado 'pendiente'
$sql = "SELECT v.id_venta, v.id_cliente, v.id_producto, v.cantidad, v.precio, v.total, v.fecha, v.estado, 
                p.imagen AS producto_imagen,
               p.producto AS producto_nombre, 
               u.nombre AS cliente_nombre, 
               u.apellidos AS cliente_apellidos
        FROM ventas v
        INNER JOIN productos p ON v.id_producto = p.id
        INNER JOIN usuarios u ON v.id_cliente = u.id
        WHERE v.estado = 'pendiente'"; // Filtrar solo los registros con estado 'pendiente'

$stmt = $conexion->prepare($sql);
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

    <script>
       $(document).ready(function () {
    $(".btn_actulizar_venta").click(function () {
        let id_cliente = $(this).data("id"); // Obtener el ID del cliente correctamente
        
        if (!id_cliente) {
            alert("Error: No se pudo obtener el ID del cliente.");
            return;
        }

        // Confirmación antes de actualizar
        if (!confirm(`¿Seguro que deseas actualizar el estado de las ventas del cliente ${id_cliente}?`)) {
            return;
        }

        // Enviar el ID del cliente con AJAX
        $.ajax({
            url: "../controlador/actualizar_estado_venta.php",
            type: "POST",
            data: { id_cliente: id_cliente },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert("Estado de ventas actualizado correctamente.");
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert("Error al actualizar: " + response.message);
                }
            },
            error: function () {
                alert("Error en la solicitud AJAX.");
            }
        });
    });
});
    </script>


</head>
<body>

<div class="container mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Venta</th>
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
            // Iterar sobre cada cliente
            foreach ($ventas_por_cliente as $id_cliente => $ventas_cliente):
                $total_cliente = 0; // Variable para calcular el total del cliente
                $cliente_nombre = $ventas_cliente[0]['cliente_nombre']; // Obtener el nombre del cliente (todos los registros de un cliente son iguales)
            ?>
                <?php foreach ($ventas_cliente as $venta): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($venta['id_venta']); ?></td>
                        <td><?php echo htmlspecialchars($venta['cliente_nombre'] . " " . $venta['cliente_apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($venta['producto_nombre']); ?></td>
                        <td><img src="" alt="esto es un producto" srcset="<?php echo htmlspecialchars($venta['producto_imagen']); ?>"></td>
                        <td><?php echo htmlspecialchars($venta['cantidad']); ?></td>
                        <td>$<?php echo number_format($venta['precio'], 2); ?> </td>
                        <td>$<?php echo number_format($venta['total'], 2); ?> </td>
                        <td><?php echo htmlspecialchars($venta['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($venta['estado']); ?></td>
                    </tr>
                    <?php $total_cliente += $venta['total'] + 54; // Sumar el total de cada venta ?>
                <?php endforeach; ?>

                <!-- Fila de total para el cliente -->
                <tr class="total-row">
                    <td colspan="5" class="text-right"><strong>Total</strong></td>
                    <td class="text-right"><strong>$<?php echo number_format($total_cliente, 2); ?></strong></td>
                    <td colspan="3" class="button-cell">
                        <button class="btn btn-primary btn_actulizar_venta" data-id="<?php echo $id_cliente; ?>">Actualizar Estado</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
