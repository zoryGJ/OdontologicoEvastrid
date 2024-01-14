<?php

//* importando funciones y modulos
include_once '../../functions/bdconection.php';
include_once '../../functions/funcionesSql.php';

//* extrayendo información del post
$informacionEvolucion = json_decode($_POST['informacionEvolucion']);

//* extrayendo información de la consulta
$evolucionInfo = $informacionEvolucion->evolucionInfo; // std class
$dientesInfo = $informacionEvolucion->dientesInfo; //array
$idConsulta = $informacionEvolucion->consultaInfo->numeroConsulta; //int

try {

    //* paso 1: creacion del odontograma de la evolucion
    $odontogramaCreado = crearInsert('odontogramas', 'codigoConsultaFK', [$idConsulta]);
    $idOdontograma = $odontogramaCreado['id_creado'];

    //* paso 2: creacion de los dientes del odontograma 
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

                $nombreSeccion = $operacionRealizada['nombre']; //[top, left, right, bot, center]
                $idSeccionBD = obtenerRegistro('seccion', 'codigo', 'nombreSeccion = ?', [$nombreSeccion])[0]['codigo'];
                $procesos = $operacionRealizada['procesos'];

                foreach ($procesos as $proceso) {
                    $idConvencionSeccion = obtenerRegistro('convenciones_oc', 'codigo', 'convencion = ?', [$proceso])[0]['codigo'];

                    $convenccionSeccion = crearInsert('convencion_seccion', 'codigo_convenciones_oc_FK, codigo_seccion_FK, codigo_OI_FK', [$idConvencionSeccion, $idSeccionBD, $idDienteOIntegrado]);
                }
            }
        }
    }

    //* paso 3: creacion de la evolucion
    $evolucionCreada = crearInsert('evoluciones_h_c', 'actividad, fecha_evolucion, codigo_cups, copago, descripcion_procedimiento, codigo_consultas_FK, codigo_odontograma_FK', [
        $evolucionInfo->evolucionActividad,
        $evolucionInfo->evolucionFecha, $evolucionInfo->evolucionCodigoCups, $evolucionInfo->evolucionCopago, $evolucionInfo->evolucionDescripcion, $idConsulta, $idOdontograma]);


    $respuesta['process'] = 'success';

    // $respuesta['process'] = 'error';
    // $respuesta['errorMessage'] = $dientesInfo;

} catch (\Throwable $th) {
    $respuesta['process'] = 'error';
    $respuesta['errorMessage'] = $th->getMessage();
}


echo json_encode($respuesta);
