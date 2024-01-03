<?php
include_once '../Modules/functions/sessions.php';

if (controllSession()) {
  $rootViews = dirname($_SERVER['PHP_SELF']);
  header('Location: http://localhost'.$rootViews.'/inicio.php');
}
?>

<?php include('../Modules/templates/head.php'); ?>

<link rel="stylesheet" href="../css/ondotogramaManuel.css">

<div class="pt-2 pb-0 m-0 w-100 h-100 contPal">



  <div class="justify">
    <div class="row d-inline-block bg-login w-auto rounded-4 me-5">
      <form class="form-login" id="formLogin">
        <div class="col-12 login-1">
          <img src="../Img/Logo.jpeg" alt="odontologia" class="img-fluid rounded-5 m-3 p-4">
          <h1 class="text-center m-4 pb-0 pt-5 ">INICIAR <br> SESIÓN</h1>
        </div>

        <div class="col-12 usu-cont w-75 text-center">

          <div class="input-usu">
            <input class="bg-transparent w-100" type="text" id='emailAdmin'>
            <label class="text-start fw-semibold fs-6" for="">Usuario</label>
          </div>


          <div class="input-usu">
            <input class="bg-transparent w-100" type="password" id='claveAdmin'>
            <label class="text-start fw-semibold fs-6" for="">Contraseña</label>
          </div>


        </div>

        <div class="col-12 text-center lg-boton pb-4">
          <button>Iniciar Sesión</button>
        </div>

      </form>

      <div class="col-12 text-center lg-boton d-block pb-4">
        <a id="recuperarContraseña" class="fs-6 fw-semibold text-decoration-none" href="">¿Has olvidado tu contraseña?</a>
      </div>
    </div>

  </div>

  <div class="row w-100 p-0 rowc-o">
    <div class="col-6 w-50 consultorio pb-0 pe-0">
      <h1 class="mb-0 h-auto">Consultorio Odontológico <br> Dra. Evastrid Pardo.</h1>
    </div>

    <div class="col-6 text-center odontologia p-0 me-0">
      <h4 class="mb-0 fw-bold">Odontología Integral del Niño & del Adulto, Estetica Dental & Odontología General.</h4>
    </div>
  </div>


</div>

<div class="firma">
  <h5 class="fw-bold">D-By: ZG &#169</h5>
</div>


<div class="overlayRecuperarContraseña" id="overlayRecuperarContraseña">

  <div class="ModalRecuperarContraseña" id="ModalRecuperarContraseña">

    <form action="">

      <div class="title-ed">
        <h1>Recuperar Contraseña</h1>
        <button class="closeModalRecuperarContraseña" id="btncloseModalRecuperarContraseña">
          x
        </button>
        <!-- nuevo administrador -->
      </div>

      <div class="datos-editar">
        <label class="label">Por favor ingresa el correo electronico con el que te registraste.</label>
      </div>

      <div class="datos-editar email">
        <input type="email">
        <label>Escribe tu correo</label>
      </div>

      <div class="boton editar">
        <button class="fin">
          <p>Recuperar Clave</p>
          <i class="fa-solid fa-key"></i>
        </button>
      </div>

    </form>

  </div>

</div>





<script src="../JS/login.js"></script>
<script src="../JS/modalOdontograma.js"></script>


<?php include '../Modules/templates/footer.php'; ?>