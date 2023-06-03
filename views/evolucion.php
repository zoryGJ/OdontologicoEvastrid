<?php 
  include_once '../Modules/functions/sessions.php';

  if (!controllSession()) {
    header('Location: http://localhost/Evastrid/views/login.php');
  }
?>
<?php include '../Modules/templates/head.php'; ?>


<div class="cont-pacientes">

    <div class="pacientes">

        <div class="logo-admin">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia">
            <h1>HISTORIA CLINICA ODONTOLÓGICA</h1>
            <h3>Evolución De Historia Clinica <br> Odontológica</h3>
        </div>

        <div class="salida">
            <a href="inicio.php">
                <p>Regresar</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>

        <form action="">

            <h1>Datos del Paciente</h1>

            <div class="datos-paciente general-2">

                <div class="d-personales general-1">
                    <div class="nombre-p">
                        <input type="text">
                        <label>Nombre (S)*</label>
                    </div>
                    <div class="apellido-1">
                        <input type="text">
                        <label>Primer Apellido*</label>
                    </div>
                    <div class="apellido-2">
                        <input type="text">
                        <label>Segundo Apellido</label>
                    </div>
                </div>

                <div class="fechas-paciente general-1 evolucion">
                    <div class="fecha-n evolucion">
                        <input type="date">
                        <label>Fecha de Nacimiento*</label>
                    </div>
                    <div class="años evolucion">
                        <input type="number">
                        <label>Edad</label>
                    </div>
                    <div class="t-usuario evolucion">
                        <input type="text" list="t-usuario" placeholder="Seleccionar...">
                        <datalist id="t-usuario">
                            <option value="Contributivo">
                            <option value="Subsidiado">
                            <option value="Cotizante">
                        </datalist>
                        <label>Tipo de Usuario</label>
                    </div>
                </div>

                <div class="documento general-1">
                    <div class="tipo-dcto">
                        <input type="number" list="tipo-dcto">
                        <datalist id="tipo-dcto">
                            <option value="Cedula de Ciudadania">
                            <option value="Tarjeta de Identidad">
                            <option value="Registro Civil">
                            <option value="Cedula de Extranjeria">
                            <option value="Otros">
                        </datalist>
                        <label>Tipo de Documento*</label>
                    </div>
                    <div class="nro-dcto">
                        <input type="number">
                        <label>Numero de Documento*</label>
                    </div>
                    <div class="sexo">
                        <input type="text">
                        <label>Sexo</label>
                    </div>
                </div>

            </div>

            <h1>Evolución</h1>
 
            <div class="datos-paciente general-2">

                <div class="articulacion evolucion">

                    <button class="nueva evolucion" title="Nueva Evolución">
                        <i class="fa-solid fa-plus"></i>
                        <h3>Nueva Evolución</h3>
                    </button>

                    <button class="nueva evolucion guardar" title="Guardar Evolución">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <h3>Guardar</h3>
                    </button>

                    <div class="fechas-paciente general-1 evolucion evl">

                        <div class="fecha-n evolucion evl">
                            <input type="date">
                            <label>Fecha*</label>
                        </div>

                        <div class="años evolucion evl">
                            <input type="text">
                            <label>Diente</label>
                        </div>

                        <div class="años evolucion actv">
                            <input type="text">
                            <label>Actividad</label>
                        </div>

                        <div class="años evolucion evl">
                            <input type="number">
                            <label>Valor Copago</label>
                        </div>
                    </div>

                    <h1>Descripción Del Procedimiento & Codigo CUPS</h1>

                    <div class="consulta evolucion">
                        <div class="cuadro-texto evolucion">
                            <textarea name="" id="" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto."></textarea>
                        </div>
                    </div>

                </div>

                <div class="datos-paciente general-2">

                    <div class="documento general-1 evolucion">

                        <div class="nro-dcto evolucion">
                            <input type="text">
                            <label>Firma del Odontólogo*</label>
                        </div>

                        <div class="sexo evolucion">
                            <input type="text">
                            <label>Firma del Paciente</label>
                        </div>
                    </div>

                </div>

            </div>


            <div class="botones">

                <div class="boton">
                    <button class="fin">
                        <p>Guardar & Finalizar</p>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </div>

                <div class="pdf">
                    <i class="fa-regular fa-file-pdf"></i>
                    <button>
                        <h5>Generar PDF</h5>
                        <i class="fa-solid fa-download"></i>
                    </button>
                </div>
            </div>   

        </form>
    </div>

</div>






<?php include '../Modules/templates/footer.php'; ?>