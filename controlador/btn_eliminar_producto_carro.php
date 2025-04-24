<?php
include_once "../modelo/servidor.php"; 

// Verificar si se recibió el id_venta por POST
if (isset($_POST['id_venta'])) {
    $id_venta = $_POST['id_venta'];

    // Crear una instancia de la conexión
    $cone = new Servidor("root", "proyecto", "");
    $conexion = $cone->conecta(); 

    // Consultar el producto que se va a eliminar
    $sql = $conexion->prepare("SELECT id_producto, cantidad, precio FROM ventas WHERE id_venta = ?");
    $sql->execute([$id_venta]);
    $venta = $sql->fetch();

    // Si se encuentra la venta
    if ($venta) {
        $id_producto = $venta['id_producto'];
        $cantidad = $venta['cantidad'];
        $valor_a_restar = $cantidad * $venta['precio']; // Calcular valor a restar del subtotal

        // Eliminar la venta
        $sql_delete = $conexion->prepare("DELETE FROM ventas WHERE id_venta = ?");
        $sql_delete->execute([$id_venta]);

        // Devolver la cantidad eliminada al stock del producto
        $sql_update_stock = $conexion->prepare("UPDATE productos SET cantidad = cantidad + ? WHERE id = ?");
        $sql_update_stock->execute([$cantidad, $id_producto]);

        // Enviar respuesta con el valor a restar
        echo json_encode([
            'status' => 'success',
            'valor_a_restar' => number_format($valor_a_restar, 2)
        ]);
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>
