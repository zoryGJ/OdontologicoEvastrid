<?php 

//* importando funciones y modulos
include_once '../../functions/bdconection.php';
include_once '../../functions/funcionesSql.php';

//* extrayendo información del post
$informacionConsulta = json_decode($_POST['informacionConsulta']);

//* extrayendo información de la consulta
$consultaInfo = $informacionConsulta->consultaInfo;// std class
$dientesInfo = $informacionConsulta->dientesInfo;//array
$idConsulta = $informacionConsulta->idConsulta;//int

//* paso 1: creacion del odontograma
$odontogramaCreado = crearInsert('odontogramas', 'codigoConsultaFK', [$idConsulta]);

var_dump($dientesInfo);
