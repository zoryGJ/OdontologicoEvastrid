<?php

try {

    include '../../functions/funcionesSql.php';
    include '../../functions/consultasGenerales.php';

    $cedulaPaciente = $_POST['cedulaPaciente'];

    $paciente = obtenerRegistro('pacientes', '*', 'numero_documento = ?', [$cedulaPaciente])[0];

    $pacienteEliminado = makeUpdate(
        'pacientes',
        [
            'estado'
        ],
        'numero_documento = ?',
        [
            'inactivo'
        ],
        [
            $cedulaPaciente
        ]
    );

    echo json_encode([
        'proceso' => 'correcto',
        'mensaje' => 'Paciente eliminado correctamente'
    ]);
   
} catch (\Throwable $th) {
    echo json_encode([
        'proceso' => 'incorrecto',
        'mensaje' => $th->getMessage()
    ]);
}
