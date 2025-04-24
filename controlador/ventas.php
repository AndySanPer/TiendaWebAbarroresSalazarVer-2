<?php
session_start();
include_once "../modelo/servidor.php";

// Verificar si los datos fueron enviados
if (!isset($_REQUEST['id']) || !isset($_REQUEST['cantidad']) || !isset($_REQUEST['total'])) {
    echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios."]);
    exit;
}

$id_producto = $_REQUEST['id'];
$cantidad_solicitada = (int) $_REQUEST['cantidad'];
$total = (float) $_REQUEST['total'];
$nombre = $_REQUEST['nombre'];
$tipo = $_REQUEST['tipo'];

// Obtener el ID del cliente desde la sesión
$id_cliente = $_SESSION['id'] ?? null;

if (!$id_cliente) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado."]);
    exit;
}

// Conectar a la base de datos
$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta();

try {
    // Verificar stock disponible del producto y obtener el precio
    $sql = "SELECT cantidad, precio FROM productos WHERE id = :id_producto";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(":id_producto", $id_producto, PDO::PARAM_INT);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo json_encode(["status" => "error", "message" => "Producto no encontrado."]);
        exit;
    }

    $stock_disponible = $producto['cantidad'];
    $precio_producto = $producto['precio']; // Guardar el precio
    if ($stock_disponible <= 0) {
        echo json_encode(["status" => "error", "message" => "Producto agotado. Solo se agrego el stoke disponible"]);
        exit;
    }

    $cantidad_a_vender = min($cantidad_solicitada, $stock_disponible);
    $total = $cantidad_a_vender * $precio_producto; // Calcular el total

    // Verificar si ya existe el producto en el carrito del cliente
    $sql = "SELECT cantidad, total FROM ventas WHERE id_cliente = :id_cliente AND id_producto = :id_producto AND estado = 'carro'";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(":id_cliente", $id_cliente, PDO::PARAM_INT);
    $stmt->bindValue(":id_producto", $id_producto, PDO::PARAM_INT);
    $stmt->execute();
    $venta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($venta) {
        // Si el producto ya está en el carrito, actualizar cantidad y total
        $nueva_cantidad = $venta['cantidad'] + $cantidad_a_vender;
        $nuevo_total = $nueva_cantidad * $precio_producto;

        $sql = "UPDATE ventas 
                SET cantidad = :cantidad, total = :total 
                WHERE id_cliente = :id_cliente 
                AND id_producto = :id_producto 
                AND estado = 'carro'";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":cantidad", $nueva_cantidad, PDO::PARAM_INT);
        $stmt->bindValue(":total", $nuevo_total, PDO::PARAM_STR);
        $stmt->bindValue(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->bindValue(":id_producto", $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(["status" => "success", "message" => "Cantidad actualizada en el carrito."]);
    } else {
        // Si el producto no está en el carrito, insertarlo como nuevo
        $sql = "INSERT INTO ventas (id_cliente, id_producto, cantidad, total, estado, precio) 
                VALUES (:id_cliente, :id_producto, :cantidad, :total, 'carro', :precio)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->bindValue(":id_producto", $id_producto, PDO::PARAM_INT);
        $stmt->bindValue(":cantidad", $cantidad_a_vender, PDO::PARAM_INT);
        $stmt->bindValue(":total", $total, PDO::PARAM_STR);
        $stmt->bindValue(":precio", $precio_producto, PDO::PARAM_STR); // Incluir el precio
        $stmt->execute();

        echo json_encode(["status" => "success", "message" => "Producto agregado al carrito."]);
    }

    // Actualizar stock en productos
    $sql = "UPDATE productos SET cantidad = cantidad - :cantidad WHERE id = :id_producto";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(":cantidad", $cantidad_a_vender, PDO::PARAM_INT);
    $stmt->bindValue(":id_producto", $id_producto, PDO::PARAM_INT);
    $stmt->execute();

    // Mensaje si hay stock limitado
    if ($cantidad_solicitada > $cantidad_a_vender) {
        echo json_encode(["status" => "warning", "message" => "Solo se agregaron $cantidad_a_vender unidades, stock limitado."]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error en la base de datos: " . $e->getMessage()]);
}

// Cerrar conexión
$stmt = null;
$conexion = null;
?>
