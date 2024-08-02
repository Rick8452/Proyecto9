<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];

// Obtener idcliente basado en el email del usuario
$cliente_sql = "SELECT idcliente FROM clientes WHERE email = '$email'";
$cliente_result = $conn->query($cliente_sql);

if ($cliente_result->num_rows > 0) {
    $cliente = $cliente_result->fetch_assoc();
    $idcliente = $cliente['idcliente'];

    // Verificar que los campos necesarios estén en $_POST
    if (isset($_POST['recibe']) && isset($_POST['calle']) && isset($_POST['colonia']) &&
        isset($_POST['estado']) && isset($_POST['municipio']) && isset($_POST['cp']) && isset($_POST['telefono'])) {

        $fecha = date('Y-m-d H:i:s');
        $recibe = $_POST['recibe'];
        $calle = $_POST['calle'];
        $colonia = $_POST['colonia'];
        $estado = $_POST['estado'];
        $municipio = $_POST['municipio'];
        $cp = $_POST['cp'];
        $telefono = $_POST['telefono'];

        // Insertar en la tabla "pedido"
        $pedido_sql = "INSERT INTO pedido (fecha, idcliente, recibe, calle, colonia, estado, municipio, cp, telefono) 
                       VALUES ('$fecha', '$idcliente', '$recibe', '$calle', '$colonia', '$estado', '$municipio', '$cp', '$telefono')";
        if ($conn->query($pedido_sql) === TRUE) {
            $idpedido = $conn->insert_id;

            // Insertar en la tabla "detallepedido"
            $carrito_sql = "SELECT idproducto, cantidad, precio FROM carrito WHERE idcliente = $idcliente";
            $carrito_result = $conn->query($carrito_sql);

            while ($row = $carrito_result->fetch_assoc()) {
                $idproducto = $row['idproducto'];
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];

                $detallepedido_sql = "INSERT INTO detallepedido (idpedido, idproducto, cantidad, precio) 
                                      VALUES ('$idpedido', '$idproducto', '$cantidad', '$precio')";
                $conn->query($detallepedido_sql);
            }

            // Vaciar la tabla "carrito" para el usuario actual
            $vaciar_carrito_sql = "DELETE FROM carrito WHERE idcliente = $idcliente";
            $conn->query($vaciar_carrito_sql);

            echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Pedido Procesado</title>
    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <script>
        function showAlertAndRedirect() {
            alert('Pedido procesado con éxito. Gracias por tu compra.');
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 5000); // Redirigir después de 5 segundos
        }
    </script>
</head>
<body onload='showAlertAndRedirect()'>
    <div class='container mt-5'>
        <div class='alert alert-success' role='alert'>
            Pedido procesado con éxito. Gracias por tu compra.
        </div>
    </div>
</body>
</html>";
        } else {
            echo "Error al procesar el pedido: " . $conn->error;
        }
    } else {
        echo "Faltan campos necesarios para procesar el pedido.";
    }
} else {
    echo "No se encontró el cliente.";
}

$conn->close();
?>
