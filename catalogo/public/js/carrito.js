  $(document).ready(function () {
    $('.agregarCarrito').on('click', function () {
      const productoId = $(this).data('id');
      const productoNombre = $(this).data('nombre');
      const productoPrecio = $(this).data('precio');

      $.ajax({
        url: '../../backend/modules/carrito/agregar_carrito.php',
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
        url: '../../backend/modules/carrito/actualizar_cantidad.php',
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
    fetch(`../../backend/modules/carrito/eliminar_producto.php?id=${id}`)
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

document.getElementById("btnPagar").addEventListener("click", function () {
  fetch("../../catalogo/public/verificar_sesion.php")
    .then(response => response.json())
    .then(data => {
      if (data.logueado) {
        // Obtener productos del carrito
fetch("../../catalogo/public/obtener_carrito.php")
  .then(res => res.json())
  .then(data => {
    const carrito = Object.values(data);

if (!Array.isArray(carrito) || carrito.length === 0) {
  const alerta = document.getElementById("alertaCarritoVacío");
  if (alerta) {
    alerta.classList.remove("d-none");
    alerta.scrollIntoView({ behavior: "smooth" });
  }
  return;
} else {
  const alerta = document.getElementById("alertaCarritoVacío");
  if (alerta) {
    alerta.classList.add("d-none");
  }
}

    let total = 0;
    let html = '<ul class="list-group mb-3">';
    carrito.forEach(prod => {
      const subtotal = prod.precio * prod.cantidad;
      total += subtotal;

      html += `
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <h6 class="my-0">${prod.nombre}</h6>
            <small class="text-muted">Cantidad: ${prod.cantidad} x $${prod.precio}</small>
          </div>
          <span class="text-muted">$${subtotal.toFixed(2)}</span>
        </li>`;
    });
    html += '</ul>';

    document.getElementById("modalDetalle").innerHTML = html;
    document.getElementById("modalTotal").textContent = `$${total.toFixed(2)}`;

    new bootstrap.Modal(document.getElementById("modalPago")).show();
  })
  .catch(error => {
    console.error("Error al obtener el carrito:", error);
  });

    } else {
        // Redirigir al login si no está logueado
        window.location.href = "/BYTEZAR/login.html";
      }
    });
});

document.getElementById("confirmarPago").addEventListener("click", function () {
  const tipoPago = document.getElementById("tipoPago").value;

  if (!tipoPago) {
  const alerta = document.getElementById("alertaMetodoPago");
  alerta.classList.remove("d-none"); // mostrar alerta
  return;
} else {
  document.getElementById("alertaMetodoPago").classList.add("d-none"); // ocultar si está visible
}


  // Volver a obtener el carrito (por seguridad)
  fetch("../../catalogo/public/obtener_carrito.php")
    .then(res => res.json())
    .then(data => {
      const carrito = Object.values(data);

      if (!Array.isArray(carrito) || carrito.length === 0) {
        alert("El carrito está vacío.");
        return;
      }

      // Enviar carrito y tipo de pago al backend
      fetch("../../backend/modules/pagos/registrar_venta.php", {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          carrito: carrito,
          metodo_pago: tipoPago
        })
      })
      .then(res => res.json())
      .then(respuesta => {
        if (respuesta.exito) {          
          // Limpiar modal y recargar
          document.getElementById("modalDetalle").innerHTML = "";
          document.getElementById("modalTotal").textContent = "$0.00";
          document.getElementById("tipoPago").value = "";
          const modal = bootstrap.Modal.getInstance(document.getElementById("modalPago"));
            if (modal) {
              modal.hide();
            }

          window.location.href = "/BYTEZAR/compra_exitosa.php";
        } else {
          alert("Error: " + respuesta.mensaje);
        }
      })
      .catch(err => {
        console.error("Error al registrar la venta:", err);
      });
    });
});

