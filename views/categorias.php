<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

include_once "../models/CategoriaModel.php";
$categorias = CategoriaModel::mdlListarCategorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">Admin Panel</a>
        <div class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="proveedores.php">Proveedores</a></li>
            <li class="nav-item"><a class="nav-link active" href="categorias.php">Categorías</a></li>
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

<div class="container mt-5">
    <h1 class="text-center">Gestión de Categorías</h1>

    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
        <i class="bi bi-plus-circle"></i> Agregar Categoría
    </button>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <td><?= $categoria['id_categoria'] ?></td>
                <td><?= $categoria['nombre_categoria'] ?></td>
                <td><?= $categoria['descripcion_categoria'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editarCategoria(<?= $categoria['id_categoria'] ?>, '<?= $categoria['nombre_categoria'] ?>', '<?= $categoria['descripcion_categoria'] ?>')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <a href="../controllers/CategoriaController.php?action=eliminar&id=<?= $categoria['id_categoria'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta categoría?');">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Agregar Categoría -->
<div class="modal fade" id="modalAgregarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/CategoriaController.php?action=agregar" method="POST">
                    <label for="nombre">Nombre de la Categoría:</label>
                    <input type="text" name="nombre" class="form-control" required>
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Categoría -->
<div class="modal fade" id="modalEditarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/CategoriaController.php?action=editar" method="POST">
                    <input type="hidden" name="id" id="edit-id">
                    <label for="edit-nombre">Nombre:</label>
                    <input type="text" name="nombre" id="edit-nombre" class="form-control" required>
                    <label for="edit-descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="edit-descripcion" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editarCategoria(id, nombre, descripcion) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nombre').value = nombre;
        document.getElementById('edit-descripcion').value = descripcion;
        new bootstrap.Modal(document.getElementById('modalEditarCategoria')).show();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>