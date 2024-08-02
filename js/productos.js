// Seleccionar todos los elementos con la clase 'nav-link' (botones de categorías)
const botonesCategorias = document.querySelectorAll('.nav-link');

// Iterar sobre cada botón de categoría
botonesCategorias.forEach(boton => {
    // Agregar evento de mouseover para hacer zoom al pasar el mouse sobre el botón
    boton.addEventListener('mouseover', () => {
        boton.style.transform = 'scale(1.1)'; // Aumentar tamaño al 110%
    });

    // Agregar evento de mouseout para volver al tamaño original cuando el mouse sale del botón
    boton.addEventListener('mouseout', () => {
        boton.style.transform = 'scale(1)'; // Restablecer tamaño original
    });
});

// Seleccionar todas las tarjetas de productos
const tarjetasProductos = document.querySelectorAll('.card');

// Iterar sobre cada tarjeta de producto
tarjetasProductos.forEach(tarjeta => {
    // Agregar evento de mouseover para hacer zoom al pasar el mouse sobre la tarjeta
    tarjeta.addEventListener('mouseover', () => {
        tarjeta.style.transform = 'scale(1.1)'; // Aumentar tamaño al 110%
    });

    // Agregar evento de mouseout para volver al tamaño original cuando el mouse sale de la tarjeta
    tarjeta.addEventListener('mouseout', () => {
        tarjeta.style.transform = 'scale(1)'; // Restablecer tamaño original
    });
});
