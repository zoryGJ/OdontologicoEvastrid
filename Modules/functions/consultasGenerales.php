<?php 

function consultaDepartamentos(){
    include "bdconection.php";

    $query = "SELECT * FROM departamentos";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $listadoDepartamentos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    return $listadoDepartamentos;
}

function consultaIPS(){
    include "bdconection.php";

    $sqlIPS= "SELECT * FROM ips";
    $stmtIPS = $connect->prepare($sqlIPS);
    $stmtIPS->execute();
    $listadoIPS = $stmtIPS->get_result()->fetch_all(MYSQLI_ASSOC);

    return $listadoIPS;
}

function consultaTipoDocumentos(){
    include "bdconection.php";

    $sqlTipoDocumentos = "SELECT * FROM tipos_documentos";
    $stmtTipoDocumentos = $connect->prepare($sqlTipoDocumentos);
    $stmtTipoDocumentos->execute();
    $listadoTipoDocumentos = $stmtTipoDocumentos->get_result()->fetch_all(MYSQLI_ASSOC);

    return $listadoTipoDocumentos;
}

function consultaTipoRegimen(){
    include "bdconection.php";

    $sqlTipoRegimen = "SELECT * FROM tipos_usuarios";
    $stmtTipoRegimen = $connect->prepare($sqlTipoRegimen);
    $stmtTipoRegimen->execute();
    $listadoTipoRegimen = $stmtTipoRegimen->get_result()->fetch_all(MYSQLI_ASSOC);

    return $listadoTipoRegimen;
}

function consultaTablaCondicion($tableName, $condicion){
    include "bdconection.php";

    $sqlConsulta = "SELECT * FROM ".$tableName." ".$condicion;
    $stmtConsulta = $connect->prepare($sqlConsulta);
    $stmtConsulta->execute();
    $consultaRealizada = $stmtConsulta->get_result()->fetch_all(MYSQLI_ASSOC);

    return $consultaRealizada;
}