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

    // Obtener productos del carrito
    $carrito_sql = "SELECT c.idproducto, c.cantidad, c.precio, p.descripcion, p.urlimagen 
                    FROM carrito c 
                    INNER JOIN producto p ON c.idproducto = p.idproducto 
                    WHERE c.idcliente = $idcliente";
    $carrito_result = $conn->query($carrito_sql);

    $total = 0;
    $carrito_items = [];
    while ($row = $carrito_result->fetch_assoc()) {
        $carrito_items[] = $row;
        $total += $row['cantidad'] * $row['precio'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilo_carrito.css">
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
                            <a class="nav-link" href="login.php">Registro / Login</a>
                        </li>
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
</head>
<body>
    
    <div class="container mt-5">
        <h2>Carrito de Compras</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito_items as $item): ?>
                <tr>
                    <td><img src="<?php echo $item['urlimagen']; ?>" alt="<?php echo $item['descripcion']; ?>" class="img-thumbnail" style="width: 100px;"></td>
                    <td><?php echo $item['descripcion']; ?></td>
                    <td><?php echo $item['cantidad']; ?></td>
                    <td>$<?php echo $item['precio']; ?></td>
                    <td>$<?php echo $item['cantidad'] * $item['precio']; ?></td>
                    <td><a href="eliminar_del_carrito.php?idproducto=<?php echo $item['idproducto']; ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total: $<?php echo $total; ?></h3>
        <h3>Completa los siguientes datos para completar tu compra:</h3>
        <form action="procesar_pago.php" method="post">
            <div class="form-group">
                <label for="recibe">Nombre de quien recibe:</label>
                <input type="text" class="form-control" id="recibe" name="recibe" required>
            </div>
            <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" class="form-control" id="calle" name="calle" required>
            </div>
            <div class="form-group">
                <label for="colonia">Colonia:</label>
                <input type="text" class="form-control" id="colonia" name="colonia" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
            </div>
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control" id="municipio" name="municipio" required>
            </div>
            <div class="form-group">
                <label for="cp">Código Postal:</label>
                <input type="text" class="form-control" id="cp" name="cp" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary">Procesar Pago</button>
        </form>
    </div>
</body>
</html>
