<?php 
session_start(); 

if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = "Sin identificar";
} else {
    if (isset($_REQUEST['nombre'])) { 
        $_SESSION['nombre'] = $_REQUEST['nombre'];
        $_SESSION['tipo'] = $_REQUEST['tipo'];
        $_SESSION['id'] = $_REQUEST['id'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abarrotes Salazar</title>
    <link rel="stylesheet" href="css/encabezado.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="Logo">
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Inicio</a></li>
                <li class="dropdown">
                    <a href="#">Catalogo ▼</a>
                    <ul class="dropdown-menu">
                        <li><a href="productos.php?categoria=fresco">Frescos</a></li>
                        <li><a href="productos.php?categoria=enlatado">Enlatados</a></li>
                        <li><a href="productos.php?categoria=bebidas">Bebidas</a></li>
                        <li><a href="productos.php?categoria=snacks">Snacks</a></li>
                        <li><a href="productos.php?categoria=limpieza">Limpieza</a></li>
                    </ul>
                </li>
                <li><a href="nosotros.php">Nosotros</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador'): ?>
                    <li class="dropdown">
                        <a href="#" >Admin ▼</a>
                        <ul class="dropdown-menu">
                        <li><a href="mantenimientoproductos.php">CRUD</a></li>
                        <li><a href="ventas_activas.php">Ventas activas</a></li>
                        <li><a href="ventas_completadas.php">Ventas Completadas</a></li>
                        <li><a href="mensajes.php">Mensajes</a></li>
                        </ul>
                    </li>
                    
                <?php endif; ?>
                <li><a href="login.php">Login</a></li>
            </ul>
            <div class="user-info">
                <img src="img/usuario.png" alt="Usuario">
                <span><?php echo $_SESSION['nombre']; ?></span>
                <?php if ($_SESSION['nombre'] !== "Sin identificar"): ?>
                    <form method="post" action="../controlador/salir.php">
                        <button type="submit" name="cerrar_sesion">Cerrar sesión</button>
                    </form>
                <?php endif; ?>
            </div>
            <?php if ($_SESSION['nombre'] !== "Sin identificar"): ?>
                <div class="cart-icon">
                    <a href="carrito.php">
                        <img src="img/carrito.png" alt="Carrito de compras">
                    </a>
                    <a href="historial_compras.php">
                        <img src="img/historial.png" alt="Historial" srcset="">
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</body>
</html>
