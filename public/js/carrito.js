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
      const id = $(this).data('id');
      const cambio = $(this).data('cambio');
    
      $.ajax({
        url: '../backend/modules/carrito/actualizar_cantidad.php',
        method: 'POST',
        data: { id, cambio },
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

  // Botón para eliminar producto
function eliminarDelCarrito(id) {
    fetch(`../backend/modules/carrito/eliminar_producto.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const item = document.getElementById(`producto-${id}`);
                
                if (item) {
                    item.classList.add('fade-out');
                    setTimeout(() => item.remove(), 500);
                }

                if (data.nuevoTotal !== undefined) {
                    document.getElementById("total-carrito").textContent = "$" + data.nuevoTotal;
                }

                if (data.nuevaCantidad !== undefined) {
                    const contador = document.getElementById("contadorCarrito");
                    contador.textContent = data.nuevaCantidad;
                    if (data.nuevaCantidad === 0) {
                        contador.textContent = "0";
                        contador.style.display = "inline-block";
                    }
                }

                mostrarMensaje(data.message, true);
            } else {
                mostrarMensaje(data.message, false);
            }
        }).catch(() => mostrarMensaje("Error al conectar.", false));
}

// Mensaje flotante
function mostrarMensaje(texto, exito) {
    const div = document.createElement("div");
    div.textContent = texto;
    div.className = "mensaje" + (exito ? "" : " error");
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000);
}

