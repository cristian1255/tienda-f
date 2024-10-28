<?php
session_start();
if ($_SESSION['perfil'] !== 'empleado') {
    header("Location: login.php");
    exit();
}
echo "Bienvenido, Jeremy. Puedes ver el inventario y las ventas, pero no puedes modificarlos.";
// Aquí puedes agregar acciones de solo lectura
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">

        <!-- Botones de funcionalidades -->
        <div class="button-group">
            <a href="categorias.php" class="btn">Categorias</a>
            <a href="ventas.php" class="btn">Ventas</a>
            <a href="clientes.php" class="btn">Clientes</a>
        </div>
        <div class="button-group">
            <a href="detalles_venta.php" class="btn">Detalles_ventas</a>
            <a href="registrar_productos.php" class="btn">Productos</a>
        </div>
        <!-- Botón para cerrar sesión -->
        <div class="button-group">
            <form method="POST" action="cerrar_sesion.php">
                <button type="submit" class="btn cerrar-sesion">Cerrar Sesión</button>
            </form>
        </div> 
    </div>
</body>
</html>
