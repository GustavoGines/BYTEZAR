<?php
session_start();
require_once __DIR__ . '/../../backend/config/db.php'; // acá tenés que tener tu $pdo configurado

// Consulta para obtener productos con categorías y descripción
$sql = "SELECT p.*, c.categoria, d.descripcion
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id
        LEFT JOIN detalle_productos d ON d.id_producto = p.id
        ORDER BY p.nombre ASC";

$stmt = $pdo->query($sql);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>BYTEZAR - Acceso de Usuarios</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!-- CSS -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../css/font-awesome.min.css" />
  <link rel="stylesheet" href="../../css/owl.carousel.css" />
  <link rel="stylesheet" href="../../css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="../../css/tooplate-styles.css" />
    
</head>
<body>

<!-- MENÚ PRINCIPAL -->
<section class="navbar custom-navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="../../index.php" class="navbar-brand">
                <img src="../../images/bytezar_imagen.png" alt="Bytezar" 
                     style="width: 150px; margin-top: -10px;">
            </a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="../../index.php" class="smoothScroll">Inicio</a></li>
                <li><a href="#catalogo" class="smoothScroll">Catálogo</a></li>
                <li><a href="../../index.php#feature" class="smoothScroll">Destacados</a></li>
                <li><a href="../../index.php#about" class="smoothScroll">Quiénes Somos</a></li>
                <li><a href="../../contactos.html" class="smoothScroll">Contactos</a></li>
            </ul>
         <?php include_once '../../backend/includes/navbar_usuario.php'; ?>
        </div>
    </div>
</section>

<!-- TABLA DE PRODUCTOS -->
<div class="container tabla-productos" style="margin-top: 80px;">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h3><i class="fa fa-list"></i> Listado de Productos</h3>
        </div>
        <div class="panel-body">
            <!-- Barra de búsqueda -->
            <div class="form-group">
                <input type="text" id="buscador" class="form-control input-lg" placeholder="Buscar producto por nombre...">
            </div>

            <!-- Tabla de productos -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="tablaProductos">
                    <thead>
                        <tr class="info text-center">
                            <th><i class="fa fa-tag"></i> Nombre</th>
                            <th><i class="fa fa-folder-open"></i> Categoría</th>
                            <th><i class="fa fa-align-left"></i> Descripción</th>
                            <th><i class="fa fa-usd"></i> Precio</th>
                            <th><i class="fa fa-cubes"></i> Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($productos) > 0): ?>
                            <?php foreach ($productos as $fila): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['categoria']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                                    <td>$<?php echo number_format($fila['precio'], 2); ?></td>
                                    <td><?php echo $fila['stock']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay productos disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JS para búsqueda -->
<script>
    document.getElementById('buscador').addEventListener('keyup', function () {
        const valorBusqueda = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tablaProductos tbody tr');

        filas.forEach(fila => {
            const nombre = fila.cells[0].textContent.toLowerCase();
            fila.style.display = nombre.includes(valorBusqueda) ? '' : 'none';
        });
    });
</script>

<!-- Scripts de Bootstrap -->
<script src="../../js/jquery.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/owl.carousel.min.js"></script>
<script src="../../js/smoothscroll.js"></script>
<script src="../../js/custom.js"></script>

</body>
</html>
