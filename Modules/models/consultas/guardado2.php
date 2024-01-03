<?php

//* importando funciones y modulos
include_once '../../functions/bdconection.php';
include_once '../../functions/funcionesSql.php';

//* extrayendo información del post
$informacionConsulta = json_decode($_POST['informacionConsulta']);

//* extrayendo información de la consulta
$consultaInfo = $informacionConsulta->consultaInfo; // std class
$dientesInfo = $informacionConsulta->dientesInfo; //array
$idConsulta = $informacionConsulta->idConsulta; //int

try {
    //* paso 1: creacion del registros de diagnosticos
    $diagnosticoCreado = crearInsert('diagnosticos', 'codigo_consultas_FK', [$idConsulta]);
    $llavesDiagnostico = ['articular', 'pulpar', 'periodontal', 'dental', 'cd', 'tejidosBlandos', 'otros'];

    foreach ((array) $consultaInfo as $llave => $valor) {
        if (in_array($llave, $llavesDiagnostico)) {

            $idDiagnostico = $diagnosticoCreado['id_creado'];
            $tipoDiagnostico = obtenerRegistro('tipos_diagnosticos', '*', 'diagnostico = ?', [$llave])[0];
            $idTipoDiagnostico = $tipoDiagnostico['codigo'];

            $diagnosticoAsociado = crearInsert(
                'codigos_diagnosticos',
                'codigo_cies_FK, codigo_tipo_diagnosticos_FK, codigo_diagnosticos_FK',
                [$valor, $idTipoDiagnostico, $idDiagnostico]
            );
        }
    }

    //* paso 2: creacion del odontograma
    $odontogramaCreado = crearInsert('odontogramas', 'codigoConsultaFK', [$idConsulta]);
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

    //* paso 4: creacion de protesis
    $protesisSi = $consultaInfo->protesisSi;
    
    if ($protesisSi === 'si') {
        $protesisTipo = $consultaInfo->protesisTipo;
        $protesisDescripcion = $consultaInfo->protesisDescripcion;

        $creacionProtesis = crearInsert(
            'protesis',
            'presenciaProtesis, tipo, descripcion, codigo_consulta_FK',
            [$protesisSi, $protesisTipo, $protesisDescripcion, $idConsulta]
        );
    }

    //* paso 5: creacion de campos de higiene
    $creacionHigiene = crearInsert(
        'higienes',
        'higieneOral, frecuencia, gradoRiesgo, sedaDental, pigmentaciones, codigo_consulta_FK',
        [
            $consultaInfo->igieneOralSi,
            $consultaInfo->frecuenciaCepilladoSi,
            $consultaInfo->gradoRiesgoSi,
            $consultaInfo->sedaDentalSi,
            $consultaInfo->pigmentacionSi,
            $idConsulta
        ]
    );
    
    $respuesta['process'] = 'success';

    // $respuesta['process'] = 'error';
    // $respuesta['errorMessage'] = $dientesInfo;
    
} catch (\Throwable $th) {
    $respuesta['process'] = 'error';
    $respuesta['errorMessage'] = $th->getMessage();
}


echo json_encode($respuesta);