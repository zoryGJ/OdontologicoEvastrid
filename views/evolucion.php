<?php
include_once '../Modules/functions/sessions.php';

if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/login.php');
}
?>

<?php

//* proceso 1: consultar fecha actual y ultima consulta
$numeroEvolucion = $_GET['numeroEvolucion'];

include '../Modules/functions/funcionesSql.php';

//* proceso 2: obteniendo evolucion
$evolucion = obtenerRegistro('evoluciones_h_c', '*', 'codigo = ?', [$numeroEvolucion])[0];

if ($evolucion == false) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/login.php');
}

//* procesop 2: consultando dientes (tabla de dientes oIntegrado) de la consulta o ultima evolucion
$odontogramaConsulta = obtenerRegistro('odontogramas', '*', 'odontogramas.codigo  = ?', [$evolucion['codigo_odontograma_FK']])[0];
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


//* proceso 3:  dar formato a dientes para odonograma
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

<?php include '../Modules/templates/head.php'; ?>

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
            <a id="btnGoBack">
                <p>Regresar</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>

        <form id="formEvolucion">
            <div class="datos-paciente general-2">
                <div class="articulacion evolucion">

                    <div class="g-evolucion">
                        <button class="nueva evolucion g-odontograma" title="Gestionar nueva evolución" id="gestionarOdontograma">
                            <i class="fa-solid fa-teeth"></i>
                            <h3>Ver odontograma</h3>
                        </button>
                    </div>

                    <div class="fechas-paciente general-1 evolucion evl">

                        <div class="fecha-n evolucion evl">
                            <input id="evolucionFecha" type="date" value="<?php echo $evolucion['fecha_evolucion']; ?>" disabled>
                            <label>Fecha*</label>
                        </div>

                        <div class="años evolucion actv">
                            <input id="evolucionActividad" type="text" value="<?php echo $evolucion['actividad']; ?>" disabled>
                            <label>Actividad</label>
                        </div>

                        <div class="años evolucion evl">
                            <input id="evolucionCodigoCups" type="text" value="<?php echo $evolucion['codigo_cups']; ?>" disabled>
                            <label>Codigo CUPS</label>
                        </div>

                        <div class="años evolucion evl">
                            <input id="evolucionCopago" type="number" value="<?php echo $evolucion['copago']; ?>" disabled>
                            <label>Valor Copago</label>
                        </div>

                        <input type="hidden" id="numeroConsulta" value="<?php echo $ultimaConsulta; ?>">
                    </div>

                    <h1>Descripción Del Procedimiento</h1>

                    <div class="consulta evolucion">
                        <div class="cuadro-texto evolucion">
                            <textarea id="evolucionDescripcion" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." disabled><?php echo $evolucion['descripcion_procedimiento']; ?></textarea>
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
    </div>
</div>


<script src="../JS/evoluciones/modalOdontograma.js"></script>

<script>
    const btnGoBack = document.querySelector('#btnGoBack');

    btnGoBack.addEventListener('click', (event) => {
        event.preventDefault();
        window.history.back();
    })
</script>


<?php include '../Modules/templates/footer.php'; ?>