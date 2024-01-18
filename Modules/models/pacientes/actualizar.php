<?php

//* proceso par actualizar paciente

try {
    include '../../functions/funcionesSql.php';
    include '../../functions/consultasGenerales.php';

    //* datos enviados por el formulario
    $informacionFormRegistroPaciente = json_decode($_POST['informacionFormRegistroPaciente']);
    
    //* numero documento paciente
    $numeroDocumento = $informacionFormRegistroPaciente->numeroDocumento;

    //* actualizacion tabla Residencia
    $residenciaPaciente = obtenerRegistro('pacientes', '*', 'numero_documento = ?', [$numeroDocumento])[0];
    $pacienteDireccion = $informacionFormRegistroPaciente->pacienteDireccion;
    $municipio = $informacionFormRegistroPaciente->municipio;

    $residenciaActualizada = makeUpdate(
        'residencias',
        [
            'direccion_residencia',
            'codigo_municipio_FK'
        ],
        'codigo = ?',
        [
            $pacienteDireccion,
            $municipio
        ],
        [
            $residenciaPaciente['codigo_residencia_FK']
        ]
    );

    // var_dump($informacionFormRegistroPaciente);

    //* actualizacion tabla paciente
    $pacienteActualizado = makeUpdate(
        'pacientes',
        [
            'nombres',
            'apellidoUno',
            'apellidoDos',
            'fecha_nacimiento',
            'fecha_inicio_tratamiento',
            'telefono',
            'sexo',
            'otrosAntecedentesFamiliares',
            'codigo_tipo_documento_FK'
        ],
        'numero_documento = ?',
        [
            $informacionFormRegistroPaciente->nombre,
            $informacionFormRegistroPaciente->apellido1,
            $informacionFormRegistroPaciente->apellido2,
            $informacionFormRegistroPaciente->fechaNacicimiento,
            $informacionFormRegistroPaciente->fehcaInicio,
            $informacionFormRegistroPaciente->telefono,
            $informacionFormRegistroPaciente->sexo,
            $informacionFormRegistroPaciente->otrosAntecedentesFamiliares,
            $informacionFormRegistroPaciente->tipoDocumento
        ],
        [
            $numeroDocumento
        ]
    );

    //* actualizacion tabla antecedentesFamiliaresPacientes
    $antecedentesFamiliares = [
        $informacionFormRegistroPaciente->asma,
        $informacionFormRegistroPaciente->hipertension,
        $informacionFormRegistroPaciente->diabetesMellitus,
        $informacionFormRegistroPaciente->diabetesTipoDos,
        $informacionFormRegistroPaciente->enfermedadPulmonar,
        $informacionFormRegistroPaciente->acv,
        $informacionFormRegistroPaciente->cancer
    ];

    //* validando que hayan antecedentes
    $exitAntecentes = false;
    foreach ($antecedentesFamiliares as $antecedente) {
        if ($antecedente != '') {
            $exitAntecentes = true;
            break;
        }
    }

    if ($exitAntecentes) {
        //* eliminando antecedentes anteriores
        $eliminacionAntecedentes = makeDelete('antecedentes_familiares_pacientes', 'numero_documento_paciente_FK = ?', [$numeroDocumento]);

        //* se insertan los antecedentes
        foreach ($antecedentesFamiliares as $value) {
            if ($value != '') {
                $insercccionAntecentesFamiliaresPaciente = crearInsert('antecedentes_familiares_pacientes', 'numero_documento_paciente_FK,codigo_antecedentes_familiares_FK', [$numeroDocumento, $value]);
            }
        }
    }
    
    //* actualizacion tabla responsables
    if ($informacionFormRegistroPaciente->personaResponsable === true) {

        //* eliminando responsables anteriores
        $eliminacionResponsables = makeDelete('responsables', 'numero_documento_paciente_FK = ?', [$numeroDocumento]);


        $inserccionPersonaResponsable = crearInsert(
            'responsables', 
            'aplica,nombres,apellidos,telefono,parentezco,numero_documento_paciente_FK', 
            [
                $informacionFormRegistroPaciente->aplica,
                $informacionFormRegistroPaciente->nombrePersonaResponsable,
                $informacionFormRegistroPaciente->apellidosPersonaResponsable,
                $informacionFormRegistroPaciente->telefonoPersonaResponsable,
                $informacionFormRegistroPaciente->parentezcoPersonaResponsable,
                $numeroDocumento
            ]
        );
    }else{
        //* eliminando responsables anteriores
        $eliminacionResponsables = makeDelete('responsables', 'numero_documento_paciente_FK = ?', [$numeroDocumento]);
    }


    echo json_encode([
        'proceso' => 'correcto'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'proceso' => 'incorrecto',
        'procesodesc' => 'bd',
        'Descripcion_error' => $th->getMessage(),
        'Linea_error' => $th->getLine(),
        'File_error' => $th->getFile(),
        // 'data' => $informacionFormRegistroPaciente,
    ]);
}
