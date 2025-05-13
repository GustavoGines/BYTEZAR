<?php
require '../backend/config/db.php';

// Obtener categorías
$queryCategorias = "SELECT DISTINCT categoria FROM productos";
$stmtCategorias = $pdo->query($queryCategorias);
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

// Filtrar categoría seleccionada
$categoriaSeleccionada = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Obtener productos
if (!empty($categoriaSeleccionada)) {
    $queryProductos = "SELECT * FROM productos WHERE categoria = :categoria";
    $stmtProductos = $pdo->prepare($queryProductos);
    $stmtProductos->bindParam(':categoria', $categoriaSeleccionada, PDO::PARAM_STR);
    $stmtProductos->execute();
} else {
    $queryProductos = "SELECT * FROM productos";
    $stmtProductos = $pdo->query($queryProductos);
}

$productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo de Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/styles.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container py-5">
  <h1 class="mb-4 text-center">Catálogo de Productos</h1>

  <!-- Filtro por categoría -->
  <form action="index.php" method="get" class="mb-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <select name="categoria" id="categoria" class="form-select" onchange="this.form.submit()">
          <option value="">Todas las categorías</option>
          <?php foreach ($categorias as $categoria): ?>
            <?php
              $categoriaNombre = htmlspecialchars($categoria['categoria']);
              $selected = ($categoriaNombre === $categoriaSeleccionada) ? 'selected' : '';
            ?>
            <option value="<?= $categoriaNombre ?>" <?= $selected ?>><?= $categoriaNombre ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </form>

  <!-- Lista de productos -->
  <div class="row">
    <?php if ($productos): ?>
      <?php foreach ($productos as $producto): ?>
        <div class="col-md-4 mb-4">
          <?php include 'producto.php'; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="col-12 text-center">No hay productos disponibles en esta categoría.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Carrito flotante -->
<div id="carritoFlotante">
  <h2>Carrito</h2>
  <div id="productosCarrito"></div>
  <button id="cerrarCarritoBtn" class="btn btn-danger">Cerrar Carrito</button>
</div>

<!-- Botón para abrir el carrito -->
<button id="abrirCarritoBtn" class="carrito-cerrado">
  &#128722;
  <span id="contadorCarrito" class="badge bg-danger ms-1">0</span>
</button>

<!-- Script del carrito -->
<script>
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
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
