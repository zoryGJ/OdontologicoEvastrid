<?php

include '../../functions/funcionesSql.php';
include '../../functions/consultasGenerales.php';

//* peticiones tipo get
if (count($_GET) > 0) {
    include '../../functions/bdconection.php';

    if ($_GET['tipoPeticion'] === 'consultarDepartamento') {
        $nombreDepartamento = $_GET['nombreDepartamento'];
        $sql = "SELECT municipios.codigo, municipios.municipio FROM municipios 
                INNER JOIN departamentos 
                ON  municipios.codigo_departamento_FK = departamentos.codigo 
                WHERE departamentos.departamento = ?
        ";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('s', $nombreDepartamento);
        $stmt->execute();

        $listadoMunicipios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        echo json_encode($listadoMunicipios);
    }
}

//* peticiones tipo post
if (count($_POST) > 0) {

    if ($_POST['tipoPeticion'] === 'crearPaciente') {
        //$traductoraRespuesta = json_decode($_POST['informacionFormRegistroPaciente']);
        $informacionFormRegistroPaciente = json_decode($_POST['informacionFormRegistroPaciente']); //la variable $informacionFormRegistroPaciente viene como class.

        $consultaPacientes = consultaTablaCondicion('pacientes',"WHERE numero_documento = ".$informacionFormRegistroPaciente->numeroDocumento);

        if (!(count($consultaPacientes) > 0)) {
            //*variables tabla Residencia

            $pacienteDireccion = $informacionFormRegistroPaciente->pacienteDireccion;
            $municipio = $informacionFormRegistroPaciente->municipio;
            $inserccionResidencia = crearInsert('residencias', 'direccion_residencia, codigo_municipio_FK', [$pacienteDireccion, $municipio]);


            if ($inserccionResidencia['proceso'] === 'correcto') {

                //*table paciente (colocar las posiciones que vienen del arreglo JS)
                $numeroDocumento = $informacionFormRegistroPaciente->numeroDocumento;
                $nombre = $informacionFormRegistroPaciente->nombre;
                $apellido1 = $informacionFormRegistroPaciente->apellido1;
                $apellido2 = $informacionFormRegistroPaciente->apellido2;
                $fechaNacimiento = $informacionFormRegistroPaciente->fechaNacicimiento;
                $fechaInicioTratamiento = $informacionFormRegistroPaciente->fehcaInicio;
                $telefono = $informacionFormRegistroPaciente->telefono;
                $sexo = $informacionFormRegistroPaciente->sexo;
                $otrosAntecedentesFamiliares = $informacionFormRegistroPaciente->otrosAntecedentesFamiliares;
                $residenciaCodigo = $inserccionResidencia['id_creado'];
                $tipoDocumento = $informacionFormRegistroPaciente->tipoDocumento;
                

                $inserccionPaciente = crearInsert('pacientes', 'numero_documento,nombres,apellidoUno,apellidoDos,fecha_nacimiento,fecha_inicio_tratamiento,telefono,sexo, otrosAntecedentesFamiliares, codigo_residencia_FK,codigo_tipo_documento_FK', [$numeroDocumento, $nombre, $apellido1, $apellido2, $fechaNacimiento, $fechaInicioTratamiento, $telefono, $sexo, $otrosAntecedentesFamiliares,
                 $residenciaCodigo, $tipoDocumento]);

                if ($inserccionPaciente['proceso'] === 'correcto') {

                    //*tabla antecedentesFamiliaresPacientes
                    $asma = $informacionFormRegistroPaciente->asma;
                    $hipertensionArterial = $informacionFormRegistroPaciente->hipertension;
                    $diabetesMellitus = $informacionFormRegistroPaciente->diabetesMellitus;
                    $diabetesTipoDos = $informacionFormRegistroPaciente->diabetesTipoDos;
                    $enfermedadPulmonar = $informacionFormRegistroPaciente->enfermedadPulmonar;
                    $acv= $informacionFormRegistroPaciente->acv;
                    
                    $antecedentesFamiliares = [
                        $asma,
                        $hipertensionArterial,
                        $diabetesMellitus,
                        $diabetesTipoDos,
                        $enfermedadPulmonar,
                        $acv,
                        $informacionFormRegistroPaciente->cancer
                    ];

                    if ($informacionFormRegistroPaciente->personaResponsable === true) {

                        $aplica = $informacionFormRegistroPaciente->aplica;
                        $nombrePersonaResponsable = $informacionFormRegistroPaciente->nombrePersonaResponsable;
                        $apellidosPersonaResponsable = $informacionFormRegistroPaciente->apellidosPersonaResponsable;
                        $telefonoPersonaResponsable = $informacionFormRegistroPaciente->telefonoPersonaResponsable;
                        $parentezco = $informacionFormRegistroPaciente->parentezcoPersonaResponsable;

                        $inserccionPersonaResponsable = crearInsert('responsables', 'aplica,nombres,apellidos,telefono,parentezco,numero_documento_paciente_FK', [$aplica, $nombrePersonaResponsable, $apellidosPersonaResponsable, $telefonoPersonaResponsable, $parentezco, $numeroDocumento]);

                        if ($inserccionPersonaResponsable['proceso'] == 'correcto') {
                            foreach ($antecedentesFamiliares as $value) {
                        
                                if ($value != '') {
                                    $insercccionAntecentesFamiliaresPaciente = crearInsert('antecedentes_familiares_pacientes', 'numero_documento_paciente_FK,codigo_antecedentes_familiares_FK',[$numeroDocumento, $value]);
        
                                    if ($insercccionAntecentesFamiliaresPaciente['proceso'] != 'correcto') {
                                        break;
                                    } 
                                }
        
                            }

                            echo json_encode($insercccionAntecentesFamiliaresPaciente);

                        } else {
                            echo json_encode($inserccionPersonaResponsable);
                        }
                    } else {
                        foreach ($antecedentesFamiliares as $value) {
                        
                            if ($value != '') {
                                $insercccionAntecentesFamiliaresPaciente = crearInsert('antecedentes_familiares_pacientes', 'numero_documento_paciente_FK,codigo_antecedentes_familiares_FK',[$numeroDocumento, $value]);
    
                                if ($insercccionAntecentesFamiliaresPaciente['proceso'] != 'correcto') {
                                    break;
                                } 
                            }
    
                        }
                        echo json_encode($insercccionAntecentesFamiliaresPaciente);
                    }
                    
                } else {
                    echo json_encode($inserccionPaciente);
                }
            } else {
                echo json_encode($inserccionResidencia);
            }

        } else {
            $pacienteExistente['proceso'] = 'PacienteExistente';
            echo json_encode($pacienteExistente);
        }

        
    }

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
