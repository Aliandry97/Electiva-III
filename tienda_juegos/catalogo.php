<?php
session_start();
// Si no hay sesión de usuario, redirigir al login
if(!isset($_SESSION['usuario'])) header("Location: login.php");

include 'conexion.php';
// Obtener todos los productos
$result = $conn->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Juegos - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .container { max-width: 90%; margin-top: 30px; }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-white rounded shadow-sm p-3 mb-4">
        <span class="navbar-brand mb-0 h1 text-primary">🕹️ Gestión de Juegos</span>
        <div class="d-flex align-items-center">
            <span class="me-3">Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong></span>
            <a href="logout.php" class="btn btn-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
        </div>
    </nav>
    
    <h2 class="text-center mb-4 text-secondary">Catálogo de Productos</h2>
    
    <a class="btn btn-primary mb-3 shadow-sm" href="nuevo.php"><i class="bi bi-plus-circle-fill"></i> Agregar Producto</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm bg-white rounded">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td>$<?= number_format($row['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($row['categoria']) ?></td>
                    <td><span class="badge bg-<?= $row['stock'] > 10 ? 'success' : ($row['stock'] > 5 ? 'warning' : 'danger') ?>"><?= $row['stock'] ?></span></td>
                    <td class="text-center">
                        <a class="btn btn-warning btn-sm me-2" href="editar.php?id=<?= $row['id'] ?>" title="Editar"><i class="bi bi-pencil-square"></i> Editar</a>
                        <a class="btn btn-danger btn-sm" href="eliminar.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar el juego \'<?= htmlspecialchars($row['nombre']) ?>\'?');" title="Eliminar"><i class="bi bi-trash-fill"></i> Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
