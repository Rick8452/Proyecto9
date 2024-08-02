<?php

$nombre_producto = "Diseños con Router CNC";
$descripcion = "En R&S Creaciones, nos especializamos en la producción de artículos personalizados y de alta calidad utilizando tecnología avanzada de corte y grabado con máquinas CNC de router. Ofrecemos una amplia variedad de productos, desde decoraciones y muebles hasta accesorios y piezas de arte, todos diseñados con precisión y adaptados a tus necesidades. Nuestra capacidad de trabajar con diferentes materiales y crear diseños intrincados nos permite ofrecer productos únicos y personalizados para cada cliente.";
$precio = "$2,000.00";
$existencia = 10;
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
                <a class="navbar-brand" href="index.html">
                    <img src="ruta/a/tu/logo.png" alt="Logo de R&S Creaciones">
                    Bienvenido a R&S Creaciones Tienda Virtual
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="producto.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.html">Contacto</a>
                        </li>
                    </ul>
                  
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- Contenido principal -->
        <h1><?php echo $nombre_producto; ?></h1>
        <div class="carousel-container">
          <div id="carouselExample" class="carousel slide">
              <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img src="./docs/Creaciones.png" class="d-block w-100" alt="Imagen del producto">
                  </div>
                </div>
            </div>
        </div>
        
        <h2>Audio con la descripcion del producto</h2>
        <audio controls>
            <source src="docs/audio.ogg" type="audio/ogg">
            Tu navegador no soporta el elemento de audio.
        </audio>
        <h2>Video de nuestros trabajos</h2>
        <div class="embed-responsive embed-responsive-21by9">
         <iframe class="embed-responsive-item" src="docs/videoAG1.mp4" allowfullscreen></iframe>
        </div>

        <h2>Descripción:</h2>
        <p><?php echo $descripcion; ?></p>
        <h2>Precio:</h2>
        <p><?php echo $precio; ?></p>
        <h2>Existencia:</h2>
        <p><?php echo $existencia; ?></p>
    </main>

    <footer>
        <!-- Pie de página -->
        <p>Derechos reservados &copy; 2024 R&S Creaciones</p>
    </footer>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
