<?php

include '../../functions/funcionesSql.php';
include '../../functions/consultasGenerales.php';

//* peticiones tipo get
if (count($_GET) > 0) {
    include '../../functions/bdconection.php';
}

//* peticiones tipo post
if (count($_POST) > 0) {
    
    if ($_POST['tipoPeticion'] === 'consulta1') {

        $informacionFormConsulta1 = json_decode($_POST['informacionFormConsulta1']);

        //*preparando variables para insercion tabla consultas

        $fechaConsulta = $informacionFormConsulta1->fechaConsulta;
        $motivoConsulta = $informacionFormConsulta1->motivoConsulta;
        $antecedentesOdontologicos = $informacionFormConsulta1->antecedentesOdontologicos;
        $evolucionEstadoActual = $informacionFormConsulta1->evolucionEstadoActual;
        $examenEstomatologico = $informacionFormConsulta1->examenEstomatologico;
        $documentoPacienteTrabajar = $informacionFormConsulta1->pacienteTrabajar;

        $inserccionConsulta = crearInsert('consultas', 'fecha_consulta, motivo_consulta, antecedentes_odontologicos_medicos_generales, evolucion_estadoA, examen_estomatologico, numero_documento_paciente_FK', [$fechaConsulta, $motivoConsulta, $antecedentesOdontologicos, $evolucionEstadoActual, $examenEstomatologico, $documentoPacienteTrabajar]);

        if ($inserccionConsulta['proceso'] = 'correcto') {
            //*preparando variables tabla: articulaciones_temporo_mandibulares MYSQL

            $articulaciones = $informacionFormConsulta1->articulacionTemporoMandibular;
            $idConsultas = $inserccionConsulta['id_creado'];


            foreach ($articulaciones as $articulacion => $estadoSINO) {

                $inserccionArticulaciones = crearInsert('articulaciones_temporo_mandibulares', 'hallazgos_clinicos, sano, codigo_consultas_FK ', [$articulacion, $estadoSINO, $idConsultas]);

            }

            if ($inserccionArticulaciones['proceso'] = 'correcto') {
                echo json_encode($inserccionArticulaciones);
            } else {
                echo json_encode($inserccionArticulaciones);
            }
            
            
        } else {
            echo json_encode($inserccionConsulta);
        }
        
        
    }
    
} 