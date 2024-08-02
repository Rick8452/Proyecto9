<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $comentarios = $conn->real_escape_string($_POST['comentarios']);

    $sql = "INSERT INTO contacto (nombre, email, telefono, comentarios) VALUES ('$nombre', '$email', '$telefono', '$comentarios')";

    if ($conn->query($sql) === TRUE) {
        $message = "Mensaje guardado exitosamente.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Contacto</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
    <header>
        <!-- Encabezado -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">R&S Creaciones</a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Mensaje de resultado -->
        <h1><?php echo $message; ?></h1>
        <a href="index.php" class="btn btn-primary">Volver al inicio</a>
    </main>

    <footer>
        <!-- Pie de página -->
        <p>Derechos reservados &copy; 2024 R&S Creaciones</p>
    </footer>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
