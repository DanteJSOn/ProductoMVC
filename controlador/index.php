<?php
require_once("../modelo/index.php"); // Carga el modelo

$modelo = new Producto();

// Verifica la acción a realizar
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

switch ($accion) {
    case 'crear':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $modelo->insertar($nombre, $precio);
            header("Location: ../vista/index.php");
        } else {
            include("../vista/nuevo.php");
        }
        break;

    case 'editar':
        $id = $_GET['id'];
        $producto = $modelo->mostrarPorId($id);
        include("../vista/editar.php");
        break;

    case 'actualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $modelo->actualizar($id, $nombre, $precio);
            header("Location: ../vista/index.php");
        }
        break;

    case 'eliminar':
        $id = $_GET['id'];
        $modelo->eliminar($id);
        header("Location: ../vista/index.php");
        break;

    default:
        $productos = $modelo->mostrar();
        include("../vista/index.php");
        break;
}
?>
