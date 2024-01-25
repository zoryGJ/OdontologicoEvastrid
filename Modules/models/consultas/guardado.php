<?php

include '../../functions/funcionesSql.php';
include '../../functions/consultasGenerales.php';

$informacionConsulta = json_decode($_POST['informacionConsulta']);

//*preparando variables para insercion tabla consultas
$fechaConsulta = $informacionConsulta->fechaConsulta;
$motivoConsulta = $informacionConsulta->motivoConsulta;
$evolucionEstadoActual = $informacionConsulta->evolucionEstadoActual;
$examenEstomatologico = $informacionConsulta->examenEstomatologico;
$documentoPacienteTrabajar = $informacionConsulta->pacienteTrabajar;
$dientesInfo = $informacionConsulta->dientesInfo;

try {

    // echo json_encode($dientesInfo);

    //* paso 1: creacion del registros de diagnosticos
    $inserccionConsulta = crearInsert('consultas', 'fecha_consulta, motivo_consulta, evolucion_estadoA, examen_estomatologico, numero_documento_paciente_FK', [$fechaConsulta, $motivoConsulta, $evolucionEstadoActual, $examenEstomatologico, $documentoPacienteTrabajar]);

    $idConsultas = $inserccionConsulta['id_creado'];

    //* paso 2: creacion del odontograma
    $odontogramaCreado = crearInsert('odontogramas', 'codigoConsultaFK', [$idConsultas]);
    $idOdontograma = $odontogramaCreado['id_creado'];

    //* paso 3: creacion de los dientes del odontograma 
    foreach ($dientesInfo as $dienteInfo) {

        $dienteInfo = (array) $dienteInfo;
        $tipoOperacion = $dienteInfo['tipoOperacion'];
        $numeroDiente = $dienteInfo['numeroDiente'];
        $idDienteBD = obtenerRegistro('dientes', 'codigo', 'numero_diente = ?', [$numeroDiente])[0]['codigo'];

        //* creacion de un diente simple
        if ($tipoOperacion === 'NA') {
            $dienteOIntegrado = crearInsert('o_integrado', 'codigo_odontogramas_FK, codigo_dientes_FK', [$idOdontograma, $idDienteBD]);
        }

        //* creacion de un diente general
        if ($tipoOperacion === 'general') {
            $nombreConvencion = $dienteInfo['nombreConvencion'];
            $idConvencionBD = obtenerRegistro('convenciones', 'codigo', 'convencion = ?', [$nombreConvencion])[0]['codigo'];
            $dienteOIntegrado = crearInsert('o_integrado', 'codigo_odontogramas_FK, codigo_dientes_FK, codigo_convenciones_FK', [$idOdontograma, $idDienteBD, $idConvencionBD]);
        }

        //* creacion de un diente con secciones
        if ($tipoOperacion === 'seccion') {

            $dienteOIntegrado = crearInsert('o_integrado', 'codigo_odontogramas_FK, codigo_dientes_FK', [$idOdontograma, $idDienteBD]);
            $idDienteOIntegrado = $dienteOIntegrado['id_creado'];

            $operacionesSeccion = $dienteInfo['operacionesSeccion'];
            foreach ($operacionesSeccion as $operacionSeccion) {
                $operacionRealizada = (array) $operacionSeccion;

                if ($operacionRealizada['proceso'] !== '') {
                    //* extrayendo informacion de la seccion
                    $nombreSeccion = $operacionRealizada['nombre']; //[top, left, right, bot, center]
                    $idSeccionBD = obtenerRegistro('seccion', 'codigo', 'nombreSeccion = ?', [$nombreSeccion])[0]['codigo'];

                    //* extrayendo informacion de la convencion
                    $proceso = $operacionRealizada['proceso']; // cariado, obutrado amalgama, obturado resina
                    $idConvencionSeccion = obtenerRegistro('convenciones_oc', 'codigo', 'convencion = ?', [$proceso])[0]['codigo'];

                    $convenccionSeccion = crearInsert('convencion_seccion', 'codigo_convenciones_oc_FK, codigo_seccion_FK, codigo_OI_FK', [$idConvencionSeccion, $idSeccionBD, $idDienteOIntegrado]);
                }
            }
        }
    }

    echo json_encode(array(
        'consultaID' => $idConsultas,
        'proceso' => 'correcto'
    ));
} catch (\Throwable $th) {
    echo json_encode(array(
        'proceso' => 'incorrecto',
        'procesodesc' => 'bd',
        'Descripcion_error' => $th->getMessage(),
        'info' => $info
    ));
}
