<?php
include_once '../Modules/functions/sessions.php';

if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost'.$rootViews.'/login.php');
}

$pacienteTrabajar = $_GET['cedulaPaciente'];

?>
<?php include '../Modules/templates/head.php'; ?>

<div class="cont-pacientes">

    <div class="pacientes">

        <div class="logo-admin vistaFConsultas">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia">
            <h1>Hitoria clinica odontologica</h1>
            <h3>Consulta Odontológica</h3>

        </div>
        <div class="salida">
            <a href="inicio.php">
                <p>Ir a Inicio</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>
        <form id="formConsulta1">
            <?php //Datos de consulta 
            ?>

            <div class="padreFechaHCI">
                <div class="H-CI">
                    <h1>N° H.CI (colocar nro consulta)</h1>
                </div>

                <div class="general-2 fecha">
                    <div class="fechaConsulta">
                        <input type="date" id="fechaConsulta" required>
                        <label>Fecha de consulta</label>
                    </div>
                </div>
            </div>

            <h1>Antecedentes Odontológicos y Medicos Generales</h1>

            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="antecedentesOdontologicos" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required></textarea>
                </div>
            </div>

            <h1>Motivo de Consulta</h1>

            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="motivoConsulta" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required></textarea>
                </div>
            </div>

            <h1>Evolución y/o Estado Actual</h1>

            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="evolucionEstadoActual" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required></textarea>
                </div>
            </div>

            <h1>Exámen Estomatológico</h1>

            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="examenEstomatologico" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required></textarea>
                </div>
            </div>

            <div class="edad edad1 ocultar">
                <div class="años general-2 copago">
                    <input type="number">
                    <label>Valor Copago</label>
                </div>
            </div>

            <div class="tablas">

                <h3>Articulación Temporo Mandibular</h3>

                <div class="articulacion">

                    <div class="head_art">
                        <h3>Hallazgos Clínicos</h3>
                        <h3>Sano</h3>
                    </div>

                    <div class="body_art">
                        <label>Ruidos</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="ruidosSI" type="radio" name="ruidos" required>
                                <label for="ruidosSI">Si</label>
                            </div>
                            <div>
                                <input id="ruidosNO" type="radio" name="ruidos" required>
                                <label for="ruidosNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Desviación</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="desviacionSI" type="radio" name="Desviación" required>
                                <label for="desviacionSI">Si</label>
                            </div>
                            <div>
                                <input id="desviacionNO" type="radio" name="Desviación" required>
                                <label for="desviacionNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Cambio de Volumen</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="cambioVolumenSI" type="radio" name="Cambio de Volumen" required>
                                <label for="cambioVolumenSI">Si</label>
                            </div>
                            <div>
                                <input id="cambioVolumenNO" type="radio" name="Cambio de Volumen" required>
                                <label for="cambioVolumenNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Bloqueo Mandibular</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="bloqueoMandibularSI" type="radio" name="Bloqueo Mandibular" required>
                                <label for="bloqueoMandibularSI">Si</label>
                            </div>
                            <div>
                                <input id="bloqueoMandibularNO" type="radio" name="Bloqueo Mandibular" required>
                                <label for="bloqueoMandibularNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Limitacion de Apertura</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="limitacionAperturaSI" type="radio" name="Limitacion de Apertura" required>
                                <label for="limitacionAperturaSI">Si</label>
                            </div>
                            <div>
                                <input id="limitacionAperturaNO" type="radio" name="Limitacion de Apertura" required>
                                <label for="limitacionAperturaNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Dolor Articular</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="dolorArticularSI" type="radio" name="Dolor Articular" required>
                                <label for="dolorArticularSI">Si</label>
                            </div>
                            <div>
                                <input id="dolorArticularNO" type="radio" name="Dolor Articular" required>
                                <label for="dolorArticularNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art bottom_no">
                        <label>Dolor Muscular</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="dolorMuscularSI" type="radio" name="Dolor Muscular" required>
                                <label for="dolorMuscularSI">Si</label>
                            </div>
                            <div>
                                <input id="dolorMuscularNO" type="radio" name="Dolor Muscular" required>
                                <label for="dolorMuscularNO">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <input style="display: none;" type="text" id="pacienteTrabajar" value="<?php echo ($pacienteTrabajar); ?>">

            <div class="botones">

                <div class="boton const">
                    <button class="fin" id="btnGuardarContinuarConsulta1">
                        <p>Guardar & Continuar</p>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </div>
            </div>




        </form>
    </div>
</div>

<script src="../JS/consulta/guardadoConsulta1.js"></script>


<?php include '../Modules/templates/footer.php'; ?>