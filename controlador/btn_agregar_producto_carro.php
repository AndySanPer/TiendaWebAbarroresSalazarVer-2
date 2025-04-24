<?php
include_once "../modelo/servidor.php";

if (isset($_POST['id_venta']) && isset($_POST['cantidad'])) {
    $id_venta = $_POST['id_venta'];
    $nuevaCantidad = $_POST['cantidad'];

    $cone = new Servidor("root", "proyecto", "");
    $conexion = $cone->conecta();

    if (!$conexion) {
        die(json_encode(['status' => 'error', 'message' => 'Error de conexión a la base de datos.']));
    }

    try {
        // Obtener el ID del producto y cantidad en la venta
        $query = "SELECT id_producto, precio, cantidad FROM ventas WHERE id_venta = :id_venta";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $venta = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$venta) {
            echo json_encode(['status' => 'error', 'message' => 'Venta no encontrada.']);
            exit;
        }

        $id_producto = $venta['id_producto'];
        $precio = $venta['precio'];
        $cantidadActualVenta = $venta['cantidad'];

        // Obtener la cantidad disponible en la tabla productos
        $queryStock = "SELECT cantidad FROM productos WHERE id = :id_producto";
        $stmtStock = $conexion->prepare($queryStock);
        $stmtStock->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $stmtStock->execute();
        $producto = $stmtStock->fetch(PDO::FETCH_ASSOC);

        if (!$producto) {
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado.']);
            exit;
        }

        $stockDisponible = $producto['cantidad'];

        // Verificar si la cantidad a agregar supera el stock disponible
        $cantidadAAgregar = $nuevaCantidad - $cantidadActualVenta; // Lo nuevo que se está intentando agregar
        if ($cantidadAAgregar > $stockDisponible) {
            echo json_encode(['status' => 'no_stock', 'stock_disponible' => $stockDisponible]);
            exit;
        }

        // Calcular el nuevo total
        $total = $precio * $nuevaCantidad;

        // Actualizar la cantidad en la tabla ventas
        $updateVenta = "UPDATE ventas SET cantidad = :cantidad, total = :total WHERE id_venta = :id_venta";
        $stmtUpdateVenta = $conexion->prepare($updateVenta);
        $stmtUpdateVenta->bindParam(":cantidad", $nuevaCantidad, PDO::PARAM_INT);
        $stmtUpdateVenta->bindParam(":total", $total, PDO::PARAM_STR);
        $stmtUpdateVenta->bindParam(":id_venta", $id_venta, PDO::PARAM_INT);
        $stmtUpdateVenta->execute();

        // Restar la cantidad exacta del stock
        $nuevoStock = $stockDisponible - $cantidadAAgregar; 
        $updateStock = "UPDATE productos SET cantidad = :cantidad WHERE id = :id_producto";
        $stmtUpdateStock = $conexion->prepare($updateStock);
        $stmtUpdateStock->bindParam(":cantidad", $nuevoStock, PDO::PARAM_INT);
        $stmtUpdateStock->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $stmtUpdateStock->execute();

        echo json_encode(['status' => 'success', 'nuevaCantidad' => $nuevaCantidad]);

    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la consulta: ' . $e->getMessage()]);
    }
}
?>
