<?php
session_start();
if(!isset($_SESSION["id_usuario"])) { http_response_code(401); exit; }
include("../conexion.php");
$seccion = $_GET["seccion"] ?? "dashboard";
$id_usuario = $_SESSION["id_usuario"];

if($seccion == "dashboard"):
?>
<div class="mb-4">
    <h2>Dashboard Academico</h2>
</div>
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card card-dashboard">
            <h5>Total Estudiantes</h5>
            <div class="numero" id="total_estudiantes">0</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-dashboard">
            <h5>Aprobados</h5>
            <div class="numero" id="aprobados">0</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-dashboard">
            <h5>Reprobados</h5>
            <div class="numero" id="reprobados">0</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-dashboard">
            <h5>% Aprobacion</h5>
            <div class="numero" id="porcentaje">0%</div>
        </div>
    </div>
</div>
<div class="card shadow p-4">
    <h4 class="mb-4">Rendimiento Academico por Materia</h4>
    <div id="grafico"></div>
</div>

<?php
elseif($seccion == "ayudantes"):
?>
<div class="seccion-ayudantes">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Lista de Ayudantes</h2>
    </div>
    <div class="filtros">
        <div>
            <label class="form-label mb-1 small">Carrera</label>
            <select id="carrera">
                <option value="">Todas las carreras</option>
                <option value="Sistemas">Sistemas</option>
                <option value="Computacion">Computacion</option>
            </select>
        </div>
        <div>
            <label class="form-label mb-1 small">Semestre</label>
            <select id="semestre">
                <option value="">Todos los semestres</option>
                <?php for($i=1;$i<=6;$i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div>
            <label class="form-label mb-1 small">Materia</label>
            <select id="materia">
                <option value="">Todas las materias</option>
                <option value="Fisica I">Fisica I</option>
                <option value="Programacion Web">Programacion Web</option>
                <option value="Calculo II">Calculo II</option>
                <option value="Algebra I">Algebra I</option>
            </select>
        </div>
        <div>
            <label class="form-label mb-1 small">&nbsp;</label>
            <button id="btnBuscarAyudantes" class="btn btn-primary">Buscar</button>
        </div>
        <div>
            <label class="form-label mb-1 small">&nbsp;</label>
            <button class="btn btn-outline-secondary" onclick="cargarSeccion('dashboard')">Volver</button>
        </div>
    </div>
    <div id="resultadoAyudantes" class="table-responsive">
        <div class="loading"><div class="spinner"></div><p>Cargando...</p></div>
    </div>
</div>

<?php
elseif($seccion == "perfil_ayudante"):
$id_ayudante = intval($_GET["id"] ?? 0);
$sql = "SELECT * FROM ayudantes WHERE id_ayudante = $id_ayudante";
$r = mysqli_query($conexion, $sql);
$ayudante = mysqli_fetch_assoc($r);
if(!$ayudante):
?>
<div class="alert alert-danger">Ayudante no encontrado</div>
<button class="btn btn-secondary" onclick="cargarSeccion('ayudantes')">Volver</button>
<?php else:
$sqlC = "SELECT * FROM comentarios_ayudantes WHERE id_ayudante = $id_ayudante ORDER BY fecha_comentario DESC";
$rC = mysqli_query($conexion, $sqlC);
$comentarios = [];
while($c = mysqli_fetch_assoc($rC)) $comentarios[] = $c;
?>
<div class="perfilAyudante">
    <button class="btn btn-secondary mb-3" onclick="cargarSeccion('ayudantes')">Volver a Ayudantes</button>
    <div class="infoGeneral">
        <h2><?php echo $ayudante["nombre"]; ?></h2>
        <div class="detalles">
            <p><strong>Carrera:</strong> <?php echo $ayudante["carrera"]; ?></p>
            <p><strong>Semestre:</strong> <?php echo $ayudante["semestre"]; ?></p>
            <p><strong>Materia:</strong> <?php echo $ayudante["materia"]; ?></p>
            <p><strong>Correo:</strong> <?php echo $ayudante["correo"]; ?></p>
            <p><strong>Telefono:</strong> <?php echo $ayudante["telefono"] ?? "—"; ?></p>
            <p><strong>Descripcion:</strong> <?php echo $ayudante["descripcion"] ?? "—"; ?></p>
            <p><strong>Horarios:</strong> <?php echo $ayudante["horario"] ?? "—"; ?></p>
        </div>
    </div>
    <hr>
    <div class="seccionComentarios">
        <h3>Comentarios de Estudiantes</h3>
        <div class="listaComentarios" id="listaComentarios">
            <?php if(count($comentarios) > 0): ?>
                <?php foreach($comentarios as $c): ?>
                <div class="comentario">
                    <div class="encabezadoComentario">
                        <strong><?php echo $c["nombre_estudiante"]; ?></strong>
                        <span class="calificacion"><?php echo str_repeat("*",$c["calificacion"]).str_repeat(" ",5-$c["calificacion"]); ?></span>
                    </div>
                    <p class="textoComentario"><?php echo $c["comentario"]; ?></p>
                    <small style="color:#999"><?php echo $c["fecha_comentario"]; ?></small>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay comentarios aun.</p>
            <?php endif; ?>
        </div>
        <div class="formularioComentario">
            <h4>Dejar un Comentario</h4>
            <form id="formComentario">
                <div><label>Tu Nombre:</label><input type="text" id="nombreEstudiante" required></div>
                <div><label>Tu Correo:</label><input type="email" id="emailEstudiante" required></div>
                <div>
                    <label>Calificacion:</label>
                    <select id="calificacionComentario" required>
                        <option value="">Selecciona</option>
                        <?php for($i=1;$i<=5;$i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> / 5</option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div><label>Comentario:</label><textarea id="textoComentario" rows="4" required></textarea></div>
                <button type="button" id="btnEnviarComentario" class="btn btn-primary w-100">Enviar Comentario</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
elseif($seccion == "mi_perfil"):
$sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
$r = mysqli_query($conexion, $sql);
$user = mysqli_fetch_assoc($r);
?>
<div class="mb-4">
    <h2>Configuracion de Perfil</h2>
    <p class="text-muted">Administra tus datos personales</p>
</div>
<div id="mensajePerfil" class="alert d-none"></div>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm p-4 text-center">
            <img src="../5/img/default.png" class="rounded-circle mb-3" width="120" height="120" style="object-fit:cover;border:4px solid #e5e7eb" alt="Foto">
            <h4 id="vistaNombre"><?php echo $user["nombre"]; ?></h4>
            <p class="text-muted mb-1" id="vistaCorreo"><?php echo $user["correo"]; ?></p>
            <span class="badge bg-primary"><?php echo $user["rol"] ?? "Usuario"; ?></span>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white"><strong>Editar informacion</strong></div>
            <div class="card-body">
                <form id="formPerfil">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" value="<?php echo $user["nombre"]; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Correo electronico</label>
                            <input type="email" class="form-control" id="correo" value="<?php echo $user["correo"]; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Carrera</label>
                            <input type="text" class="form-control" id="carrera_u" value="<?php echo $user["carrera"] ?? ""; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Semestre</label>
                            <input type="number" class="form-control" id="semestre_u" value="<?php echo $user["semestre"] ?? ""; ?>" min="1" max="10">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Descripcion</label>
                            <textarea class="form-control" id="descripcion" rows="3"><?php echo $user["descripcion"] ?? ""; ?></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-white"><strong>Cambiar contraseña</strong></div>
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
                    <button type="submit" class="btn btn-outline-primary">Actualizar contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
