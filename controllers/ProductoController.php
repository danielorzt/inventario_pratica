<?php
include_once "../models/ProductoModel.php";

class ProductoController
{
    public function ctrAgregarProducto()
    {
        if (
            isset($_POST["nombre"], $_POST["descripcion"], $_POST["precio"], $_POST["stock"], $_POST["id_categoria"], $_POST["id_proveedor"]) &&
            !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["stock"])
        ) {
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $cantidad = $_POST["stock"];
            $id_categoria = $_POST["id_categoria"];
            $id_proveedor = $_POST["id_proveedor"];

            $respuesta = ProductoModel::mdlAgregarProducto($nombre, $descripcion, $precio, $cantidad, $id_categoria, $id_proveedor);

            if ($respuesta) {
                header("Location: ../views/productos.php?msg=Producto agregado correctamente&status=success");
            } else {
                header("Location: ../views/productos.php?msg=Error al agregar producto&status=error");
            }
            exit();
        }
    }

    public function ctrEliminarProducto()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $respuesta = ProductoModel::mdlEliminarProducto($id);

            if ($respuesta) {
                header("Location: ../views/productos.php?msg=Producto eliminado&status=success");
            } else {
                header("Location: ../views/productos.php?msg=Error al eliminar producto&status=error");
            }
            exit();
        }
    }

    public function ctrEditarProducto()
    {
        if (
            isset($_POST["id"], $_POST["nombre"], $_POST["descripcion"], $_POST["precio"], $_POST["stock"], $_POST["id_categoria"], $_POST["id_proveedor"]) &&
            !empty($_POST["id"]) && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["stock"])
        ) {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $cantidad = $_POST["stock"];
            $id_categoria = $_POST["id_categoria"];
            $id_proveedor = $_POST["id_proveedor"];

            $respuesta = ProductoModel::mdlEditarProducto($id, $nombre, $descripcion, $precio, $cantidad, $id_categoria, $id_proveedor);

            if ($respuesta) {
                header("Location: ../views/productos.php?msg=Producto actualizado correctamente&status=success");
            } else {
                header("Location: ../views/productos.php?msg=Error al actualizar producto&status=error");
            }
            exit();
        }
    }
}

// Manejo de formularios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        $producto = new ProductoController();
        $producto->ctrEditarProducto();
    } else {
        $producto = new ProductoController();
        $producto->ctrAgregarProducto();
    }
} elseif (isset($_GET["id"])) {
    $producto = new ProductoController();
    $producto->ctrEliminarProducto();
}
