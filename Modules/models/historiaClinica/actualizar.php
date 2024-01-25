<?php

//* importando funciones y modulos
include_once '../../functions/bdconection.php';
include_once '../../functions/funcionesSql.php';

//* extrayendo información del post
$informacionHistoria = json_decode($_POST['informacionHistoria']);

//* extrayendo información de la historia
$historiaInfo = $informacionHistoria->historiaInfo; // std class
$cedulaPaciente = $informacionHistoria->pacienteTrabajar; // int
$articulaciones = $informacionHistoria->articulacionTemporoMandibular;

try {

    //* Obtener la historia clínica existente
    $historiaClinica = obtenerRegistro('historias_clinicas', '*', 'id_paciente_FK = ?', [$cedulaPaciente])[0];

    if (!(is_bool($historiaClinica) && $historiaClinica == false)) {

        //* Actualizar antecedentes odontológicos en la historia clínica
        $columnasUpdate = ['antecedentes_odontologicos_medicos_generales'];
        $condicion = 'id_paciente_FK = ?';
        $valuesUpdate = [$historiaInfo->antecedentesOdontologicos];
        $valuesCondicion = [$cedulaPaciente];

        $updateAntecedentes = makeUpdate('historias_clinicas', $columnasUpdate, $condicion, $valuesUpdate, $valuesCondicion);

        //* actualizando diagnosticos
        $diagnosticos = obtenerRegistro('diagnosticos', '*', 'codigo_historia_clinica_FK = ?', [$historiaClinica['Codigo']])[0];

        $llavesDiagnostico = ['articular', 'pulpar', 'periodontal', 'dental', 'cd', 'tejidosBlandos', 'otros'];

        foreach ($historiaInfo as $diagnostico => $valor) {
            if (in_array($diagnostico, $llavesDiagnostico)) {
                $tipoDiagnostico = obtenerRegistro('tipos_diagnosticos', '*', 'diagnostico = ?', [$diagnostico])[0];

                $columnasUpdate = ['codigo_cies_FK '];
                $condicion = 'codigo_tipo_diagnosticos_FK  = ? AND codigo_diagnosticos_FK  = ?';
                $valuesUpdate = [$valor];
                $valuesCondicion = [$tipoDiagnostico['codigo'], $diagnosticos['codigo']];
                $updateDiagnostico = makeUpdate('codigos_diagnosticos', $columnasUpdate, $condicion, $valuesUpdate, $valuesCondicion);
            }
        }


        //* actualizando protesis
        $columnasUpdate = ['presenciaProtesis', 'tipo', 'descripcion'];
        $condicion = 'id_historia_clinica_FK = ?';
        $valuesUpdate = [$historiaInfo->protesisSi, $historiaInfo->protesisTipo, $historiaInfo->protesisDescripcion];
        $valuesCondicion = [$historiaClinica['Codigo']];
        $updateProtesis = makeUpdate('protesis', $columnasUpdate, $condicion, $valuesUpdate, $valuesCondicion);


        //* actualizando higiene
        $columnasUpdate = ['higieneOral', 'frecuencia', 'gradoRiesgo', 'sedaDental', 'pigmentaciones'];
        $condicion = 'codigo_historia_clinica_FK = ?';
        $valuesUpdate =  [
            $historiaInfo->igieneOralSi,
            $historiaInfo->frecuenciaCepilladoSi,
            $historiaInfo->gradoRiesgoSi,
            $historiaInfo->sedaDentalSi,
            $historiaInfo->pigmentacionSi
        ];
        $valuesCondicion = [$historiaClinica['Codigo']];
        $updateHigiene = makeUpdate('higienes', $columnasUpdate, $condicion, $valuesUpdate, $valuesCondicion);


        //* actualizando articulaciones temporomandibulares

        foreach ($articulaciones as $articulacion => $estadoSINO) {
            $columnasUpdate = ['sano'];
            $condicion = 'codigo_historia_clinica_FK = ? AND hallazgos_clinicos = ?';
            $valuesUpdate = [$estadoSINO];
            $valuesCondicion = [$historiaClinica['Codigo'], $articulacion];
            $updateArticulaciones = makeUpdate('articulaciones_temporo_mandibulares', $columnasUpdate, $condicion, $valuesUpdate, $valuesCondicion);
        }
    
        $respuesta['process'] = 'success';
    } else {
        $respuesta['process'] = 'error';
    }
} catch (\Throwable $th) {
    $respuesta['process'] = 'error';
    $respuesta['errorMessage'] = $th->getMessage();
    $respuesta['errorLine'] = $th->getLine();
    $respuesta['errorFile'] = $th->getFile();
    $respuesta['info'] = $historiaClinica;
}

echo json_encode($respuesta);
