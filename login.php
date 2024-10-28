<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$host = "localhost";
$user = "root"; // Cambiar si es necesario
$pass = "";     // Cambiar si es necesario
$dbname = "tienda-f";

$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['nombre_usuario'];
    $password = $_POST['contraseña'];
    $perfil = $_POST['perfil'];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuario WHERE nombre_usuario = ? AND contraseña = ? AND perfil = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $usuario, $password, $perfil);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario autenticado correctamente
        $_SESSION['nombre_usuario'] = $usuario;
        $_SESSION['perfil'] = $perfil;

        // Redirigir según el perfil
        switch ($perfil) {
            case 'root':
                header("Location: root.php");
                break;
            case 'secretaria':
                header("Location: lorena.php");
                break;
            case 'gerente':
                header("Location: cristian.php");
                break;
            case 'empleado':
                header("Location: jeremy.php");
                break;
            default:
                echo "Perfil no reconocido.";
        }
        exit();
    } else {
        // Credenciales incorrectas
        echo "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tienda F</title>
    
        <link rel="stylesheet" type="text/css" href="styles.css">
    
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form method="POST" action="">
            <label for="nombre_usuario">Usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>

            <label for="perfil">Perfil:</label>
            <select id="perfil" name="perfil" required>
            <option value="selecciona">Seleciona perfil</option>
                <option value="root">Root</option>
                <option value="secretaria">Secretaria</option>
                <option value="gerente">Gerente</option>
                <option value="empleado">Empleado</option>
            </select>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
