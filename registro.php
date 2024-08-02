<?php
include 'db_connection.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);
    $nombre = $conn->real_escape_string($_POST['nombre']);

    if ($password !== $confirm_password) {
        $message = "Las contraseñas no coinciden";
    } else {
        $sql = "SELECT * FROM clientes WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $message = "Este email ya está registrado";
        } else {
            $sql = "INSERT INTO clientes (email, password, nombre) VALUES ('$email', '$password', '$nombre')";
            if ($conn->query($sql) === TRUE) {
                $message = "Registro exitoso";
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>

    <div class="form-container">
        <h2>Registro</h2>
        <form method="POST" action="registro.php">
            <div class="form-floating">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-floating">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-floating">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-floating">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <button type="submit">Registrar</button>
        </form>
        <p><?php echo $message; ?></p>
        <p><a href="login.php">Volver al login</a></p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
