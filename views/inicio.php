<?php 
  include_once '../Modules/functions/sessions.php';

  if (!controllSession()) {
    header('Location: http://localhost/Evastrid/views/login.php');
  }
?>
<?php include '../Modules/templates/head.php'; ?>

<div class="papa_consulta">
    <div class="col-12 inicio">
    </div>

    <div class="barra-inicio">

        <div class="cerrar" id="cerrarSesion">
            <button id="btnCerrarSession">
                <h3>Cerrar Sesión
                    <i class="fa-solid fa-person-running"></i>
                </h3>
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>

        <div class="icono-barra"></div>

        <div class="enlaces-barra">
            <ul>

                <li class="lista">
                    <div class="li_div">
                        <a href="registro_pacientes.php">Ingresar Nuevo Paciente</a>
                        <i class="fa-solid fa-hospital-user"></i>
                    </div>
                </li>
                <li class="lista">
                    <div class="li_div">
                        <a href="misPacientes.php">Mis Pacientes</a>
                        <i class="fa-solid fa-tooth"></i>
                    </div>
                </li>
                <li class="lista">
                    <div class="li_div">
                        <a href="administrador.php">Administrador</a>
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                </li>
            </ul>
        </div>

        <div class="consultorio-barra">
            <h1>Consultorio Odontológico <br> Dra. Evastrid Pardo.</h1>
        </div>

        <div class="firma">
            <h5 class="fw-bold">D-By: ZG &#169</h5>
        </div>

    </div>

</div>


<script>
    const exit = $('#cerrarSesion')

    exit.mouseenter((salir) => {

        salir.preventDefault()

        const btnH = $('#cerrarSesion button h3')
        btnH.addClass('show')

        const icon = $('#cerrarSesion button > i')
        icon.hide()

    })

    exit.mouseleave((salir) => {

        salir.preventDefault()

        const btnH = $('#cerrarSesion button h3')
        btnH.removeClass('show')

        const icon = $('#cerrarSesion button > i')
        icon.show()
    })
</script>

<script src="../JS/inicio.js"></script>
<?php include '../Modules/templates/footer.php'; ?>