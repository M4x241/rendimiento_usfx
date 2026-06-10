<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración de Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="layout">

    <aside class="sidebar">
        <div class="brand">Rendimiento USFX</div>

        <a href="#" class="menu-item">Dashboard</a>
        <a href="#" class="menu-item">Análisis de datos</a>
        <a href="#" class="menu-item">Ayudantes</a>
        <a href="#" class="menu-item active">Perfil</a>
        <a href="php/logout.php" class="menu-item salir">Cerrar sesión</a>
    </aside>

    <main class="contenido">

        <div class="topbar">
            <div>
                <h2>Configuración de perfil</h2>
                <p>Administra tus datos personales dentro del sistema académico.</p>
            </div>
            <span class="badge text-bg-primary">Módulo 5</span>
        </div>

        <div id="mensaje" class="alert d-none"></div>

        <div class="row g-4">

            <div class="col-lg-4">
                <div class="card perfil-card shadow-sm">
                    <div class="card-body text-center">
                        <img id="fotoVista" src="img/default.png" class="foto-perfil" alt="Foto de perfil">

                        <h4 id="nombreVista" class="mt-3">Cargando...</h4>
                        <p id="correoVista" class="text-muted mb-1">---</p>
                        <p id="rolVista" class="rol">---</p>

                        <hr>

                        <p class="small text-muted mb-0">
                            Esta información se obtiene desde MySQL usando PHP, Fetch y JSON.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <strong>Editar información del usuario</strong>
                    </div>

                    <div class="card-body">
                        <form id="formPerfil">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Carrera</label>
                                    <input type="text" class="form-control" id="carrera" name="carrera">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Semestre</label>
                                    <input type="number" class="form-control" id="semestre" name="semestre" min="1" max="10">
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Guardar cambios
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <strong>Cambiar contraseña</strong>
                    </div>

                    <div class="card-body">
                        <form id="formPassword">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nueva contraseña</label>
                                    <input type="password" class="form-control" name="password" required minlength="6">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirmar contraseña</label>
                                    <input type="password" class="form-control" name="confirmar" required minlength="6">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-primary">
                                Actualizar contraseña
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/perfil.js"></script>

</body>
</html>
