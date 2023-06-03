<?php 
  include_once '../Modules/functions/sessions.php';

  if (!controllSession()) {
    header('Location: http://localhost/Evastrid/views/login.php');
  }
?>

<?php include '../Modules/templates/head.php'; ?>

<?php
include '../Modules/functions/bdconection.php';

$sql = "SELECT * FROM administradores";
$stmt = $connect->prepare($sql);
$stmt->execute();

$resultadoBusquedaAdmin = $stmt->get_result(); //?me trae la consulta pero enrredada.
$resultadoOrdenado = $resultadoBusquedaAdmin->fetch_all(MYSQLI_ASSOC);
?>

<div class="papa_consulta">

    <div class="col-12 inicio">
    </div>

    <div class="barra-inicio">

        <div class="salida ad">
            <a href="inicio.php">
                <p>Ir a Inicio</p>
                <i class="fa-solid fa-circle-chevron-left"></i>
            </a>
        </div>

        <div class="consultorio-barra admin">
            <h1>AMINISTRADORES</h1>
            <i class="fa-solid fa-user-doctor"></i>
        </div>

        <div class="logo-admin">
            <img src="../Img/Logo.jpeg" alt="">
        </div>

        <div class="tusAdministradores">

            <div class="tituloAdmin">
                <h2>Tus Administradores</h2>
            </div>

            <div class="admin-usuarios padre">

                <?php foreach ($resultadoOrdenado as $numeroAdmin => $posicionesNumAdmin) { ?>

                    <div class="admin-usuarios hv">

                        <h3><?php echo $posicionesNumAdmin["nombres"]; ?></h3>

                        <div class="boton-ad">
                            <button 
                                class="editarAdmi" 
                                title="Editar" 
                                <?php   //* asi agarro el codigo de bd sin iniciar seccion y lo envio a JS y es JS quien lo muestra en html x medio del id de la etiqueta, ver hoja modales.js 
                                ?>
                                usuarioCodigo="<?php echo $posicionesNumAdmin['codigo']; ?>"
                                nombreAdmin="<?php echo $posicionesNumAdmin['nombres']; ?>"
                                apellidoAdmin="<?php echo $posicionesNumAdmin['apellidos']; ?>"
                                emailAdmin="<?php echo $posicionesNumAdmin['email']; ?>"
                                cargoAdmin="<?php echo $posicionesNumAdmin['cargo']; ?>"
                                claveAdmin="<?php echo $posicionesNumAdmin['clave']; ?>"
                                idAdmin="<?php echo $posicionesNumAdmin['codigo']; ?>"
                            >
                                <i class="fa-solid fa-user-pen"></i>
                            </button>

                            <button title="Eliminar">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            
                        </div>
                         
                    </div>

                <?php } ?>



            </div>

            <div class="new-admin">
                <button id="newUsu">
                    <i class="fa-solid fa-plus"></i>
                    <h3>¿Deseas agregar un nuevo administrador?</h3>
                </button>
            </div>
        </div>


    </div>



</div>

<div class="overlay" id="overlay">
    <div class="ModalRecuperarContraseña overlay-hijo" id="modalFomAdmin">
        <form action="" autocomplete="off" id="formularioNuevoAdministrador" method="post" enctype="multipart/form-data">
            <div class="title-ed">
                <h1 id="titleFormAdmin">Editar Datos</h1> <!-- nuevo administrador -->
                <button title="Cerrar" id="CloseModalA">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <div class="datos-editar">
                <input type="text" id="nombreUsuario" required>
                <label>Nombre</label>
            </div>

            <div class="datos-editar">
                <input type="text" id="apellidosUsuario" required>
                <label>Apellidos</label>
            </div>

            <div class="datos-editar">
                <input type="email" id="correoUsuario" required>
                <label>Correo Electronico</label>
            </div>

            <div class="datos-editar">
                <input type="text" id="cargoUsuario" required>
                <label>Cargo</label>
            </div>

            <div class="datos-editar">
                <input type="password" id="claveUsuario" required>
                <label>Contraseña</label>
            </div> 

            <input type="hidden"  id="idAministrador" data-id>

            <div class="boton editar">
                <button class="fin" id="btnSubmitFormAdmin">
                    <p>Guardar & Finalizar</p>
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </div>

        </form>
    </div>
</div>

<script src="../JS/modales.js"></script>
<script src="../JS/registro.js"></script>

<?php include '../Modules/templates/footer.php'; ?>