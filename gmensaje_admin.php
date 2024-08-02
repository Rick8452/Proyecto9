<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $respuesta = $conn->real_escape_string($_POST['respuesta']);
    $idcliente = intval($_POST['idcliente']); // Obtener el id del cliente de la solicitud POST
    $tipo = 'admin'; // Mensaje del administrador

    $sql = "INSERT INTO chat (fecha, idcliente, tipo, mensaje) VALUES (NOW(), $idcliente, '$tipo', '$respuesta')";
    $conn->query($sql);
} elseif (isset($_GET['idcliente'])) {
    $idcliente = intval($_GET['idcliente']); // Obtener el id del cliente de la solicitud GET

    $sql = "SELECT * FROM chat WHERE idcliente = $idcliente ORDER BY fecha DESC";
    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        echo "<div><strong>{$row['tipo']}:</strong> {$row['mensaje']} <small><i>{$row['fecha']}</i></small></div>";
    }
}

$conn->close();
?>
