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

//* paso 1: creacion del registros de higiene
$diagnosticoCreado = crearInsert('diagnosticos', 'codigo_consultas_FK', [$idConsulta]);
$llavesDiagnostico = ['articular', 'pulpar', 'periodontal', 'dental', 'cd', 'tejidosBlandos', 'otros'];

foreach ((array) $consultaInfo as $llave => $valor) {
    if (in_array($llave, $llavesDiagnostico)) {

        $diagnosticoAsociado = crearInsert(
            'codigos_diagnosticos', 
            'codigo_cies_FK, codigo_tipo_diagnosticos_FK, codigo_diagnosticos_FK', 
            [$valor, $diagnosticoCreado, $llave]
        );

        var_dump($diagnosticoAsociado);
    }
}

// //* paso 1: creacion del odontograma
// $odontogramaCreado = crearInsert('odontogramas', 'codigoConsultaFK', [$idConsulta]);

// var_dump($consultaInfo);
