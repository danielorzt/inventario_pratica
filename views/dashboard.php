<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">Admin Panel</a>
        <div class="navbar-nav me-auto">
            <!-- Proveedores -->
            <li class="nav-item">
                <a class="nav-link" href="proveedores.php">Proveedores</a>
            </li>
            <!-- Categorías -->
            <li class="nav-item">
                <a class="nav-link" href="categorias.php">Categorías</a>
            </li>
            <!-- Productos -->
            <li class="nav-item">
                <a class="nav-link" href="productos.php">Productos</a>
            </li>
        </div>

        <!-- Botón de perfil -->
        <div class="dropdown ms-auto">
            <button class="btn btn-secondary dropdown-toggle text-info bg-light border-light" type="button" data-bs-toggle="dropdown">Ver perfil</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalVerDatos">Ver datos</a></li>
                <li><a class="dropdown-item" href="../logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Bienvenido al Panel de Administración</h1>
    <p class="text-center">Gestione proveedores, categorías y productos desde aquí.</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
