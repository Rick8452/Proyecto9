<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['idcliente'])) {
    echo "No has iniciado sesión.";
    exit();
}

$idcliente = $_SESSION['idcliente'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mensaje = $conn->real_escape_string($_POST['mensaje']);
    $tipo = 'cliente'; // Mensaje del cliente

    $sql = "INSERT INTO chat (fecha, idcliente, tipo, mensaje) VALUES (NOW(), $idcliente, '$tipo', '$mensaje')";
    $conn->query($sql);
} else {
    $sql = "SELECT * FROM chat WHERE idcliente = $idcliente ORDER BY fecha DESC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div><strong>{$row['tipo']}:</strong> {$row['mensaje']} <small><i>{$row['fecha']}</i></small></div>";
    }
}

$conn->close();
?>
