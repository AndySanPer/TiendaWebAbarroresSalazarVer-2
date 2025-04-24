<?php
include_once "../modelo/servidor.php"; 

// Crear la conexión usando la clase Servidor
$cone = new Servidor("root", "proyecto", ""); 
$conexion = $cone->conecta();

if (!$conexion) {
    echo json_encode(["status" => "error", "message" => "Error de conexión a la base de datos."]);
    exit();
}

// Verificar si se recibe el id_cliente por POST
if (!isset($_POST['id_cliente'])) {
    echo json_encode(["status" => "error", "message" => "ID de cliente no recibido."]);
    exit();
}

$id_cliente = intval($_POST['id_cliente']); // Asegurar que es un número entero

try {
    // Preparar la consulta para actualizar el estado de "carro" a "pendiente"
    $query = "UPDATE ventas SET estado = 'pendiente' WHERE id_cliente = :id_cliente AND estado = 'carro'";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Estado actualizado correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo actualizar el estado."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Error en la consulta: " . $e->getMessage()]);
}

$conexion = null; // Cerrar conexión
?>
