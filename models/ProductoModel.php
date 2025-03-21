<?php
include_once "Conexion.php";

class ProductoModel
{
    public static function mdlListarProductos()
    {
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("SELECT * FROM producto");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al listar productos: " . $e->getMessage());
        }
    }

    public static function mdlAgregarProducto($nombre, $descripcion, $precio, $cantidad, $id_categoria, $id_proveedor)
    {
        try {
            $conexion = Conexion::conectar();

            // DEPURACIÓN: Verifica qué datos están llegando
            var_dump($nombre, $descripcion, $precio, $cantidad, $id_categoria, $id_proveedor);

            $stmt = $conexion->prepare("INSERT INTO producto 
                (nombre_producto, descripcion_producto, precio_producto, cantidad_producto, id_categoria, id_proveedor) 
                VALUES (:nombre, :descripcion, :precio, :cantidad, :id_categoria, :id_proveedor)");

            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al agregar producto: " . $e->getMessage());
        }
    }

    public static function mdlEliminarProducto($id)
    {
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("DELETE FROM producto WHERE id_producto = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al eliminar producto: " . $e->getMessage());
        }
    }

    public static function mdlEditarProducto($id, $nombre, $descripcion, $precio, $cantidad, $id_categoria, $id_proveedor)
    {
        try {
            $conexion = Conexion::conectar();

            // DEPURACIÓN: Verifica qué datos están llegando
            var_dump($id, $nombre, $descripcion, $precio, $cantidad, $id_categoria, $id_proveedor);

            $stmt = $conexion->prepare("UPDATE producto 
                SET nombre_producto = :nombre, 
                    descripcion_producto = :descripcion, 
                    precio_producto = :precio, 
                    cantidad_producto = :cantidad, 
                    id_categoria = :id_categoria, 
                    id_proveedor = :id_proveedor 
                WHERE id_producto = :id");

            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al editar producto: " . $e->getMessage());
        }
    }
}
