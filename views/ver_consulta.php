<?php
    include_once '../Modules/functions/sessions.php';

    if (!controllSession()) {
        $rootViews = dirname($_SERVER['PHP_SELF']);
        header('Location: http://localhost'.$rootViews.'/login.php');
    }
?>

<?php include '../Modules/templates/head.php'; ?>
<?php include '../Modules/functions/funcionesSql.php'; ?>

<?php 

    //*consultando info de la ultuma consula del paciente
    $numeroConsulta = $_GET['numeroConsulta'];
    $consulta = obtenerRegistro('consultas', '*', 'codigo = ? order by codigo desc limit 1', [$numeroConsulta])[0];

    if (!$consulta) {
        $rootViews = dirname($_SERVER['PHP_SELF']);
        header('Location: http://localhost'.$rootViews.'/misPacientes.php');
    }

    //* consultando articulacion temporo mandibular
    $articulacionTemporoMandibularBD = obtenerRegistro('articulaciones_temporo_mandibulares', '*', 'codigo_consultas_FK = ?', [$consulta['codigo']]);

    foreach ($articulacionTemporoMandibularBD as $articulacion) {
        $articulacionTemporoMandibular[$articulacion['hallazgos_clinicos']] = $articulacion['sano'];
    }
    
?>

<?php

    //* proceso 1: consultando diagnosticos
    $diagnosticosConsultaDB = makeConsult(
        'diagnosticos', 
        [
            'diagnosticos.codigo', 
            'codigos_diagnosticos.codigo_cies_FK', 
            'codigos_diagnosticos.codigo_tipo_diagnosticos_FK', 
            'codigos_diagnosticos.codigo_diagnosticos_FK', 
            'tipos_diagnosticos.diagnostico', 
            'codigos_cies.codigo_alfa_numerico', 
            'codigos_cies.descripcion_codigo'
        ], 
        'diagnosticos.codigo_consultas_FK = ?', 
        [$consulta['codigo']],
        [
            ' INNER JOIN codigos_diagnosticos ON diagnosticos.codigo = codigos_diagnosticos.codigo_diagnosticos_FK',
            ' INNER JOIN tipos_diagnosticos ON codigos_diagnosticos.codigo_tipo_diagnosticos_FK = tipos_diagnosticos.codigo',
            ' INNER JOIN codigos_cies ON codigos_diagnosticos.codigo_cies_FK = codigos_cies.codigo'
        ]
    );

    $diagnosticosConsulta = array_map(function($diagnostico) {
        return [
            'codigo_alfa_numerico' => $diagnostico['codigo_alfa_numerico'],
            'descripcion_codigo' => $diagnostico['descripcion_codigo'],
            'diagnostico' => $diagnostico['diagnostico']
        ];
    }, $diagnosticosConsultaDB);

    $diagnosticosConsulta = array_column($diagnosticosConsulta, null, 'diagnostico');



    //* proceso 2 :  consultando protesis
    $protesisConsulta = obtenerRegistro('protesis', '*', 'codigo_consulta_FK = ?', [$consulta['codigo']])[0];
    
    if (!$protesisConsulta) {
        $protesisConsulta = [];
        $protesisConsulta['presenciaProtesis'] = 'no';
        $protesisConsulta['tipo'] = '';
        $protesisConsulta['descripcion'] = '';
    }



    //* proceso 3: consultando higiene oral
    $higieneOralConsulta = obtenerRegistro('higienes', '*', 'codigo_consulta_FK = ?', [$consulta['codigo']])[0];



    //* procesop 4: consultando dientes (tabla de dientes oIntegrado)
    $odontogramaConsulta = obtenerRegistro('odontogramas', '*', 'odontogramas.codigoConsultaFK = ?', [$consulta['codigo']])[0];
    $dientesOdontogramaConsulta = makeConsult(
        'o_integrado',
        [
            'o_integrado.codigo',
            'o_integrado.codigo_dientes_FK',
            'o_integrado.codigo_convenciones_FK',
            'o_integrado.codigo_odontogramas_FK',
            'dientes.numero_diente',
            'dientes.cuadrante',
            'dientes.cuadrante_fila',
            'convenciones.convencion',
            'convenciones.figura',
            'convenciones.color',

        ],
        'o_integrado.codigo_odontogramas_FK = ?',
        [$odontogramaConsulta['codigo']],
        [
            ' INNER JOIN dientes ON o_integrado.codigo_dientes_FK = dientes.codigo',
            ' LEFT JOIN convenciones ON o_integrado.codigo_convenciones_FK = convenciones.codigo',
            ' LEFT JOIN convencion_seccion ON o_integrado.codigo = convencion_seccion.codigo_OI_FK',
            ' LEFT JOIN convenciones_oc ON convencion_seccion.codigo_convenciones_oc_FK = convenciones_oc.codigo',
            ' LEFT JOIN seccion ON convencion_seccion.codigo_seccion_FK = seccion.codigo',
        ],
        [
            'convenciones_oc.convencion' => 'convencion_oc',
            'convenciones_oc.color' => 'color_oc',
            'seccion.nombreSeccion' => 'seccion_oc'
        ],
        [
            'o_integrado.codigo',
            'o_integrado.codigo_dientes_FK',
            'o_integrado.codigo_convenciones_FK',
            'o_integrado.codigo_odontogramas_FK',
            'dientes.numero_diente',
            'dientes.cuadrante',
            'dientes.cuadrante_fila',
            'convenciones.convencion',
            'convenciones.figura',
            'convenciones.color'
        ]
    );




    //* proceso 5:  dar formato a dientes para odonograma
    $dientesOdontograma = array(
        'cuadrante1' => array(
            'fila1' => [],
            'fila2' => []
        ),

        'cuadrante2' => array(
            'fila1' => [],
            'fila2' => []
        ),

        'cuadrante3' => array(
            'fila1' => [],
            'fila2' => []
        ),

        'cuadrante4' => array(
            'fila1' => [],
            'fila2' => []
        )
    );

    foreach ($dientesOdontogramaConsulta as $diente) {
        if ($diente['cuadrante_fila'] === 1) {
            array_push($dientesOdontograma['cuadrante' . $diente['cuadrante']]['fila1'], $diente);
        }

        if ($diente['cuadrante_fila'] === 2) {
            array_push($dientesOdontograma['cuadrante' . $diente['cuadrante']]['fila2'], $diente);
        }
    }

?>

<link rel="stylesheet" href="../css/ondotogramaManuel.css">

<!-- <pre>
    <?php var_dump($protesisConsulta); ?>
</pre> -->

<div class="cont-pacientes">

    <div class="pacientes">
        <div class="logo-admin">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia">
            <h1>HISTORIA CLINICA ODONTOLÓGICA</h1>
            <h3>Consulta Odontológica: <br> Odontógrama & Diagnóstico <br> (<?php echo $consulta['fecha_consulta']; ?>) </h3>
        </div>

        <div class="salida">
            <a href="historialConsultas.php">
                <p>Regresar</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>

        <form id="formConsulta1">
            <div class="padreFechaHCI">
                <div class="H-CI">
                    <h1>N° H.CI (Consulta No. <?php echo $consulta['codigo']; ?>)</h1>
                </div>

                <div class="general-2 fecha">
                    <div class="fechaConsulta">
                        <input type="date" id="fechaConsulta" value="<?php echo $consulta['fecha_consulta']; ?>" disabled>
                        <label>Fecha de consulta</label>
                    </div>
                </div>
            </div>

            <h1>Antecedentes Odontológicos y Medicos Generales</h1>
            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="antecedentesOdontologicos" cols="4" rows="4" placeholder="Redactar la informacion en el cuadro de texto." disabled><?php echo $consulta['antecedentes_odontologicos_medicos_generales']; ?></textarea>
                </div>
            </div>

            <h1>Motivo de Consulta</h1>
            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="motivoConsulta" cols="4" rows="4" placeholder="Redactar la informacion en el cuadro de texto." disabled><?php echo $consulta['motivo_consulta']; ?></textarea>
                </div>
            </div>

            <h1>Evolución y/o Estado Actual</h1>
            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="evolucionEstadoActual" cols="4" rows="4" placeholder="Redactar la informacion en el cuadro de texto." disabled><?php echo $consulta['evolucion_estadoA']; ?></textarea>
                </div>
            </div>

            <h1>Exámen Estomatológico</h1>
            <div class="consulta">
                <div class="cuadro-texto">
                    <textarea name="" id="examenEstomatologico" cols="4" rows="4" placeholder="Redactar la informacion en el cuadro de texto." disabled><?php echo $consulta['examen_estomatologico']; ?></textarea>
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
                                <input id="ruidosSI" type="radio" name="ruidos" disabled <?php echo $articulacionTemporoMandibular['ruidos'] != 'NO' ? 'checked' : '' ?>>
                                <label for="ruidosSI">Si</label>
                            </div>
                            <div>
                                <input id="ruidosNO" type="radio" name="ruidos" disabled <?php echo $articulacionTemporoMandibular['ruidos'] == 'NO' ? 'checked' : '' ?>>
                                <label for="ruidosNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Desviación</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="desviacionSI" type="radio" name="Desviación" disabled <?php echo $articulacionTemporoMandibular['desviacion'] != 'NO' ? 'checked' : '' ?>>
                                <label for="desviacionSI">Si</label>
                            </div>
                            <div>
                                <input id="desviacionNO" type="radio" name="Desviación" disabled <?php echo $articulacionTemporoMandibular['desviacion'] == 'NO' ? 'checked' : '' ?>>
                                <label for="desviacionNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Cambio de Volumen</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="cambioVolumenSI" type="radio" name="Cambio de Volumen" disabled <?php echo $articulacionTemporoMandibular['cambioVolumen'] != 'NO' ? 'checked' : '' ?>>
                                <label for="cambioVolumenSI">Si</label>
                            </div>
                            <div>
                                <input id="cambioVolumenNO" type="radio" name="Cambio de Volumen" disabled <?php echo $articulacionTemporoMandibular['cambioVolumen'] == 'NO' ? 'checked' : '' ?>>
                                <label for="cambioVolumenNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Bloqueo Mandibular</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="bloqueoMandibularSI" type="radio" name="Bloqueo Mandibular" disabled <?php echo $articulacionTemporoMandibular['bloqueoMandibular'] != 'NO' ? 'checked' : '' ?>>
                                <label for="bloqueoMandibularSI">Si</label>
                            </div>
                            <div>
                                <input id="bloqueoMandibularNO" type="radio" name="Bloqueo Mandibular" disabled <?php echo $articulacionTemporoMandibular['bloqueoMandibular'] == 'NO' ? 'checked' : '' ?>>
                                <label for="bloqueoMandibularNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Limitacion de Apertura</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="limitacionAperturaSI" type="radio" name="Limitacion de Apertura" disabled <?php echo $articulacionTemporoMandibular['limitacionApertura'] != 'NO' ? 'checked' : '' ?>>
                                <label for="limitacionAperturaSI">Si</label>
                            </div>
                            <div>
                                <input id="limitacionAperturaNO" type="radio" name="Limitacion de Apertura" disabled <?php echo $articulacionTemporoMandibular['limitacionApertura'] == 'NO' ? 'checked' : '' ?>>
                                <label for="limitacionAperturaNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art">
                        <label>Dolor Articular</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="dolorArticularSI" type="radio" name="Dolor Articular" disabled <?php echo $articulacionTemporoMandibular['dolorArticular'] != 'NO' ? 'checked' : '' ?>>
                                <label for="dolorArticularSI">Si</label>
                            </div>
                            <div>
                                <input id="dolorArticularNO" type="radio" name="Dolor Articular" disabled <?php echo $articulacionTemporoMandibular['dolorArticular'] == 'NO' ? 'checked' : '' ?>>
                                <label for="dolorArticularNO">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="body_art bottom_no">
                        <label>Dolor Muscular</label>
                        <div class="padreArticulaciones">
                            <div>
                                <input id="dolorMuscularSI" type="radio" name="Dolor Muscular" disabled <?php echo $articulacionTemporoMandibular['dolorMuscular'] != 'NO' ? 'checked' : '' ?>>
                                <label for="dolorMuscularSI">Si</label>
                            </div>
                            <div>
                                <input id="dolorMuscularNO" type="radio" name="Dolor Muscular" disabled <?php echo $articulacionTemporoMandibular['dolorMuscular'] == 'NO' ? 'checked' : '' ?>>
                                <label for="dolorMuscularNO">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <form id="formConsulta">
            <div class="only-odontograma">
                <h1 class="h1centrar g-odontograma">Odontógrama</h1>

                <div class="g-evolucion">
                    <button class="nueva evolucion g-odontograma" title="Gestionar nueva evolución" id="gestionarOdontograma">
                        <i class="fa-solid fa-teeth"></i>
                        <h3>Ver odontograma</h3>
                    </button>
                </div>
            </div>

            <h1 class="t-protesis">Prótesis</h1>

            <div class="protesis">
                <div class="p1">
                    <p>Presencia de Prótesis</p>

                    <div>
                        <div class="input-p">
                            <input name="protesis" id="protesisSi" value="" type="radio" <?php echo $protesisConsulta['presenciaProtesis'] == 'si' ? 'checked' : ''; ?> disabled >
                            <label for="protesisSi">SI</label>
                        </div>

                        <div class="input-p">
                            <input name="protesis" id="protesisNo" value="NO" type="radio" <?php echo $protesisConsulta['presenciaProtesis'] == 'no' ? 'checked' : ''; ?> disabled >
                            <label for="protesisNo">NO</label>
                        </div>
                    </div>
                </div>

                <div class="ok">
                    <div class="p2">
                        <textarea disabled id="protesisTipo" placeholder="Escribe aquí"><?php echo $protesisConsulta['tipo']; ?></textarea>
                        <label>Tipo</label>
                    </div>

                    <div class="p2">
                        <textarea disabled id="protesisDescripcion" placeholder="Escribe aquí"><?php echo $protesisConsulta['descripcion']; ?></textarea>
                        <label>Descripción</label>
                    </div>
                </div>
            </div>

            <h1>Higiene Oral</h1>

            <div class="higiene">
                <div>
                    <p>Higiene Oral</p>
                    <div>
                        <input name="higiene" id="igieneOralSi" value="SI" type="radio" <?php echo $higieneOralConsulta['higieneOral'] == 'no' ? 'checked' : ''; ?> disabled>
                        <label for="igieneOralSi">SI</label>
                    </div>

                    <div>
                        <input name="higiene" id="igieneOralNo" value="NO" type="radio" <?php echo $higieneOralConsulta['higieneOral'] == 'no' ? 'checked' : ''; ?> disabled>
                        <label for="igieneOralNo">NO</label>
                    </div>
                </div>

                <div>
                    <p>Frecuencia de Cepillado</p>

                    <div>
                        <input name="frecuencia" id="frecuenciaCepilladoSi" value="SI" type="radio" <?php echo $higieneOralConsulta['frecuencia'] == 'si' ? 'checked' : ''; ?> disabled>
                        <label for="frecuenciaCepilladoSi">SI</label>
                    </div>

                    <div>
                        <input name="frecuencia" id="frecuenciaCepilladoNo" value="NO" type="radio" <?php echo $higieneOralConsulta['frecuencia'] == 'no' ? 'checked' : ''; ?> disabled>
                        <label for="frecuenciaCepilladoNo">NO</label>
                    </div>
                </div>

                <div>
                    <p>Grado de Riesgo</p>

                    <div>
                        <input name="riesgo" id="gradoRiesgoSi" value="SI" type="radio" <?php echo $higieneOralConsulta['gradoRiesgo'] == 'si' ? 'checked' : ''; ?> disabled>
                        <label for="gradoRiesgoSi">SI</label>
                    </div>

                    <div>
                        <input name="riesgo" id="gradoRiesgoNo" value="NO" type="radio" <?php echo $higieneOralConsulta['gradoRiesgo'] == 'no' ? 'checked' : ''; ?> disabled>
                        <label for="gradoRiesgoNo">NO</label>
                    </div>
                </div>

                <div>
                    <p>Seda Dental</p>

                    <div>
                        <input name="seda" id="sedaDentalSi" value="SI" type="radio" <?php echo $higieneOralConsulta['sedaDental'] == 'si' ? 'checked' : ''; ?> disabled>
                        <label for="sedaDentalSi">SI</label>
                    </div>

                    <div>
                        <input name="seda" id="sedaDentalNo" value="NO" type="radio" <?php echo $higieneOralConsulta['sedaDental'] == 'no' ? 'checked' : ''; ?> disabled>
                        <label for="sedaDentalNo">NO</label>
                    </div>
                </div>

                <div>
                    <p>Pigmentaciones</p>

                    <div>
                        <input name="pigmento" id="pigmentacionSi" value="SI" type="radio" <?php echo $higieneOralConsulta['pigmentaciones'] == 'si' ? 'checked' : ''; ?> disabled>
                        <label for="pigmentacionSi">SI</label>
                    </div>

                    <div>
                        <input name="pigmento" id="pigamentacionNo" value="NO" type="radio" <?php echo $higieneOralConsulta['pigmentaciones'] == 'no' ? 'checked' : ''; ?> disabled>
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
                        <input type="text" disabled value="<?php echo isset($diagnosticosConsulta['articular']) ? $diagnosticosConsulta['articular']['codigo_alfa_numerico'].' '.$diagnosticosConsulta['articular']['descripcion_codigo'] : ''; ?>" id="datalistArticular" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Pulpar</label>
                        <input type="text" disabled value="<?php echo isset($diagnosticosConsulta['pulpar']) ? $diagnosticosConsulta['pulpar']['codigo_alfa_numerico'].' '.$diagnosticosConsulta['pulpar']['descripcion_codigo'] : ''; ?>" id="datalistPulpar" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Periodontal</label>
                        <input type="text" disabled value="<?php echo isset($diagnosticosConsulta['periodontal']) ? $diagnosticosConsulta['periodontal']['codigo_alfa_numerico'].' '.$diagnosticosConsulta['periodontal']['descripcion_codigo'] : ''; ?>" id="datalistPeriodontal" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Dental</label>
                        <input type="text" disabled value="<?php echo isset($diagnosticosConsulta['dental']) ? $diagnosticosConsulta['dental']['codigo_alfa_numerico'].' '.$diagnosticosConsulta['dental']['descripcion_codigo'] : ''; ?>" id="datalistDental" list="articular" placeholder="Seleccionar...">

                    </div>

                    <div class="body_art ba_1">
                        <label>C y D</label>
                        <input type="text" disabled value="<?php echo isset($diagnosticosConsulta['cd']) ? $diagnosticosConsulta['cd']['codigo_alfa_numerico'].' '.$diagnosticosConsulta['cd']['descripcion_codigo'] : ''; ?>" id="datalistCD" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Tejidos Blandos</label>
                        <input type="text" disabled value="<?php echo isset($diagnosticosConsulta['tejidosBlandos']) ? $diagnosticosConsulta['tejidosBlandos']['codigo_alfa_numerico'].' '.$diagnosticosConsulta['tejidosBlandos']['descripcion_codigo'] : ''; ?>" id="datalistTejidosBlandos" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1 bottom_no">
                        <label>Otros</label>
                        <input type="text" disabled value="<?php echo isset($diagnosticosConsulta['otros']) ? $diagnosticosConsulta['otros']['codigo_alfa_numerico'].' '.$diagnosticosConsulta['otros']['descripcion_codigo'] : ''; ?>" id="datalistOtros" list="articular" placeholder="Escribir...">
                    </div>

                    <datalist id="articular">
                        <?php foreach ($codigosCIES as $codigo) { ?>
                            <option value="<?php echo $codigo['codigo_alfa_numerico'] . ' - ' . $codigo['descripcion_codigo'] ?>" data-value="<?php echo $codigo['codigo'] ?>">
                            <?php } ?>
                    </datalist>
                </div>
            </div>

            <div class="consulta">
                <div class="cuadro-texto consentimiento">
                    <h3>Consentimiento Informado</h3>

                    <p>
                        Por medio de la presente constancia, en pleno uso de mis facultades mentales, otorgo en forma libre de mi consentimiento al Doctor(a) <span>EVASTRID PARDO</span> para que por su intermedio en ejercicio legal de su profesión, asi como de los demás profesionales de la salud que se requieran, y con el concurso del personal auxiliar de servicios asistenciales de la entidad, se me practique los procedimientos por mi el costo por los tratamientos que se encuentran excluidos del Plan Obligatorio de Salud-POS.
                    </p>
                </div>
            </div>

            <div class="datos-paciente general-2">
                <div class="documento general-1">
                    <div class="nro-dcto">
                        <input type="text">
                        <label>Firma del Odontólogo*</label>
                    </div>

                    <div class="sexo">
                        <input type="text">
                        <label>Firma del Paciente</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="overlayOdontograma" id="overlay">
    <div class="odontogramaModal" id="odontogramaModal">
        <div class="encabezadoModal">
            <h1>Odontograma</h1>
            <button id="btnCloseModal">
                x
            </button>
        </div>

        <div class="odontogramaM">
            <?php foreach ($dientesOdontograma as $cuadranteNombre => $seccionesCuadrante) { ?>
                <?php /*//* variables de control para cuadrantes, filas y horientaciones*/ ?>
                <?php $seccionSuperior = $seccionesCuadrante['fila1']; ?>
                <?php $seccionInferior = $seccionesCuadrante['fila2']; ?>
                <?php $horientacionInvertida = ($cuadranteNombre == 'cuadrante1' or $cuadranteNombre == 'cuadrante3') ? 'inv' : ''; ?>

                <div class="cuadrante">
                    <div class="seccionSuperior <?php echo $horientacionInvertida; ?>">
                        <?php foreach ($seccionSuperior as $dienteSeccionSuperior) { ?>

                            <?php
                                //* Obteniendo informacion del diente en odontograma

                                //* variables para generales
                                $procesoDiente = $dienteSeccionSuperior['convencion'] != null ? 'general' : '';
                                $convencionDiente = $procesoDiente == 'general' ? $dienteSeccionSuperior['convencion'] : '';
                                $urlConvencionDienteImg = $procesoDiente == 'general' ? '../Img/convenciones/'.$dienteSeccionSuperior['figura'] : '';
                                $activeImg = $procesoDiente == 'general' ? 'active' : '';

                                //* variables para seccion
                                $procesoSeccion = $dienteSeccionSuperior['convencion_oc'] != null ? 'seccion' : '';
                                $convencionSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['convencion_oc']) : '';
                                $colorSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['color_oc']) : '';
                                $secciones = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['seccion_oc']) : '';


                                //* llenando valores span
                                $spans = [
                                    'top' => [
                                        'Rojo' => '',
                                        'Azul' => '',
                                        'Verde' => ''
                                    ],
                                    'left' => [
                                        'Rojo' => '',
                                        'Azul' => '',
                                        'Verde' => ''
                                    ],
                                    'center' => [
                                        'Rojo' => '',
                                        'Azul' => '',
                                        'Verde' => ''
                                    ],
                                    'right' => [
                                        'Rojo' => '',
                                        'Azul' => '',
                                        'Verde' => ''
                                    ],
                                    'bot' => [
                                        'Rojo' => '',
                                        'Azul' => '',
                                        'Verde' => ''
                                    ]
                                ];

                                if ($secciones != '') {
                                    for ($i=0; $i < count($secciones) ; $i++) {
                                        $seccion = $secciones[$i];
                                        $color = $colorSeccion[$i];

                                        $spans[$seccion][$color] = 'active';
                                    }
                                }
                            ?>

                            <div
                                class="diente"
                                dienteNumero="<?php echo $dienteSeccionSuperior['numero_diente']; ?>"
                                id="diente-<?php echo $dienteSeccionSuperior['numero_diente']; ?>"
                                procesoDiente="<?php echo $procesoDiente; ?>"
                                convencionDiente="<?php echo $convencionDiente; ?>"
                            >
                                <button class="sectionDiente top v">
                                    <span class="<?php echo $spans['top']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['top']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['top']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente left h">
                                    <span class="<?php echo $spans['left']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['left']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['left']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente center v">
                                    <span class="<?php echo $spans['center']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['center']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['center']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente right h">
                                    <span class="<?php echo $spans['right']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['right']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['right']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente bot v">
                                    <span class="<?php echo $spans['bot']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['bot']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['bot']['Verde']; ?>"></span>
                                </button>
                                <button class="general" title="Diente General">
                                    <i class="fa-solid fa-tooth"></i>
                                    <p><?php echo $dienteSeccionSuperior['numero_diente']; ?></p>
                                </button>
                                <div class="imgOperacionGeneral <?php echo $activeImg; ?>">
                                    <img src="<?php echo $urlConvencionDienteImg; ?>" alt="">
                                </div>
                            </div>

                        <?php } ?>
                    </div>

                    <div class="seccionInferior <?php echo $horientacionInvertida; ?>">
                        <?php foreach ($seccionInferior as $dienteSeccionInferior) { ?>

                            <?php
                                    //* Obteniendo informacion del diente en odontograma

                                    //* variables para generales
                                    $procesoDiente = $dienteSeccionInferior['convencion'] != null ? 'general' : '';
                                    $convencionDiente = $procesoDiente == 'general' ? $dienteSeccionInferior['convencion'] : '';
                                    $urlConvencionDienteImg = $procesoDiente == 'general' ? '../Img/convenciones/'.$dienteSeccionInferior['figura'] : '';
                                    $activeImg = $procesoDiente == 'general' ? 'active' : '';

                                    //* variables para seccion
                                    $procesoSeccion = $dienteSeccionInferior['convencion_oc'] != null ? 'seccion' : '';
                                    $convencionSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['convencion_oc']) : '';
                                    $colorSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['color_oc']) : '';
                                    $secciones = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['seccion_oc']) : '';


                                    //* llenando valores span
                                    $spans = [
                                        'top' => [
                                            'Rojo' => '',
                                            'Azul' => '',
                                            'Verde' => ''
                                        ],
                                        'left' => [
                                            'Rojo' => '',
                                            'Azul' => '',
                                            'Verde' => ''
                                        ],
                                        'center' => [
                                            'Rojo' => '',
                                            'Azul' => '',
                                            'Verde' => ''
                                        ],
                                        'right' => [
                                            'Rojo' => '',
                                            'Azul' => '',
                                            'Verde' => ''
                                        ],
                                        'bot' => [
                                            'Rojo' => '',
                                            'Azul' => '',
                                            'Verde' => ''
                                        ]
                                    ];

                                    if ($secciones != '') {
                                        for ($i=0; $i < count($secciones) ; $i++) {
                                            $seccion = $secciones[$i];
                                            $color = $colorSeccion[$i];

                                            $spans[$seccion][$color] = 'active';
                                        }
                                    }
                                ?>

                            <div
                                class="diente"
                                dienteNumero="<?php echo $dienteSeccionInferior['numero_diente']; ?>"
                                id="diente-<?php echo $dienteSeccionInferior['numero_diente']; ?>"
                                procesoDiente="<?php echo $procesoDiente; ?>"
                                convencionDiente="<?php echo $convencionDiente; ?>"
                            >
                                <button class="sectionDiente top v">
                                    <span class="<?php echo $spans['top']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['top']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['top']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente left h">
                                    <span class="<?php echo $spans['left']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['left']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['left']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente center v">
                                    <span class="<?php echo $spans['center']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['center']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['center']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente right h">
                                    <span class="<?php echo $spans['right']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['right']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['right']['Verde']; ?>"></span>
                                </button>
                                <button class="sectionDiente bot v">
                                    <span class="<?php echo $spans['bot']['Rojo']; ?>"></span>
                                    <span class="<?php echo $spans['bot']['Azul']; ?>"></span>
                                    <span class="<?php echo $spans['bot']['Verde']; ?>"></span>
                                </button>
                                <button class="general" title="Diente General">
                                    <i class="fa-solid fa-tooth"></i>
                                    <p><?php echo $dienteSeccionInferior['numero_diente']; ?></p>
                                </button>
                                <div class="imgOperacionGeneral <?php echo $activeImg; ?>">
                                    <img src="<?php echo $urlConvencionDienteImg; ?>" alt="">
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="overlayConvencionesGeneral" id="overlayConvencionGeneral">
    <div class="convencionesGeneralModal" id="modalConvencionGeneral">
        <div class="title">
            <h2>Convencion general de diente</h2>

            <button typeConvencion="cerrar" id="btnCloseModalConvencionGeneral">
                x
            </button>
        </div>
        <div class="convenciones general">

            <?php foreach ($convencionesOrdenadas as $numeroLlave => $posicionesConvencion) { ?>

                <button typeConvencion="proceso" data-name-img='<?php echo $posicionesConvencion['figura']; ?>' data-name-process="<?php echo $posicionesConvencion['convencion']; ?>">
                    <div class="text">
                        <h3><?php echo $posicionesConvencion['convencion']; ?></h3>
                    </div>
                    <div class="image">
                        <img src="../Img/convenciones/<?php echo $posicionesConvencion['figura']; ?>" alt="">
                    </div>
                    <div class="color">
                        <p><?php echo $posicionesConvencion['color']; ?></p>
                    </div>
                </button>

            <?php } ?>

            <button typeConvencion="limpiar">
                <div class="text limpiar">
                    <h3>Limpiar</h3>
                </div>
            </button>

        </div>
    </div>
</div>

<div class="overlayConvencionesSeccionDiente" id="overlayConvencionSeccion">
    <div class="convencionesSeccionDiente" id="modalConvencionSeccion">
        <div class="title">
            <h2>Convenciones seccion diente</h2>

            <button id="btnCloseModalConvencionSeccion">
                x
            </button>
        </div>
        <div class="convenciones seccion">

            <?php $contConv = 1; ?>
            <?php foreach ($convencionesSeccionOrdenadas as $numKey => $posicionesSeccion) { ?>


                <button typeConvencion="conv<?php echo $contConv; ?>">
                    <div class="text">
                        <h3><?php echo $posicionesSeccion['convencion']; ?></h3>
                    </div>
                    <div class="image">
                        <i class="fa-solid fa-square"></i>
                    </div>
                </button>

                <?php $contConv++; ?>

            <?php } ?>

            <button typeConvencion="limpiar">
                <div class="text">
                    <h3>Limpiar</h3>
                </div>
            </button>
        </div>
    </div>
</div>


<script src="../JS/consulta/modalOdontogramaConsulta.js"></script>

<?php include '../Modules/templates/footer.php'; ?>