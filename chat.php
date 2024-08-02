<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['idcliente'])) {
    // Redirigir al usuario al login si no está identificado
    header("Location: login.php");
    exit();
}

$idcliente = $_SESSION['idcliente'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <div class="container mt-4">
        <h1>Chat</h1>
        <div id="chat" class="mb-3" style="border: 1px solid #ddd; padding: 10px; max-height: 400px; overflow-y: scroll;"></div>
        <form id="chatForm">
            <div class="mb-3">
                <textarea id="mensaje" name="mensaje" class="form-control" placeholder="Escribe tu mensaje" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            function cargarMensajes() {
                $.ajax({
                    url: 'gmensaje.php',
                    method: 'GET',
                    success: function(data) {
                        $('#chat').html(data);
                    }
                });
            }

            $('#chatForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'gmensaje.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(data) {
                        $('#mensaje').val('');
                        cargarMensajes();
                    }
                });
            });

            setInterval(cargarMensajes, 3000); // Recarga mensajes cada 3 segundos
        });
    </script>
</body>
</html>
