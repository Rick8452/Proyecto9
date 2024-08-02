<?php
session_start();
include 'db_connection.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT idcliente, email FROM clientes WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['idcliente'] = $row['idcliente'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['is_admin'] = (strpos($row['email'], '@admin.com') !== false);

        header("Location: index.php");
        exit();
    } else {
        $message = "Datos inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <div class="form-floating">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-floating">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Ingresar</button>
        </form>
        <p><?php echo $message; ?></p>
        <p><a href="registro.php">Registrar nuevo usuario</a></p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
