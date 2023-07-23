<?php
    include_once '../Modules/functions/sessions.php';

    if (!controllSession()) {
        header('Location: http://localhost/Evastrid/views/login.php');
    }
?>

<?php include '../Modules/templates/head.php'; ?>

<?php

    include '../Modules/functions/bdconection.php';

    //*consultando dientes (tabla de dientes)
    $sqlDientes = "SELECT * FROM dientes";
    $stmtDientes = $connect->prepare($sqlDientes);
    $stmtDientes->execute();
    $dientesBD = $stmtDientes->get_result()->fetch_all(MYSQLI_ASSOC);

    //*consultando convenciones Generales
    $sql = "SELECT * FROM  convenciones";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $convencionesDesordenadas = $stmt->get_result();
    $convencionesOrdenadas = $convencionesDesordenadas->fetch_all(MYSQLI_ASSOC);

    //*consultando convenciones Obturado y Cariado OC
    $sqlOC = "SELECT * FROM convenciones_oc";
    $stmtOC = $connect->prepare($sqlOC);
    $stmtOC->execute();
    $convencionesSeccionDesordenadas = $stmtOC->get_result();
    $convencionesSeccionOrdenadas = $convencionesSeccionDesordenadas->fetch_all(MYSQLI_ASSOC);

    //*consultando codigos CIES
    $sqlCIES = "SELECT * FROM codigos_cies";
    $stmtCIES = $connect->prepare($sqlCIES);
    $stmtCIES->execute();
    $codigosCIES = $stmtCIES->get_result()->fetch_all(MYSQLI_ASSOC);


    //* capturando el id de la consulta
    $idConsulta = $_GET['idConsulta'];

    //* dar formato a dientes para odonograma
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

    foreach ($dientesBD as $diente) {
        if ($diente['cuadrante_fila'] === 1) {
            array_push($dientesOdontograma['cuadrante' . $diente['cuadrante']]['fila1'], $diente);
        }

        if ($diente['cuadrante_fila'] === 2) {
            array_push($dientesOdontograma['cuadrante' . $diente['cuadrante']]['fila2'], $diente);
        }
    }

?>

<link rel="stylesheet" href="../css/ondotogramaManuel.css">

<div class="cont-pacientes">

    <div class="pacientes">
        <div class="logo-admin">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia">
            <h1>HISTORIA CLINICA ODONTOLÓGICA</h1>
            <h3>Consulta Odontológica: <br> Odontógrama & Diagnóstico</h3>
        </div>

        <div class="salida">
            <a href="inicio.php">
                <p>Ir a Inicio</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>

        <form id="formConsulta">
            <div class="only-odontograma">
                <h1 class="h1centrar g-odontograma">Odontógrama</h1>

                <div class="g-evolucion">
                    <button class="nueva evolucion g-odontograma" title="Gestionar nueva evolución" id="gestionarOdontograma">
                        <i class="fa-solid fa-teeth"></i>
                        <h3>Gestiona tu Odontograma</h3>
                    </button>
                </div>

                <!-- <div class="g-evolucion hiddenEvolucion">
                    <button class="nueva evolucion" title="Gestionar nueva evolución">
                        <i class="fa-solid fa-plus"></i>
                        <h3>Gestionar Evolución</h3>
                    </button>
                </div> -->
            </div>

            <h1 class="t-protesis">Prótesis</h1>

            <div class="protesis">
                <div class="p1">
                    <p>Presencia de Prótesis</p>

                    <div>
                        <div class="input-p">
                            <input name="protesis" id="protesisSi" value="SI" type="radio">
                            <label for="protesisSi">SI</label>
                        </div>

                        <div class="input-p">
                            <input name="protesis" id="protesisNo" value="NO" type="radio" checked>
                            <label for="protesisNo">NO</label>
                        </div>
                    </div>
                </div>

                <div class="ok">
                    <div class="p2">
                        <textarea disabled id="protesisTipo" placeholder="Escribe aquí"></textarea>
                        <label>Tipo</label>
                    </div>

                    <div class="p2">
                        <textarea disabled id="protesisDescripcion" placeholder="Escribe aquí"></textarea>
                        <label>Descripción</label>
                    </div>
                </div>
            </div>

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
                        <input type="text" id="datalistArticular" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Pulpar</label>
                        <input type="text" id="datalistPulpar" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Periodontal</label>
                        <input type="text" id="datalistPeriodontal" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Dental</label>
                        <input type="text" id="datalistDental" list="articular" placeholder="Seleccionar...">

                    </div>

                    <div class="body_art ba_1">
                        <label>C y D</label>
                        <input type="text" id="datalistCD" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Tejidos Blandos</label>
                        <input type="text" id="datalistTejidosBlandos" list="articular" placeholder="Seleccionar...">
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

            <div class="botones">
                <input type="hidden" id="idConsulta" value="<?php echo $idConsulta; ?>">
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

                            <div class="diente" dienteNumero="<?php echo $dienteSeccionSuperior['numero_diente']; ?>" id="diente-<?php echo $dienteSeccionSuperior['numero_diente']; ?>">
                                <button class="sectionDiente top v">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente left h">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente center v">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente right h">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente bot v">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="general" title="Diente General">
                                    <i class="fa-solid fa-tooth"></i>
                                    <p><?php echo $dienteSeccionSuperior['numero_diente']; ?></p>
                                </button>
                                <div class="imgOperacionGeneral">
                                    <img src="" alt="">
                                </div>
                            </div>

                        <?php } ?>
                    </div>

                    <div class="seccionInferior <?php echo $horientacionInvertida; ?>">
                        <?php foreach ($seccionInferior as $dienteSeccionInferior) { ?>

                            <div class="diente" dienteNumero="<?php echo $dienteSeccionInferior['numero_diente']; ?>" id="diente-<?php echo $dienteSeccionInferior['numero_diente']; ?>">
                                <button class="sectionDiente top v">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente left h">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente center v">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente right h">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="sectionDiente bot v">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <button class="general" title="Diente General">
                                    <i class="fa-solid fa-tooth"></i>
                                    <p><?php echo $dienteSeccionInferior['numero_diente']; ?></p>
                                </button>
                                <div class="imgOperacionGeneral">
                                    <img src="" alt="">
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

            <?php foreach ($convencionesOrdenadas as $numerosLlaves => $posicionesConvencion) { ?>

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


<script src="../JS/consulta/modalOdontograma.js"></script>
<script src="../JS/consulta/guardadoConsulta2.js"></script>
<script src="../JS/consulta/controladoresConsulta2.js"></script>

<?php include '../Modules/templates/footer.php'; ?>