<?php
session_start();
include 'db_connection.php';

if (isset($_SESSION['message'])) {
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']); // Borrar el mensaje después de mostrarlo
}

// Obtener categorías
$categorias_sql = "SELECT * FROM categorias";
$categorias_result = $conn->query($categorias_sql);

// Construir la consulta SQL de productos
$productos_sql = "SELECT * FROM producto";
if (isset($_GET['categoria'])) {
    $categoria_id = intval($_GET['categoria']);
    $productos_sql .= " WHERE idcategoria = $categoria_id";
}
if (isset($_GET['search'])) {
    $search_term = $conn->real_escape_string($_GET['search']);
    if (strpos($productos_sql, 'WHERE') !== false) {
        $productos_sql .= " AND descripcion LIKE '%$search_term%'";
    } else {
        $productos_sql .= " WHERE descripcion LIKE '%$search_term%'";
    }
}
$productos_result = $conn->query($productos_sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilo_productos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .navbar-nav {
            margin-left: auto;
        }
        .search-section {
            margin-left: auto;
            display: flex;
            align-items: center;
        }
        .carrito-icon {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="productos.php">Tienda</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php while($row = $categorias_result->fetch_assoc()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?categoria=<?php echo $row['idcategoria']; ?>"><?php echo $row['descripcion']; ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <div class="search-section">
                    <form class="form-inline my-2 my-lg-0" action="productos.php" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Registro / Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php">
                            <img src="img/carrito.png" alt="Carrito" style="width: 30px;">
                            <?php
                            // Obtener el número de productos en el carrito para el usuario actual
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];
                                $cliente_sql = "SELECT idcliente FROM clientes WHERE email = '$email'";
                                $cliente_result = $conn->query($cliente_sql);
                                if ($cliente_result->num_rows > 0) {
                                    $cliente = $cliente_result->fetch_assoc();
                                    $idcliente = $cliente['idcliente'];
                                    $carrito_sql = "SELECT SUM(cantidad) AS total_productos FROM carrito WHERE idcliente = $idcliente";
                                    $carrito_result = $conn->query($carrito_sql);
                                    if ($carrito_result->num_rows > 0) {
                                        $carrito = $carrito_result->fetch_assoc();
                                        $total_productos = $carrito['total_productos'];
                                        echo "<span class='badge badge-pill badge-primary'>$total_productos</span>";
                                    }
                                }
                            }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <main class="container mt-5">
        <div class="row">
            <?php while($row = $productos_result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm zoom">
                        <img src="<?php echo $row['urlimagen']; ?>" class="card-img-top" alt="<?php echo $row['descripcion']; ?>">
                        <div class="card-body">
                            <p class="card-text"><?php echo $row['descripcion']; ?></p>
                            <p class="card-text">$<?php echo $row['precio']; ?></p>
                            <form class="add-to-cart-form" method="POST">
                                <input type="hidden" name="idproducto" value="<?php echo $row['idproducto']; ?>">
                                <button type="button" class="btn btn-primary add-to-cart-btn">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer class="text-center mt-5">
        <p>Derechos reservados &copy; 2024 Tienda</p>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart-btn').on('click', function() {
                var form = $(this).closest('form');
                var idproducto = form.find('input[name="idproducto"]').val();

                $.ajax({
                    url: 'agregar_al_carrito.php',
                    method: 'POST',
                    data: { idproducto: idproducto },
                    success: function(response) {
                        alert(response);
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
