<?php
include_once '../Modules/functions/sessions.php';

if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/login.php');
}
?>

<?php

//* proceso 1: consultar fecha actual y ultima consulta
$currentDate = new DateTime();
$ultimaConsulta = $_GET['numeroConsulta'];

include '../Modules/functions/funcionesSql.php';

//* proceso 2: consultando si esta consula tiene evoluciones previas
$evolucionesConsulta = obtenerRegistro('evoluciones_h_c', '*', 'evoluciones_h_c.codigo_consultas_FK = ?', [$ultimaConsulta]);


//* proceso 2.1: si tiene evoluciones previas, se consulta el ultimo odontograma
if (! (is_bool($evolucionesConsulta[0]) && $evolucionesConsulta[0] === false)) {
    $idOdontograma = $evolucionesConsulta[count($evolucionesConsulta) - 1]['codigo_odontograma_FK'];
    $odontogramaConsulta = obtenerRegistro('odontogramas', '*', 'odontogramas.codigo = ?', [$idOdontograma])[0];
}else{
    $odontogramaConsulta = obtenerRegistro('odontogramas', '*', 'odontogramas.codigoConsultaFK = ?', [$ultimaConsulta])[0];
}


//* procesop 3: consultando dientes (tabla de dientes oIntegrado) de la consulta o ultima evolucion
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


//* proceso 4:  dar formato a dientes para odonograma
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


//* proceso 5: consultando convenciones y convenciones seccion
include '../Modules/functions/bdconection.php';

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


?>

<?php include '../Modules/templates/head.php'; ?>

<!-- <pre>
    <?php var_dump($ultimaConsulta); ?>
</pre> -->

<link rel="stylesheet" href="../css/ondotogramaManuel.css">


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
            <a href="inicio.php" id="btnGoBack">
                <p>Regresar</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>

        <form id="formEvolucion">
            <div class="datos-paciente general-2">
                <div class="articulacion evolucion">

                    <h1>Nueva evolución</h1>

                    <button class="nueva evolucion guardar" title="Guardar Evolución">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <h3>Guardar</h3>
                    </button>

                    <div class="g-evolucion">
                        <button class="nueva evolucion g-odontograma" title="Gestionar nueva evolución" id="gestionarOdontograma">
                            <i class="fa-solid fa-teeth"></i>
                            <h3>Ver odontograma</h3>
                        </button>
                    </div>

                    <div class="fechas-paciente general-1 evolucion evl">

                        <div class="fecha-n evolucion evl">
                            <input id="evolucionFecha" type="date" value="<?php echo $currentDate->format('Y-m-d'); ?>" required>
                            <label>Fecha*</label>
                        </div>

                        <div class="años evolucion actv">
                            <input id="evolucionActividad" type="text" required>
                            <label>Actividad</label>
                        </div>

                        <div class="años evolucion evl">
                            <input id="evolucionCodigoCups" type="text" required>
                            <label>Codigo CUPS</label>
                        </div>

                        <div class="años evolucion evl">
                            <input id="evolucionCopago" type="number" required>
                            <label>Valor Copago</label>
                        </div>

                        <input type="hidden" id="numeroConsulta" value="<?php echo $ultimaConsulta; ?>">
                    </div>

                    <h1>Descripción Del Procedimiento</h1>

                    <div class="consulta evolucion">
                        <div class="cuadro-texto evolucion">
                            <textarea id="evolucionDescripcion" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto."></textarea>
                        </div>
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
                            $urlConvencionDienteImg = $procesoDiente == 'general' ? '../Img/convenciones/' . $dienteSeccionSuperior['figura'] : '';
                            $activeImg = $procesoDiente == 'general' ? 'active' : '';

                            //* variables para seccion
                            $procesoSeccion = $dienteSeccionSuperior['convencion_oc'] != null ? 'seccion' : '';
                            $convencionSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['convencion_oc']) : '';
                            $colorSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['color_oc']) : '';
                            $secciones = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionSuperior['seccion_oc']) : '';

                            if ($procesoSeccion == 'seccion') {
                                $procesoDiente =  'seccion';
                            }


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
                                for ($i = 0; $i < count($secciones); $i++) {
                                    $seccion = $secciones[$i];
                                    $color = $colorSeccion[$i];

                                    $spans[$seccion][$color] = 'active';
                                }
                            }
                            ?>

                            <div class="diente" dienteNumero="<?php echo $dienteSeccionSuperior['numero_diente']; ?>" id="diente-<?php echo $dienteSeccionSuperior['numero_diente']; ?>" procesoDiente="<?php echo $procesoDiente; ?>" convencionDiente="<?php echo $convencionDiente; ?>">
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
                            $urlConvencionDienteImg = $procesoDiente == 'general' ? '../Img/convenciones/' . $dienteSeccionInferior['figura'] : '';
                            $activeImg = $procesoDiente == 'general' ? 'active' : '';

                            //* variables para seccion
                            $procesoSeccion = $dienteSeccionInferior['convencion_oc'] != null ? 'seccion' : '';
                            $convencionSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['convencion_oc']) : '';
                            $colorSeccion = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['color_oc']) : '';
                            $secciones = $procesoSeccion == 'seccion' ? explode(',', $dienteSeccionInferior['seccion_oc']) : '';

                            if ($procesoSeccion == 'seccion') {
                                $procesoDiente =  'seccion';
                            }


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
                                for ($i = 0; $i < count($secciones); $i++) {
                                    $seccion = $secciones[$i];
                                    $color = $colorSeccion[$i];

                                    $spans[$seccion][$color] = 'active';
                                }
                            }
                            ?>

                            <div class="diente" dienteNumero="<?php echo $dienteSeccionInferior['numero_diente']; ?>" id="diente-<?php echo $dienteSeccionInferior['numero_diente']; ?>" procesoDiente="<?php echo $procesoDiente; ?>" convencionDiente="<?php echo $convencionDiente; ?>">
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

<script src="../JS/evoluciones/modalOdontograma.js"></script>
<script src="../JS/evoluciones/contoladoresEvolucion.js"></script>

<script src="../JS/evoluciones/guardadoEvolucion.js"></script>


<script>

    const btnGoBack = document.querySelector('#btnGoBack');

    btnGoBack.addEventListener('click', (event) => {
        event.preventDefault();
        window.history.back();
    })
</script>



<?php include '../Modules/templates/footer.php'; ?>