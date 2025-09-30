<?php
session_start();
if(!isset($_SESSION['usuario'])) header("Location: login.php");

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar y obtener datos del POST
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $stock = $_POST['stock']; 

    // Uso de consultas preparadas para mayor seguridad
    $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, categoria, stock) VALUES (?, ?, ?, ?)");
    // 'sdsi' indica: string, double, string, integer
    $stmt->bind_param("sdsi", $nombre, $precio, $categoria, $stock);
    
    if ($stmt->execute()) {
        header("Location: catalogo.php");
        exit();
    } else {
        $error = "Error al guardar: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-plus-lg"></i> Agregar Nuevo Juego</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Juego:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio ($):</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock:</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Guardar Producto</button>
                            <a href="catalogo.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver al Catálogo</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>