<?php
session_start();
include 'db_connection.php';

$sql = "SELECT * FROM chat ORDER BY fecha ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div><strong>{$row['idcliente']}:</strong> {$row['mensaje']}</div>";
    }
} else {
    echo "<div>No hay mensajes aún.</div>";
}

$conn->close();
?>
