<?php
session_start();
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connection.php';

    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $comentarios = $conn->real_escape_string($_POST['comentarios']);

    $sql = "INSERT INTO contacto (nombre, email, telefono, comentarios) VALUES ('$nombre', '$email', '$telefono', '$comentarios')";

    if ($conn->query($sql) === TRUE) {
        $message = "Su mensaje ha sido guardado correctamente.";
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
    <title>R&S Creaciones - Contacto</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <style>
      .carousel-container {
          max-width: 100%;
          margin: 0 auto;
      }
      .carousel-inner img {
          width: 100%;
          height: auto;
      }
      .navbar-brand img {
          width: 50px; /* Ajusta el tamaño del logo según sea necesario */
          height: auto;
          margin-right: 10px; /* Espacio entre el logo y el texto */
      }
    </style>
</head>
<body>
    <header>
        <!-- Encabezado -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.png" alt="Logo de R&S Creaciones">
                    Bienvenido a R&S Creaciones Tienda Virtual
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="chat.php">Chat</a></li>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- Formulario de contacto -->
        <h1>Contacto</h1>
        <?php if ($message): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="contacto.php" method="post">
            <div class="mb-3">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" class="form-control" required><br>
            </div>
            <div class="mb-3">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" class="form-control" required><br>
            </div>
            <div class="mb-3">
                <label for="telefono">Teléfono:</label><br>
                <input type="text" id="telefono" name="telefono" class="form-control" required><br>
            </div>
            <div class="mb-3">
                <label for="comentarios">Comentarios:</label><br>
                <textarea id="comentarios" name="comentarios" rows="4" cols="50" class="form-control" required></textarea><br>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </main>

    <footer>
        <!-- Pie de página -->
        <p>Derechos reservados &copy; 2024 R&S Creaciones</p>
    </footer>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
