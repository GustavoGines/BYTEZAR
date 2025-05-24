<?php
 
session_start();
ini_set('display_errors', 0);
header('Content-Type: application/json');

// Validar sesión
if (!isset($_SESSION['usuario']['id_personas'])) {
  http_response_code(401);
  echo json_encode(["exito" => false, "mensaje" => "Usuario no autenticado."]);
  exit;
}

// Obtener datos del cliente
$id_persona = $_SESSION['usuario']['id_personas'];

// Leer datos del cuerpo
$input = json_decode(file_get_contents("php://input"), true);

$carrito = $input['carrito'] ?? [];
$metodo_nombre = $input['metodo_pago'] ?? '';

if (empty($carrito) || empty($metodo_nombre)) {
  echo json_encode(["exito" => false, "mensaje" => "Datos incompletos."]);
  exit;
}

// Conexión PostgreSQL
$host = "dpg-d0hpjbq4d50c73dc1gb0-a.oregon-postgres.render.com";
$dbname = "prueba_db_n963";
$user = "prueba_db_n963_user";
$password = "fz8hoDvUGGuFQw8sttoUE9WBI2E8gFDf";
$port = "5432";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
  echo json_encode(["exito" => false, "mensaje" => "Error de conexión."]);
  exit;
}

// Obtener id_método_pago a partir del nombre
$query_metodo = "SELECT id FROM metodo_pagos WHERE LOWER(metodo_pago) = LOWER($1)";
$result_metodo = pg_query_params($conn, $query_metodo, [$metodo_nombre]);

if (!$result_metodo || pg_num_rows($result_metodo) === 0) {
  echo json_encode(["exito" => false, "mensaje" => "Método de pago no válido."]);
  exit;
}
$id_metodo_pago = pg_fetch_result($result_metodo, 0, 0);

// Insertar en tabla ventas
$query_venta = "INSERT INTO ventas (id_personas, id_metodo_pago) VALUES ($1, $2) RETURNING id";
$result_venta = pg_query_params($conn, $query_venta, [$id_persona, $id_metodo_pago]);

if (!$result_venta) {
  echo json_encode(["exito" => false, "mensaje" => "Error al registrar la venta."]);
  exit;
}
$id_venta = pg_fetch_result($result_venta, 0, 0);

// Insertar en detalle_ventas
foreach ($carrito as $producto) {
  $id_producto = $producto['id'];  // Asegurate que JS lo envía
  $cantidad = $producto['cantidad'];

  $query_detalle = "INSERT INTO detalle_ventas (id_venta, id_productos, cantidad) VALUES ($1, $2, $3)";
  $res = pg_query_params($conn, $query_detalle, [$id_venta, $id_producto, $cantidad]);

  if (!$res) {
    echo json_encode(["exito" => false, "mensaje" => "Error al registrar detalle de producto."]);
    exit;
  }
}

unset($_SESSION['carrito']);
echo json_encode(["exito" => true, "id_venta" => $id_venta]);
?>