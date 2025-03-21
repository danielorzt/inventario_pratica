<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
include_once "../models/ProveedorModel.php";
$proveedores = ProveedorModel::mdlListarProveedores();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">Admin Panel</a>
        <div class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link  active" href="proveedores.php">Proveedores</a></li>
            <li class="nav-item"><a class="nav-link" href="categorias.php">Categorías</a></li>
            <li class="nav-item"><a class="nav-link" href="productos.php">Productos</a></li>
        </div>
        <div class="dropdown ms-auto">
            <button class="btn btn-secondary dropdown-toggle text-info bg-light border-light" type="button" data-bs-toggle="dropdown">Ver perfil</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Ver datos</a></li>
                <li><a class="dropdown-item" href="../logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestión de Proveedores</h2>
        <a href="dashboard.php" class="btn btn-secondary">Volver al Panel</a>
    </div>

    <?php if (isset($_GET["msg"])): ?>
        <div class="alert alert-<?php echo $_GET["status"] == "success" ? "success" : "danger"; ?>">
            <?php echo $_GET["msg"]; ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarProveedor">Agregar Proveedor</button>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($proveedores as $proveedor): ?>
                <tr>
                    <td><?php echo $proveedor["id_proveedor"]; ?></td>
                    <td><?php echo $proveedor["nombre_proveedor"]; ?></td>
                    <td><?php echo $proveedor["direccion_proveedor"]; ?></td>
                    <td><?php echo $proveedor["telefono_proveedor"]; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm btnEditar"
                                data-id="<?php echo $proveedor["id_proveedor"]; ?>"
                                data-nombre="<?php echo $proveedor["nombre_proveedor"]; ?>"
                                data-direccion="<?php echo $proveedor["direccion_proveedor"]; ?>"
                                data-telefono="<?php echo $proveedor["telefono_proveedor"]; ?>"
                                data-bs-toggle="modal" data-bs-target="#modalEditarProveedor">
                            Editar
                        </button>
                        <a href="../controllers/ProveedorController.php?id_proveedor=<?php echo $proveedor["id_proveedor"]; ?>"
                           class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Agregar Proveedor -->
<div class="modal fade" id="modalAgregarProveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/ProveedorController.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre_proveedor" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion_proveedor" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_proveedor" name="direccion_proveedor">
                    </div>
                    <div class="mb-3">
                        <label for="telefono_proveedor" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_proveedor" name="telefono_proveedor">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Proveedor -->
<div class="modal fade" id="modalEditarProveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/ProveedorController.php" method="POST">
                    <input type="hidden" id="edit_id_proveedor" name="id_proveedor">
                    <div class="mb-3">
                        <label for="edit_nombre_proveedor" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit_nombre_proveedor" name="nombre_proveedor" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_direccion_proveedor" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="edit_direccion_proveedor" name="direccion_proveedor">
                    </div>
                    <div class="mb-3">
                        <label for="edit_telefono_proveedor" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="edit_telefono_proveedor" name="telefono_proveedor">
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let editButtons = document.querySelectorAll(".btnEditar");
        editButtons.forEach(button => {
            button.addEventListener("click", function() {
                document.getElementById("edit_id_proveedor").value = this.getAttribute("data-id");
                document.getElementById("edit_nombre_proveedor").value = this.getAttribute("data-nombre");
                document.getElementById("edit_direccion_proveedor").value = this.getAttribute("data-direccion");
                document.getElementById("edit_telefono_proveedor").value = this.getAttribute("data-telefono");
            });
        });
    });
</script>
</body>
</html>
