<?php

    include '../../functions/funcionesSql.php';
    include '../../functions/consultasGenerales.php';

    $informacionFormConsulta1 = json_decode($_POST['informacionFormConsulta1']);

    //*preparando variables para insercion tabla consultas
    $fechaConsulta = $informacionFormConsulta1->fechaConsulta;
    $motivoConsulta = $informacionFormConsulta1->motivoConsulta;
    $antecedentesOdontologicos = $informacionFormConsulta1->antecedentesOdontologicos;
    $evolucionEstadoActual = $informacionFormConsulta1->evolucionEstadoActual;
    $examenEstomatologico = $informacionFormConsulta1->examenEstomatologico;
    $documentoPacienteTrabajar = $informacionFormConsulta1->pacienteTrabajar;

    try {
        $inserccionConsulta = crearInsert('consultas', 'fecha_consulta, motivo_consulta, antecedentes_odontologicos_medicos_generales, evolucion_estadoA, examen_estomatologico, numero_documento_paciente_FK', [$fechaConsulta, $motivoConsulta, $antecedentesOdontologicos, $evolucionEstadoActual, $examenEstomatologico, $documentoPacienteTrabajar]);

        $articulaciones = $informacionFormConsulta1->articulacionTemporoMandibular;
        $idConsultas = $inserccionConsulta['id_creado'];

        foreach ($articulaciones as $articulacion => $estadoSINO) {
            $inserccionArticulaciones = crearInsert('articulaciones_temporo_mandibulares', 'hallazgos_clinicos, sano, codigo_consultas_FK ', [$articulacion, $estadoSINO, $idConsultas]);

            if ($inserccionArticulaciones == 'incorrecto') {
                echo json_encode($inserccionArticulaciones);
                return false;
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
            'Descripcion_error' => $th->getMessage()
        ));
    }