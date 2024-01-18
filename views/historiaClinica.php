<?php
include_once '../Modules/functions/sessions.php';

if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/login.php');
}

?>

<?php

$pacienteTrabajar = $_GET['cedulaPaciente'];

include '../Modules/functions/bdconection.php';
include '../Modules/functions/funcionesSql.php';


//*consultando codigos CIES
$sqlCIES = "SELECT * FROM codigos_cies";
$stmtCIES = $connect->prepare($sqlCIES);
$stmtCIES->execute();
$codigosCIES = $stmtCIES->get_result()->fetch_all(MYSQLI_ASSOC);

//*consultando datos del paciente
$paciente = makeConsult('pacientes', ['*'], 'numero_documento = ?', [$pacienteTrabajar])[0];

if (is_bool($paciente) && $paciente === false) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

//*consultando datos de la historia clinica
$historiaClinica = makeConsult('historias_clinicas', ['*'], 'id_paciente_FK = ?', [$pacienteTrabajar])[0];

if (is_bool($historiaClinica) && $historiaClinica === false) {
    $hasHistoriaClinica = false;
} else {
    $hasHistoriaClinica = true;
}

if ($hasHistoriaClinica) {

    //*consultando articulaciones temporomandiulares
    $articulacionesTemporomandiulares = makeConsult('articulaciones_temporo_mandibulares', ['*'], 'codigo_historia_clinica_FK  = ?', [$historiaClinica['Codigo']]);

    foreach ($articulacionesTemporomandiulares as $articulacion) {
        $articulacionesTemporomandiulares[$articulacion['hallazgos_clinicos']] = $articulacion['sano'];
    }


    //*consultando datos de la historia clinica
    $protesis = makeConsult('protesis', ['*'], 'id_historia_clinica_FK = ?', [$historiaClinica['Codigo']])[0];
    if (!$protesis) {
        $protesis = [];
        $protesis['presenciaProtesis'] = 'no';
        $protesis['tipo'] = '';
        $protesis['descripcion'] = '';
    }

    //*consultando datos de la historia clinica
    $higieneOral = makeConsult('higienes', ['*'], 'codigo_historia_clinica_FK = ?', [$historiaClinica['Codigo']])[0];

    //*consultando datos de la historia clinica
    $diagnosticos = makeConsult('diagnosticos', [], 'codigo_historia_clinica_FK = ?', [$historiaClinica['Codigo']])[0];

    //* $consultando los diagnosticos
    $diagnosticos = makeConsult(
        'codigos_diagnosticos',
        ['*'],
        'codigo_diagnosticos_FK  = ?',
        [$diagnosticos['codigo']],
        [
            'INNER JOIN tipos_diagnosticos ON tipos_diagnosticos.codigo = codigos_diagnosticos.codigo_tipo_diagnosticos_FK',
            'INNER JOIN codigos_cies ON codigos_cies.codigo = codigos_diagnosticos.codigo_cies_FK'
        ]
    );

    $valoresInputDiagnostico = [];
    foreach ($diagnosticos as $diagnostico) {
        $valoresInputDiagnostico[$diagnostico['diagnostico']] = $diagnostico['codigo_alfa_numerico'] . ' - ' . $diagnostico['descripcion_codigo'];
    }
}


?>

<?php include '../Modules/templates/head.php'; ?>

<div class="cont-pacientes">

    <?php if ($hasHistoriaClinica) : ?>
        <div class="pacientes">

            <div class="titulo-historia">
                <h1>Hitoria clinica odontologica</h1>
            </div>

            <div class="salida">
                <a href="inicio.php" id="btnGoBack">
                    <p>Ir a Inicio</p>
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                </a>
            </div>

            <form id="formHistoria">
                <h1>Antecedentes Odontológicos y Medicos Generales</h1>

                <div class="consulta">
                    <div class="cuadro-texto">
                        <textarea name="" id="antecedentesOdontologicos" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required><?php echo $historiaClinica['antecedentes_odontologicos_medicos_generales']; ?></textarea>
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
                                    <input id="ruidosSI" type="radio" name="ruidos" <?php echo $articulacionesTemporomandiulares['ruidos'] != 'NO' ? 'checked' : '' ?>>
                                    <label for="ruidosSI">Si</label>
                                </div>
                                <div>
                                    <input id="ruidosNO" type="radio" name="ruidos" <?php echo $articulacionesTemporomandiulares['ruidos'] == 'NO' ? 'checked' : '' ?>>
                                    <label for="ruidosNO">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="body_art">
                            <label>Desviación</label>
                            <div class="padreArticulaciones">
                                <div>
                                    <input id="desviacionSI" type="radio" name="Desviación" <?php echo $articulacionesTemporomandiulares['desviacion'] != 'NO' ? 'checked' : '' ?>>
                                    <label for="desviacionSI">Si</label>
                                </div>
                                <div>
                                    <input id="desviacionNO" type="radio" name="Desviación" <?php echo $articulacionesTemporomandiulares['desviacion'] == 'NO' ? 'checked' : '' ?>>
                                    <label for="desviacionNO">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="body_art">
                            <label>Cambio de Volumen</label>
                            <div class="padreArticulaciones">
                                <div>
                                    <input id="cambioVolumenSI" type="radio" name="Cambio de Volumen" <?php echo $articulacionesTemporomandiulares['cambioVolumen'] != 'NO' ? 'checked' : '' ?>>
                                    <label for="cambioVolumenSI">Si</label>
                                </div>
                                <div>
                                    <input id="cambioVolumenNO" type="radio" name="Cambio de Volumen" <?php echo $articulacionesTemporomandiulares['cambioVolumen'] == 'NO' ? 'checked' : '' ?>>
                                    <label for="cambioVolumenNO">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="body_art">
                            <label>Bloqueo Mandibular</label>
                            <div class="padreArticulaciones">
                                <div>
                                    <input id="bloqueoMandibularSI" type="radio" name="Bloqueo Mandibular" <?php echo $articulacionesTemporomandiulares['bloqueoMandibular'] != 'NO' ? 'checked' : '' ?>>
                                    <label for="bloqueoMandibularSI">Si</label>
                                </div>
                                <div>
                                    <input id="bloqueoMandibularNO" type="radio" name="Bloqueo Mandibular" <?php echo $articulacionesTemporomandiulares['bloqueoMandibular'] == 'NO' ? 'checked' : '' ?>>
                                    <label for="bloqueoMandibularNO">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="body_art">
                            <label>Limitacion de Apertura</label>
                            <div class="padreArticulaciones">
                                <div>
                                    <input id="limitacionAperturaSI" type="radio" name="Limitacion de Apertura" <?php echo $articulacionesTemporomandiulares['limitacionApertura'] != 'NO' ? 'checked' : '' ?>>
                                    <label for="limitacionAperturaSI">Si</label>
                                </div>
                                <div>
                                    <input id="limitacionAperturaNO" type="radio" name="Limitacion de Apertura" <?php echo $articulacionesTemporomandiulares['limitacionApertura'] == 'NO' ? 'checked' : '' ?>>
                                    <label for="limitacionAperturaNO">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="body_art">
                            <label>Dolor Articular</label>
                            <div class="padreArticulaciones">
                                <div>
                                    <input id="dolorArticularSI" type="radio" name="Dolor Articular" <?php echo $articulacionesTemporomandiulares['dolorArticular'] != 'NO' ? 'checked' : '' ?>>
                                    <label for="dolorArticularSI">Si</label>
                                </div>
                                <div>
                                    <input id="dolorArticularNO" type="radio" name="Dolor Articular" <?php echo $articulacionesTemporomandiulares['dolorArticular'] == 'NO' ? 'checked' : '' ?>>
                                    <label for="dolorArticularNO">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="body_art bottom_no">
                            <label>Dolor Muscular</label>
                            <div class="padreArticulaciones">
                                <div>
                                    <input id="dolorMuscularSI" type="radio" name="Dolor Muscular" <?php echo $articulacionesTemporomandiulares['dolorMuscular'] != 'NO' ? 'checked' : '' ?>>
                                    <label for="dolorMuscularSI">Si</label>
                                </div>
                                <div>
                                    <input id="dolorMuscularNO" type="radio" name="Dolor Muscular" <?php echo $articulacionesTemporomandiulares['dolorMuscular'] == 'NO' ? 'checked' : '' ?>>
                                    <label for="dolorMuscularNO">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <br>

                <h1 class="t-protesis">Prótesis</h1>

                <div class="protesis">
                    <div class="p1">
                        <p>Presencia de Prótesis</p>

                        <div>
                            <div class="input-p">
                                <input name="protesis" id="protesisSi" value="" type="radio" <?php echo $protesis['presenciaProtesis'] == 'si' ? 'checked' : ''; ?>>
                                <label for="protesisSi">SI</label>
                            </div>

                            <div class="input-p">
                                <input name="protesis" id="protesisNo" value="NO" type="radio" <?php echo $protesis['presenciaProtesis'] == 'no' ? 'checked' : ''; ?>>
                                <label for="protesisNo">NO</label>
                            </div>
                        </div>
                    </div>

                    <div class="ok">
                        <div class="p2">
                            <textarea id="protesisTipo" placeholder="Escribe aquí"><?php echo $protesis['tipo']; ?></textarea>
                            <label>Tipo</label>
                        </div>

                        <div class="p2">
                            <textarea id="protesisDescripcion" placeholder="Escribe aquí"><?php echo $protesis['descripcion']; ?></textarea>
                            <label>Descripción</label>
                        </div>
                    </div>
                </div>

                <br>

                <h1>Higiene Oral</h1>

                <div class="higiene">
                    <div>
                        <p>Higiene Oral</p>
                        <div>
                            <input name="higiene" id="igieneOralSi" value="SI" type="radio" <?php echo $higieneOral['higieneOral'] == 'si' ? 'checked' : ''; ?>>
                            <label for="igieneOralSi">SI</label>
                        </div>

                        <div>
                            <input name="higiene" id="igieneOralNo" value="NO" type="radio" <?php echo $higieneOral['higieneOral'] == 'no' ? 'checked' : ''; ?>>
                            <label for="igieneOralNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Frecuencia de Cepillado</p>

                        <div>
                            <input name="frecuencia" id="frecuenciaCepilladoSi" value="SI" type="radio" <?php echo $higieneOral['frecuencia'] == 'si' ? 'checked' : ''; ?>>
                            <label for="frecuenciaCepilladoSi">SI</label>
                        </div>

                        <div>
                            <input name="frecuencia" id="frecuenciaCepilladoNo" value="NO" type="radio" <?php echo $higieneOral['frecuencia'] == 'no' ? 'checked' : ''; ?>>
                            <label for="frecuenciaCepilladoNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Grado de Riesgo</p>

                        <div>
                            <input name="riesgo" id="gradoRiesgoSi" value="SI" type="radio" <?php echo $higieneOral['gradoRiesgo'] == 'si' ? 'checked' : ''; ?>>
                            <label for="gradoRiesgoSi">SI</label>
                        </div>

                        <div>
                            <input name="riesgo" id="gradoRiesgoNo" value="NO" type="radio" <?php echo $higieneOral['gradoRiesgo'] == 'no' ? 'checked' : ''; ?>>
                            <label for="gradoRiesgoNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Seda Dental</p>

                        <div>
                            <input name="seda" id="sedaDentalSi" value="SI" type="radio" <?php echo $higieneOral['sedaDental'] == 'si' ? 'checked' : ''; ?>>
                            <label for="sedaDentalSi">SI</label>
                        </div>

                        <div>
                            <input name="seda" id="sedaDentalNo" value="NO" type="radio" <?php echo $higieneOral['sedaDental'] == 'no' ? 'checked' : ''; ?>>
                            <label for="sedaDentalNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Pigmentaciones</p>

                        <div>
                            <input name="pigmento" id="pigmentacionSi" value="SI" type="radio" <?php echo $higieneOral['pigmentaciones'] == 'si' ? 'checked' : ''; ?>>
                            <label for="pigmentacionSi">SI</label>
                        </div>

                        <div>
                            <input name="pigmento" id="pigamentacionNo" value="NO" type="radio" <?php echo $higieneOral['pigmentaciones'] == 'no' ? 'checked' : ''; ?>>
                            <label for="pigamentacionNo">NO</label>
                        </div>
                    </div>
                </div>


                <div class="tablas t1">
                    <h3>Diagnósticos</h3>

                    <div class="articulacion">
                        <div class="head_art he_1">
                            <h3 class="h-d">Diagnóstico</h3>
                            <h3>Código CIES & Concepto</h3>
                        </div>

                        <div class="body_art ba_1">
                            <label>Articular</label>
                            <input value="<?php echo $valoresInputDiagnostico['articular']; ?>" type="text" id="datalistArticular" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Pulpar</label>
                            <input value="<?php echo $valoresInputDiagnostico['pulpar']; ?>" type="text" id="datalistPulpar" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Periodontal</label>
                            <input value="<?php echo $valoresInputDiagnostico['periodontal']; ?>" type="text" id="datalistPeriodontal" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Dental</label>
                            <input value="<?php echo $valoresInputDiagnostico['dental']; ?>" type="text" id="datalistDental" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>C y D</label>
                            <input value="<?php echo $valoresInputDiagnostico['cd']; ?>" type="text" id="datalistCD" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Tejidos Blandos</label>
                            <input value="<?php echo $valoresInputDiagnostico['tejidosBlandos']; ?>" type="text" id="datalistTejidosBlandos" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1 bottom_no">
                            <label>Otros</label>
                            <input value="<?php echo $valoresInputDiagnostico['otros']; ?>" type="text" id="datalistOtros" list="articular" placeholder="Escribir...">
                        </div>

                        <datalist id="articular">
                            <?php foreach ($codigosCIES as $codigo) { ?>
                                <option value="<?php echo $codigo['codigo_alfa_numerico'] . ' - ' . $codigo['descripcion_codigo'] ?>" data-value="<?php echo $codigo['codigo'] ?>">
                                <?php } ?>
                        </datalist>
                    </div>
                </div>


                <input style="display: none;" type="text" id="pacienteTrabajar" value="<?php echo ($pacienteTrabajar); ?>">

                <div class="botones">

                    <div class="boton const">
                        <button class="fin" id="btnGuardarContinuarConsulta1">
                            <p>Actualizar</p>
                        </button>
                    </div>
                </div>

            </form>
        </div>
        <script src="../JS/historiaClinica/actualizadoHistoriaClinica.js"></script>
    <?php else : ?>
        <div class="pacientes">

            <div class="titulo-historia">
                <h1>Hitoria clinica odontologica</h1>
            </div>

            <div class="salida">
                <a href="inicio.php" id="btnGoBack">
                    <p>Ir a Inicio</p>
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                </a>
            </div>

            <form id="formHistoria">
                <h1>Antecedentes Odontológicos y Medicos Generales</h1>

                <div class="consulta">
                    <div class="cuadro-texto">
                        <textarea name="" id="antecedentesOdontologicos" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required></textarea>
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

                <h1 class="t-protesis">Prótesis</h1>

                <div class="protesis">
                    <div class="p1">
                        <p>Presencia de Prótesis</p>

                        <div>
                            <div class="input-p">
                                <input name="protesis" id="protesisSi" value="SI" type="radio">
                                <label for="protesisSi">Si</label>
                            </div>

                            <div class="input-p">
                                <input name="protesis" id="protesisNo" value="NO" type="radio" checked>
                                <label for="protesisNo">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="ok">
                        <div class="p2">
                            <textarea id="protesisTipo" placeholder="Escribe aquí"></textarea>
                            <label>Tipo</label>
                        </div>

                        <div class="p2">
                            <textarea id="protesisDescripcion" placeholder="Escribe aquí"></textarea>
                            <label>Descripción</label>
                        </div>
                    </div>
                </div>

                <br>

                <h1>Higiene Oral</h1>

                <div class="higiene">
                    <div>
                        <p>Higiene Oral</p>
                        <div>
                            <input name="higiene" id="igieneOralSi" value="SI" type="radio" checked>
                            <label for="igieneOralSi">SI</label>
                        </div>

                        <div>
                            <input name="higiene" id="igieneOralNo" value="NO" type="radio">
                            <label for="igieneOralNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Frecuencia de Cepillado</p>

                        <div>
                            <input name="frecuencia" id="frecuenciaCepilladoSi" value="SI" type="radio" checked>
                            <label for="frecuenciaCepilladoSi">SI</label>
                        </div>

                        <div>
                            <input name="frecuencia" id="frecuenciaCepilladoNo" value="NO" type="radio">
                            <label for="frecuenciaCepilladoNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Grado de Riesgo</p>

                        <div>
                            <input name="riesgo" id="gradoRiesgoSi" value="SI" type="radio" checked>
                            <label for="gradoRiesgoSi">SI</label>
                        </div>

                        <div>
                            <input name="riesgo" id="gradoRiesgoNo" value="NO" type="radio">
                            <label for="gradoRiesgoNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Seda Dental</p>

                        <div>
                            <input name="seda" id="sedaDentalSi" value="SI" type="radio" checked>
                            <label for="sedaDentalSi">SI</label>
                        </div>

                        <div>
                            <input name="seda" id="sedaDentalNo" value="NO" type="radio">
                            <label for="sedaDentalNo">NO</label>
                        </div>
                    </div>

                    <div>
                        <p>Pigmentaciones</p>

                        <div>
                            <input name="pigmento" id="pigmentacionSi" value="SI" type="radio" checked>
                            <label for="pigmentacionSi">SI</label>
                        </div>

                        <div>
                            <input name="pigmento" id="pigamentacionNo" value="NO" type="radio">
                            <label for="pigamentacionNo">NO</label>
                        </div>
                    </div>
                </div>


                <div class="tablas t1">
                    <h3>Diagnósticos</h3>

                    <div class="articulacion">
                        <div class="head_art he_1">
                            <h3 class="h-d">Diagnóstico</h3>
                            <h3>Código CIES & Concepto</h3>
                        </div>

                        <div class="body_art ba_1">
                            <label>Articular</label>
                            <input type="text" id="datalistArticular" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Pulpar</label>
                            <input type="text" id="datalistPulpar" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Periodontal</label>
                            <input type="text" id="datalistPeriodontal" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Dental</label>
                            <input type="text" id="datalistDental" list="articular" required placeholder="Seleccionar...">

                        </div>

                        <div class="body_art ba_1">
                            <label>C y D</label>
                            <input type="text" id="datalistCD" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1">
                            <label>Tejidos Blandos</label>
                            <input type="text" id="datalistTejidosBlandos" list="articular" required placeholder="Seleccionar...">
                        </div>

                        <div class="body_art ba_1 bottom_no">
                            <label>Otros</label>
                            <input type="text" id="datalistOtros" list="articular" placeholder="Escribir...">
                        </div>

                        <datalist id="articular">
                            <?php foreach ($codigosCIES as $codigo) { ?>
                                <option value="<?php echo $codigo['codigo_alfa_numerico'] . ' - ' . $codigo['descripcion_codigo'] ?>" data-value="<?php echo $codigo['codigo'] ?>">
                                <?php } ?>
                        </datalist>
                    </div>
                </div>


                <input style="display: none;" type="text" id="pacienteTrabajar" value="<?php echo ($pacienteTrabajar); ?>">

                <div class="botones">

                    <div class="boton const">
                        <button class="fin" id="btnGuardarContinuarConsulta1">
                            <p>Guardar</p>
                        </button>
                    </div>
                </div>

            </form>
        </div>
        <script src="../JS/historiaClinica/guardadoHistoriaClinica.js"></script>
    <?php endif; ?>
</div>


<script src="../JS/historiaClinica/controladoresInputs.js"></script>

<script>
    const btnGoBack = document.querySelector('#btnGoBack');

    btnGoBack.addEventListener('click', (event) => {
        event.preventDefault();
        window.history.back();
    })
</script>



<?php include '../Modules/templates/footer.php'; ?>