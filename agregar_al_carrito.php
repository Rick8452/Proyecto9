<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['email'])) {
    echo "Por favor, inicia sesión para agregar productos al carrito.";
    exit();
}

if (isset($_POST['idproducto'])) {
    $idproducto = intval($_POST['idproducto']);
    $email = $_SESSION['email'];

    // Obtener idcliente basado en el email del usuario
    $cliente_sql = "SELECT idcliente FROM clientes WHERE email = '$email'";
    $cliente_result = $conn->query($cliente_sql);

    if ($cliente_result->num_rows > 0) {
        $cliente = $cliente_result->fetch_assoc();
        $idcliente = $cliente['idcliente'];

        // Verificar si el producto ya está en el carrito
        $carrito_sql = "SELECT * FROM carrito WHERE idcliente = $idcliente AND idproducto = $idproducto";
        $carrito_result = $conn->query($carrito_sql);

        if ($carrito_result->num_rows > 0) {
            // El producto ya está en el carrito, incrementar la cantidad
            $carrito = $carrito_result->fetch_assoc();
            $cantidad = $carrito['cantidad'] + 1;
            $update_sql = "UPDATE carrito SET cantidad = $cantidad WHERE idcliente = $idcliente AND idproducto = $idproducto";
            $conn->query($update_sql);
            echo "Cantidad del producto incrementada en el carrito.";
        } else {
            // El producto no está en el carrito, agregarlo
            $producto_sql = "SELECT precio FROM producto WHERE idproducto = $idproducto";
            $producto_result = $conn->query($producto_sql);

            if ($producto_result->num_rows > 0) {
                $producto = $producto_result->fetch_assoc();
                $precio = $producto['precio'];
                $fechahora = date('Y-m-d H:i:s');

                $insert_sql = "INSERT INTO carrito (idcliente, idproducto, cantidad, precio, fechahora) VALUES ($idcliente, $idproducto, 1, $precio, '$fechahora')";
                $conn->query($insert_sql);
                echo "Producto agregado al carrito.";
            }
        }
    } else {
        echo "Error al obtener la información del cliente.";
    }
} else {
    echo "Producto no especificado.";
}

$conn->close();
?>
