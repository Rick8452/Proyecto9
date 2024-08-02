<?php
include 'db_connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Chat</title>
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
        <h1>Admin - Chat</h1>
        <div>
            <label for="cliente">Seleccionar Cliente:</label>
            <select id="cliente" class="form-select mb-3">
                <option value="">Selecciona un cliente</option>
                <?php
                $sql = "SELECT DISTINCT idcliente FROM chat";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['idcliente']}'>Cliente {$row['idcliente']}</option>";
                }
                ?>
            </select>
        </div>
        <div id="chat" class="mb-3" style="border: 1px solid #ddd; padding: 10px; max-height: 400px; overflow-y: scroll;"></div>
        <form id="adminForm">
            <div class="mb-3">
                <textarea id="respuesta" name="respuesta" class="form-control" placeholder="Escribe tu respuesta" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            function cargarMensajes(idcliente) {
                if (idcliente) {
                    $.ajax({
                        url: 'gmensaje_admin.php',
                        method: 'GET',
                        data: { idcliente: idcliente },
                        success: function(data) {
                            $('#chat').html(data);
                        }
                    });
                } else {
                    $('#chat').html('');
                }
            }
            
            $('#cliente').on('change', function() {
                var idcliente = $(this).val();
                cargarMensajes(idcliente);
            });

            $('#adminForm').on('submit', function(e) {
                e.preventDefault();
                var idcliente = $('#cliente').val();
                if (idcliente) {
                    $.ajax({
                        url: 'gmensaje_admin.php',
                        method: 'POST',
                        data: $(this).serialize() + '&idcliente=' + idcliente,
                        success: function(data) {
                            $('#respuesta').val('');
                            cargarMensajes(idcliente);
                        }
                    });
                } else {
                    alert('Por favor selecciona un cliente');
                }
            });

            setInterval(function() {
                var idcliente = $('#cliente').val();
                cargarMensajes(idcliente);
            }, 3000); // Recarga mensajes cada 3 segundos
        });
    </script>
</body>
</html>