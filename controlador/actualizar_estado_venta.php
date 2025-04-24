<?php
include_once "../modelo/servidor.php";

// Verificar si se recibió el id_cliente por POST
if (!isset($_POST['id_cliente'])) {
    $response["message"] = "ID de cliente no proporcionado.";
    echo json_encode($response);
    exit;
}

$id_cliente = intval($_POST['id_cliente']); // Convertir a entero para mayor seguridad

try {
    // Conectar a la base de datos
    $cone = new Servidor("root", "proyecto", "");
    $conexion = $cone->conecta();

    // Consulta SQL para actualizar los registros que cumplan las condiciones
    $sql = "UPDATE ventas 
            SET estado = 'entregado' 
            WHERE id_cliente = :id_cliente AND estado = 'pendiente'";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

    // Ejecutar y verificar si se actualizó al menos un registro
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $response["success"] = true;
        $response["message"] = "Estado actualizado correctamente.";
    } else {
        $response["message"] = "No se encontraron registros pendientes para actualizar.";
    }
} catch (PDOException $e) {
    $response["message"] = "Error de base de datos: " . $e->getMessage();
}

// Retornar respuesta en formato JSON
echo json_encode($response);
?>
