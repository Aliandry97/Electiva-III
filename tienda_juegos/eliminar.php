session_start();
if(!isset($_SESSION['usuario'])) header("Location: login.php");

include 'conexion.php';

// Verificación de seguridad básica y uso de consultas preparadas
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta preparada para DELETE (i = integer)
    $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();
}

// Redirigir siempre de vuelta al catálogo
header("Location: catalogo.php");
exit();
?>