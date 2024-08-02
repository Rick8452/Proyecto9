<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['idproducto'])) {
    $idproducto = intval($_GET['idproducto']);
    $email = $_SESSION['email'];

    // Obtener idcliente basado en el email del usuario
    $cliente_sql = "SELECT idcliente FROM clientes WHERE email = '$email'";
    $cliente_result = $conn->query($cliente_sql);

    if ($cliente_result->num_rows > 0) {
        $cliente = $cliente_result->fetch_assoc();
        $idcliente = $cliente['idcliente'];

        // Eliminar el producto del carrito
        $delete_sql = "DELETE FROM carrito WHERE idcliente = $idcliente AND idproducto = $idproducto";
        $conn->query($delete_sql);
    }
}

header('Location: carrito.php');
exit();
?>
