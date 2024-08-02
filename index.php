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
    <title>R&S Creaciones</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <style>
      .carousel-container {
          max-width: 100%;
          margin: 0 auto;
      }
      .carousel-inner img {
          width: 100%;
          height: auto;
      }
      .navbar-brand img {
          width: 50px; /* Ajusta el tamaño del logo según sea necesario */
          height: auto;
          margin-right: 10px; /* Espacio entre el logo y el texto */
      }
      
    </style>
</head>
<body>
    <header>
        <!-- Encabezado -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">
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
                        <li class="nav-item">
                          <a  class="nav-link" href="carrito.php"><img src="img/carrito.png" alt="Carrito" style="width: 30px;"></a>
                          
                      </li>
                    </ul>
                  
                </div>
            </div>
        </nav>
    </header>

    <main>
    

        <div class="carousel-container">
          <div id="carouselExample" class="carousel slide">
              <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img src="./docs/Creaciones2.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                      <img src="./docs/Creaciones.png" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                      <img src="./docs/Creaciones2.jpg" class="d-block w-100" alt="...">
                  </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
              </button>
          </div>
      </div>
      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img class="rounded-circle" src="./docs/personalizacion.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Personalización</h2>
            <p>Tus productos pueden ser totalmente personalizados para adaptarse a los gustos y necesidades de tus clientes. Desde el diseño hasta el tamaño y los materiales, cada artículo puede ser único.</p>
            
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="./docs/presicion.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Precisión</h2>
            <p>La máquina CNC de router permite una precisión milimétrica en el corte, grabado y modelado de materiales, lo que garantiza resultados consistentes y de alta calidad en cada producto.</p>
            
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="./docs/eficiencia.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Eficiencia</h2>
            <p>La automatización de la máquina CNC de router permite una producción eficiente y rápida de tus productos, lo que te permite cumplir con plazos de entrega ajustados y satisfacer la demanda de tus clientes.</p>
          
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Diseños complejos. <span class="text-muted">Dejate llevar por tu imaginacion..!</span></h2>
            <p class="lead">La tecnología CNC te permite crear diseños intrincados y detallados que serían difíciles o imposibles de lograr con métodos tradicionales de fabricación. Esto te permite destacar en el mercado con productos únicos y sorprendentes.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="./docs/diseños.jpg" data-holder-rendered="true" style="width: 500px; height: 500px;">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Variedad de materiales. <span class="text-muted">Trabajamos en madera, plástico, metal, acrílico y más.</span></h2>
            <p class="lead">Puedes trabajar con una amplia gama de materiales, incluyendo madera, plástico, metal, acrílico y más. Esto te permite crear una variedad de productos, desde decoraciones para el hogar hasta accesorios de moda y piezas de arte.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="./docs/materiales.jpg" data-holder-rendered="true" style="width: 500px; height: 500px;">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Calidad constante. <span class="text-muted">Nos inspiramos en cada trabajo.</span></h2>
            <p class="lead">Gracias a la precisión y la repetibilidad de la máquina CNC, puedes garantizar una calidad constante en todos tus productos, lo que ayuda a construir una reputación sólida y la lealtad de los clientes.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="./docs/calidad.jpg" data-holder-rendered="true" style="width: 500px; height: 500px;">
          </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div>
    </main>

    <footer>
        <!-- Pie de página -->
        <p>Derechos reservados &copy; 2024 R&S Creaciones</p>
    </footer>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- Mostrar el session_id() -->
    <p>Session ID: <?php echo session_id(); ?></p>

</body>
</html>
