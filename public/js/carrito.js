  $(document).ready(function () {
    $('.agregarCarrito').on('click', function () {
      const productoId = $(this).data('id');
      const productoNombre = $(this).data('nombre');
      const productoPrecio = $(this).data('precio');

      $.ajax({
        url: '../backend/modules/carrito/agregar_carrito.php',
        type: 'POST',
        data: {
          id: productoId,
          nombre: productoNombre,
          precio: productoPrecio
        },
        success: function () {
          actualizarCarrito();
          // Animación visual del carrito flotante
         $('#carritoFlotante').addClass('destacado');
         
         setTimeout(function () {
           $('#carritoFlotante').removeClass('destacado');
         }, 500);

        },
        error: function () {
          alert('Error al agregar el producto al carrito.');
        }
      });
    });

        // Escuchar clicks en botones + y -
    $('#productosCarrito').on('click', '.cambiarCantidad', function () {
      const indice = $(this).data('indice');
      const cambio = $(this).data('cambio');
    
      $.ajax({
        url: '../backend/modules/carrito/actualizar_cantidad.php',
        method: 'POST',
        data: { indice, cambio },
        success: function () {
          actualizarCarrito(); // Recargar la vista del carrito
        }
      });
    });
    

    $('#abrirCarritoBtn').on('click', function () {
      $('#carritoFlotante').css('right', '0');
    });

    $('#cerrarCarritoBtn').on('click', function () {
      $('#carritoFlotante').css('right', '-300px');
    });

    function actualizarCarrito() {
  $.ajax({
    url: 'includes/ver_carrito.php',
    type: 'GET',
    success: function (response) {
      $('#productosCarrito').html(response);

      // Contar la cantidad total de productos
      let total = 0;
      $('#productosCarrito .producto').each(function () {
        const cantidadTexto = $(this).find('strong').text().match(/Cantidad:\s*(\d+)/);
        if (cantidadTexto && cantidadTexto[1]) {
          total += parseInt(cantidadTexto[1]);
        }
      });
      // Mostrar el total en el badge
      $('#contadorCarrito').text(total);
      
      // Si no hay productos, asegurarse de que el contador siga visible con 0
      if (total === 0) {
        $('#contadorCarrito').text('0').show();
      }

      // Mostrar el total en el badge
      $('#contadorCarrito').text(total);
    }
  });
}
    // Cargar carrito al iniciar
    actualizarCarrito();
  });