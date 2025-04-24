<?php
include_once "../modelo/servidor.php";

// Verificar que la solicitud sea válida
if (isset($_POST['id_venta']) && isset($_POST['cantidad'])) {
    $id_venta = $_POST['id_venta'];
    $nuevaCantidad = $_POST['cantidad'];

    $cone = new Servidor("root", "proyecto", "");
    $conexion = $cone->conecta();

    if (!$conexion) {
        die(json_encode(["status" => "error", "message" => "Error al conectar con la base de datos."]));
    }

    try {
        // Obtener la cantidad actual, el precio y el id_producto de la venta
        $query = "SELECT cantidad, precio, id_producto FROM ventas WHERE id_venta = :id_venta";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $venta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($venta) {
            $cantidadActual = $venta['cantidad'];
            $precio = $venta['precio'];
            $id_producto = $venta['id_producto']; // Obtener el ID del producto

            // 2 Validar que la nueva cantidad no sea menor que 1
            if ($nuevaCantidad < 1 || $nuevaCantidad > $cantidadActual) {
                $nuevaCantidad = 1;
            }

            // 3️ Determinar la cantidad que se está restando
            $cantidadRestada = $cantidadActual - $nuevaCantidad;

            // 4️ Sumar esa cantidad de vuelta al stock del producto en la tabla `productos`
            $updateStockQuery = "UPDATE productos SET cantidad = cantidad + :cantidadRestada WHERE id = :id_producto";
            $updateStockStmt = $conexion->prepare($updateStockQuery);
            $updateStockStmt->bindParam(":cantidadRestada", $cantidadRestada, PDO::PARAM_INT);
            $updateStockStmt->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
            $updateStockStmt->execute();

            // 5️ Calcular el nuevo total
            $total = $precio * $nuevaCantidad;

            // 6️ Actualizar la cantidad y el total en la tabla `ventas`
            $updateQuery = "UPDATE ventas SET cantidad = :cantidad, total = :total WHERE id_venta = :id_venta";
            $updateStmt = $conexion->prepare($updateQuery);
            $updateStmt->bindParam(":cantidad", $nuevaCantidad, PDO::PARAM_INT);
            $updateStmt->bindParam(":total", $total, PDO::PARAM_STR);
            $updateStmt->bindParam(":id_venta", $id_venta, PDO::PARAM_INT);
            $updateStmt->execute();

            echo json_encode(["status" => "success", "nuevaCantidad" => $nuevaCantidad, "total" => $total]);
        } else {
            echo json_encode(["status" => "error", "message" => "Venta no encontrada"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error en la consulta: " . $e->getMessage()]);
    }
}
?>

