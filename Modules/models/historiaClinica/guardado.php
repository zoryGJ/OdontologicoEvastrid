<?php


//* importando funciones y modulos
include_once '../../functions/bdconection.php';
include_once '../../functions/funcionesSql.php';

//* extrayendo información del post
$informacionHistoria = json_decode($_POST['informacionHistoria']);

//* extrayendo información de la historia
$historiaInfo = $informacionHistoria->historiaInfo; // std class
$cedulaPaciente = $informacionHistoria->pacienteTrabajar; //int
$articulaciones = $informacionHistoria->articulacionTemporoMandibular;


function nuevaHistoriaClinica($historiaInfo, $historiaClinica, $articulaciones)
{
    $idHistoriaClinica = $historiaClinica['Codigo'];

    //* paso 2: creacion del registros de diagnosticos
    $diagnosticoCreado = crearInsert('diagnosticos', 'codigo_historia_clinica_FK', [$idHistoriaClinica]);
    $llavesDiagnostico = ['articular', 'pulpar', 'periodontal', 'dental', 'cd', 'tejidosBlandos', 'otros'];

    foreach ((array) $historiaInfo as $llave => $valor) {
        if (in_array($llave, $llavesDiagnostico)) {

            $idDiagnostico = $diagnosticoCreado['id_creado'];
            $tipoDiagnostico = obtenerRegistro('tipos_diagnosticos', '*', 'diagnostico = ?', [$llave])[0];
            $idTipoDiagnostico = $tipoDiagnostico['codigo'];

            crearInsert(
                'codigos_diagnosticos',
                'codigo_cies_FK, codigo_tipo_diagnosticos_FK, codigo_diagnosticos_FK',
                [$valor, $idTipoDiagnostico, $idDiagnostico]
            );
        }
    }

    //* paso 3: creacion de protesis
    $protesisSi = $historiaInfo->protesisSi;

    if ($protesisSi === 'si') {
        $protesisTipo = $historiaInfo->protesisTipo;
        $protesisDescripcion = $historiaInfo->protesisDescripcion;

        crearInsert(
            'protesis',
            'presenciaProtesis, tipo, descripcion, id_historia_clinica_FK',
            [$protesisSi, $protesisTipo, $protesisDescripcion, $idHistoriaClinica]
        );
    }

    //* paso 4: creacion de campos de higiene
    crearInsert(
        'higienes',
        'higieneOral, frecuencia, gradoRiesgo, sedaDental, pigmentaciones, codigo_historia_clinica_FK',
        [
            $historiaInfo->igieneOralSi,
            $historiaInfo->frecuenciaCepilladoSi,
            $historiaInfo->gradoRiesgoSi,
            $historiaInfo->sedaDentalSi,
            $historiaInfo->pigmentacionSi,
            $idHistoriaClinica
        ]
    );

    //* paso 5: creacion de campos articulaciones temporomandibulares

    foreach ($articulaciones as $articulacion => $estadoSINO) {
        $inserccionArticulaciones = crearInsert('articulaciones_temporo_mandibulares', 'hallazgos_clinicos, sano, codigo_historia_clinica_FK ', [$articulacion, $estadoSINO, $idHistoriaClinica]);

        if ($inserccionArticulaciones == 'incorrecto') {
            echo json_encode($inserccionArticulaciones);
            return false;
        }
    }

    return true;
}

try {

    //* paso 1: creacion de historia clinica si no existe
    $historiaClinica = obtenerRegistro('historias_clinicas', '*', 'id_paciente_FK = ?', [$cedulaPaciente])[0];

    if (is_bool($historiaClinica) && $historiaClinica === false) {
        $antecedentesOdontologicos = $historiaInfo->antecedentesOdontologicos;
        $creacionHistoriaClinica = crearInsert('historias_clinicas', 'antecedentes_odontologicos_medicos_generales, id_paciente_FK', [$antecedentesOdontologicos, $cedulaPaciente]);

        $historiaClinica = obtenerRegistro('historias_clinicas', '*', 'id_paciente_FK = ?', [$cedulaPaciente])[0];

        $proceso = nuevaHistoriaClinica($historiaInfo, $historiaClinica, $articulaciones);

        if ($proceso) {
            $respuesta['process'] = 'success';
        } else {
            $respuesta['process'] = 'error';
        }
    } else {
        $respuesta['process'] = 'success';
    }

    // $respuesta['process'] = 'error';
    // $respuesta['info'] = $historiaClinica;

} catch (\Throwable $th) {
    $respuesta['process'] = 'error';
    $respuesta['errorMessage'] = $th->getMessage();
    $respuesta['info'] = $historiaClinica;
}


echo json_encode($respuesta);
