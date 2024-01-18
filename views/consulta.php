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


//* comprobando si el paciente ya tiene una consulta
$hasConsulta = makeConsult('consultas', ['*'], 'numero_documento_paciente_FK = ?', [$pacienteTrabajar]);

if (is_bool($hasConsulta[0]) && $hasConsulta[0] === false) {
    //*consultando dientes (tabla de dientes)
    $sqlDientes = "SELECT * FROM dientes";
    $stmtDientes = $connect->prepare($sqlDientes);
    $stmtDientes->execute();
    $dientesBD = $stmtDientes->get_result()->fetch_all(MYSQLI_ASSOC);

    $emptyOdontograma = true;
} else {
    $lastConsulta = end($hasConsulta);
    $lastOdonograma = makeConsult('odontogramas', ['*'], 'codigoConsultaFK  = ?', [$lastConsulta['codigo']]);
    $lastOdonograma = end($lastOdonograma);

    $dientesBD = makeConsult(
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
        [$lastOdonograma['codigo']],
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

    $emptyOdontograma = false;
}

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


<?php include '../Modules/templates/head.php'; ?>

<link rel="stylesheet" href="../css/ondotogramaManuel.css">

<!-- <pre>
    <?php // var_dump($dientesOdontograma); 
    ?>
</pre> -->

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
            <a href="inicio.php" id="btnGoBack">
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

            <div class="only-odontograma">
                <h1 class="h1centrar g-odontograma">Odontógrama</h1>

                <div class="g-evolucion">
                    <button class="nueva evolucion g-odontograma" title="Gestionar nueva evolución" id="gestionarOdontograma">
                        <i class="fa-solid fa-teeth"></i>
                        <h3>Gestiona tu Odontograma</h3>
                    </button>
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
</div>

<div class="overlayOdontograma" id="overlay">
    <div class="odontogramaModal" id="odontogramaModal">
        <div class="encabezadoModal">
            <h1>Odontograma</h1>
            <button id="btnCloseModal">
                x
            </button>
        </div>


        <?php if ($emptyOdontograma) : ?>
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
                                    <button class="sectionDiente top"></button>
                                    <button class="sectionDiente left"></button>
                                    <button class="sectionDiente center"></button>
                                    <button class="sectionDiente right"></button>
                                    <button class="sectionDiente bot"></button>

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
                                    <button class="sectionDiente top"></button>
                                    <button class="sectionDiente left"></button>
                                    <button class="sectionDiente center"></button>
                                    <button class="sectionDiente right"></button>
                                    <button class="sectionDiente bot"></button>

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
        <?php else: ?>
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
                                //* variables para generales
                                $procesoDiente = $dienteSeccionSuperior['convencion'] != null ? 'general' : '';
                                $convencionDiente = $procesoDiente == 'general' ? $dienteSeccionSuperior['convencion'] : '';
                                $urlConvencionDienteImg = $procesoDiente == 'general' ? '../Img/convenciones/' . $dienteSeccionSuperior['figura'] : '';
                                $activeImg = $procesoDiente == 'general' ? 'active' : '';

                                //* variables para seccion
                                $procesoSeccion = $dienteSeccionSuperior['convencion_oc'] != null ? 'seccion' : '';
                                $convencionSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['convencion_oc']) : '';
                                $colorSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['color_oc']) : [];
                                $seccionesOperadas = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['seccion_oc']) : [];
                                $procesoDiente= $procesoDiente == 'general' ? 'general' : $procesoSeccion;

                                $secciones = ['top', 'left', 'center', 'right', 'bot']
                                ?>

                                <div class="diente" dienteNumero="<?php echo $dienteSeccionSuperior['numero_diente']; ?>" id="diente-<?php echo $dienteSeccionSuperior['numero_diente']; ?>" procesoDiente="<?php echo $procesoDiente; ?>" convencionDiente="<?php echo $convencionDiente; ?>">
                                    <?php for ($i = 0; $i < count($secciones); $i++) { ?>

                                        <?php
                                        $seccion = $secciones[$i];
                                        $active = '';

                                        if (in_array($seccion, $seccionesOperadas)) {

                                            $indice = array_search($seccion, $seccionesOperadas);

                                            if ($convencionSeccion[$indice] == 'Cariado') {
                                                $active = 'active cariado';
                                            } elseif ($convencionSeccion[$indice] == 'Obturado - Amalgama') {
                                                $active = 'active amalgama';
                                            } elseif ($convencionSeccion[$indice] == 'Obturado - Resina') {
                                                $active = 'active resina';
                                            }
                                        }
                                        ?>

                                        <button class="sectionDiente <?php echo $seccion . ' ' . $active; ?>"></button>
                                    <?php } ?>


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
                                //* variables para generales
                                $procesoDiente = $dienteSeccionInferior['convencion'] != null ? 'general' : '';
                                $convencionDiente = $procesoDiente == 'general' ? $dienteSeccionInferior['convencion'] : '';
                                $urlConvencionDienteImg = $procesoDiente == 'general' ? '../Img/convenciones/' . $dienteSeccionInferior['figura'] : '';
                                $activeImg = $procesoDiente == 'general' ? 'active' : '';

                                //* variables para seccion
                                $procesoSeccion = $dienteSeccionInferior['convencion_oc'] != null ? 'seccion' : '';
                                $convencionSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['convencion_oc']) : '';
                                $colorSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['color_oc']) : [];
                                $seccionesOperadas = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['seccion_oc']) : [];
                                $procesoDiente= $procesoDiente == 'general' ? 'general' : $procesoSeccion;

                                $secciones = ['top', 'left', 'center', 'right', 'bot']
                                ?>

                                <div class="diente" dienteNumero="<?php echo $dienteSeccionInferior['numero_diente']; ?>" id="diente-<?php echo $dienteSeccionInferior['numero_diente']; ?>" procesoDiente="<?php echo $procesoDiente; ?>" convencionDiente="<?php echo $convencionDiente; ?>">
                                    <?php for ($i = 0; $i < count($secciones); $i++) { ?>

                                        <?php
                                        $seccion = $secciones[$i];
                                        $active = '';

                                        if (in_array($seccion, $seccionesOperadas)) {

                                            $indice = array_search($seccion, $seccionesOperadas);

                                            if ($convencionSeccion[$indice] == 'Cariado') {
                                                $active = 'active cariado';
                                            } elseif ($convencionSeccion[$indice] == 'Obturado - Amalgama') {
                                                $active = 'active amalgama';
                                            } elseif ($convencionSeccion[$indice] == 'Obturado - Resina') {
                                                $active = 'active resina';
                                            }
                                        }
                                        ?>

                                        <button class="sectionDiente <?php echo $seccion . ' ' . $active; ?>"></button>
                                    <?php } ?>

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
        <?php endif; ?>

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

<script src="../JS/consulta/guardadoConsulta1.js"></script>
<script src="../JS/consulta/modalOdontograma.js"></script>
<script src="../JS/consulta/controladoresConsulta2.js"></script>

<script>
    const btnGoBack = document.querySelector('#btnGoBack');

    btnGoBack.addEventListener('click', (event) => {
        event.preventDefault();
        window.history.back();
    })
</script>


<?php include '../Modules/templates/footer.php'; ?>