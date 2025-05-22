$(document).ready(function () {
  // Agregar producto al carrito
  $(document).on('click', '.agregarCarrito', function () {
    const productoId = $(this).data('id');
    const productoNombre = $(this).data('nombre');
    const productoPrecio = $(this).data('precio');
    $.ajax({
      url: '../../backend/modules/carrito/agregar_carrito.php',
      type: 'POST',
      dataType: "json",
      data: {
        id: productoId,
        nombre: productoNombre,
        precio: productoPrecio
      },
      success: function (data) {
        if (data.success) {
          actualizarCarrito();
          mostrarMensaje(data.message, true);
          $('#carritoFlotante').addClass('destacado');
          setTimeout(function () {
            $('#carritoFlotante').removeClass('destacado');
          }, 500);
        } else {
          mostrarMensaje(data.message, false);
        }
      },
      error: function () {
        mostrarMensaje('Error al conectar con el servidor.', false);
      }
    });
  });

  // Cambiar cantidad (+/-)
  $('#productosCarrito').on('click', '.cambiarCantidad', function () {
    const id = $(this).data('id');
    const cambio = $(this).data('cambio');
    $.ajax({
      url: '../../backend/modules/carrito/actualizar_cantidad.php',
      method: 'POST',
      data: { id, cambio },
      success: function () {
        actualizarCarrito();
      }
    });
  });

  // Botón para eliminar producto
  $('#productosCarrito').on('click', '.eliminarProducto', function () {
    const id = $(this).data('id');
    $.ajax({
      url: '../../backend/modules/carrito/eliminar_producto.php?id=' + id,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        actualizarCarrito();
        if (data.success) {
          mostrarMensaje(data.message, true);
        } else {
          mostrarMensaje(data.message, false);
        }
      },
      error: function () {
        mostrarMensaje('Error al conectar con el servidor.', false);
      }
    });
  });

  // Abrir y cerrar carrito flotante
  $('#abrirCarritoBtn').on('click', function () {
    $('#carritoFlotante').css('right', '0');
  });
  $('#cerrarCarritoBtn').on('click', function () {
    if (window.innerWidth <= 576) {
      $('#carritoFlotante').css('right', '-100%');
    } else {
      $('#carritoFlotante').css('right', '-300px');
    }
  });
  // Ocultar carrito al cargar la página
  if (window.innerWidth <= 576) {
    $('#carritoFlotante').css('right', '-100%');
  } else {
    $('#carritoFlotante').css('right', '-300px');
  }

  // Mostrar detalle de compra en el modal usando AJAX
  function mostrarDetalleCompra() {
    $.get('includes/ver_carrito.php', function(html) {
      $('#detalleCompra').html(html);
    });
  }

// Mostrar detalle del carrito cuando se abre el modal
$('#modalPagar').on('show.bs.modal', mostrarDetalleCompra);

// Enfocar el select cuando se muestra completamente
$('#modalPagar').on('shown.bs.modal', function () {
  $('#metodoPago').focus();
});

// Enviar compra
$('#formCompra').on('submit', function(e) {
  e.preventDefault();

  const metodoPago = $('#metodoPago').val();
  if (!metodoPago) {
    alert('Seleccione un método de pago');
    return;
  }

  const $btn = $(this).find('button[type="submit"]');
  $btn.prop('disabled', true).text('Procesando...');

  $.ajax({
    url: '../../backend/modules/pagos/registrar_venta.php',
    method: 'POST',
    data: {
      metodo_pago: metodoPago
    },
    success: function(resp) {
      console.log("Respuesta del servidor:", resp);
      try {
        let data = JSON.parse(resp);
        console.log(data);
        if (data.success) {
          alert('¡Compra realizada con éxito!');
          $('#modalPagar').modal('hide'); // ✅ Cierra el modal
          actualizarCarrito();
          location.reload(); // ✅ Refresca la página
        } else if (data.redirect) {
          // Redirige al login si no está logueado
          window.location.href = data.redirect;
        } else {
          alert('Error: ' + data.message);
          $btn.prop('disabled', false).text('Confirmar compra');
        }
      } catch (error) {
        console.error("JSON inválido:", resp);
        alert('Error inesperado: ' + error.message);
      }
    },
    error: function () {
      alert('Error al conectar con el servidor.');
      $btn.prop('disabled', false).text('Confirmar compra');
    }
  });
});

// Validación y apertura del modal desde botón "Pagar"
$('#pagarBtn').on('click', function () {
  if (typeof usuarioLogueado !== "undefined" && !usuarioLogueado) {
    alert('Debes iniciar sesión para realizar la compra.');
    window.location.href = '../../login.html?redirect=catalogo/public/catalogo.php';
    return;
  }

  // Cerrar carrito flotante
  const offset = window.innerWidth <= 576 ? '-100%' : '-300px';
  $('#carritoFlotante').css('right', offset);

  // Mostrar modal
  $('#modalPagar').modal('show');
});

// Cambiar cantidad desde el modal
$('#detalleCompra').on('click', '.cambiarCantidad', function () {
  const id = $(this).data('id');
  const cambio = $(this).data('cambio');
  $.ajax({
    url: '../../backend/modules/carrito/actualizar_cantidad.php',
    method: 'POST',
    data: { id, cambio },
    success: function () {
      // Actualiza tanto el modal como el carrito flotante
      mostrarDetalleCompra();
      actualizarCarrito();
    }
  });
});

// Eliminar producto desde el modal
$('#detalleCompra').on('click', '.eliminarProducto', function () {
  const id = $(this).data('id');
  $.ajax({
    url: '../../backend/modules/carrito/eliminar_producto.php?id=' + id,
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      mostrarDetalleCompra();
      actualizarCarrito();
      if (data.success) {
        mostrarMensaje(data.message, true);
      } else {
        mostrarMensaje(data.message, false);
      }
    },
    error: function () {
      mostrarMensaje('Error al conectar con el servidor.', false);
    }
  });
});


  // Actualizar carrito (cargar productos)
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
        $('#contadorCarrito').text(total);
        if (total === 0) {
          $('#contadorCarrito').text('0').show();
        }
      }
    });
  }

  // Cargar carrito al iniciar
  actualizarCarrito();

  // Mensaje flotante
  function mostrarMensaje(texto, exito) {
    const div = document.createElement("div");
    div.textContent = texto;
    div.className = "mensaje" + (exito ? "" : " error");
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000);
  }
});