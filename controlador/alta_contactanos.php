<?php
// Incluir la conexión a la base de datos
include_once "../modelo/servidor.php"; 

 $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
 $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
 $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
 $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
 $motivo = isset($_POST['motivo']) ? $_POST['motivo'] : '';
 $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';


// Validar que todos los datos estén presentes
if ($nombre && $apellidos && $correo && $telefono && $motivo && $mensaje) {
    try {
        // Conectar a la base de datos
        $cone = new Servidor("root", "proyecto", "");
        $conexion = $cone->conecta();

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO contactanos (nombre, apellidos, correo, telefono, motivo, mensaje) 
                VALUES (:nombre, :apellidos, :correo, :telefono, :motivo, :mensaje)";

        // Preparar la sentencia SQL
        $stmt = $conexion->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':motivo', $motivo);
        $stmt->bindParam(':mensaje', $mensaje);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Mensaje enviado exitosamente"; // Respuesta de éxito
        } else {
            echo "Error al enviar el mensaje"; // Respuesta de error
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Si hay un error con la base de datos
    }
} else {
    echo "Por favor, completa todos los campos."; // Respuesta si falta algún dato
}
?>
