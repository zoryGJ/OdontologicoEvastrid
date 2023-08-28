<?php

function crearInsert($tableName, $columsTable, $values)
{
    include 'bdconection.php';

    $parametrosBindParams = prepararBindParam($values);
    $parametro = $parametrosBindParams[1];
    $parametrosBindParams = $parametrosBindParams[0];


    $sql = "INSERT INTO " . $tableName . "(" . $columsTable . ") VALUES (" . $parametro . ")";
    var_dump([$tableName, $columsTable, $values, $parametrosBindParams, $parametro, $sql]);
    $stmt = $connect->prepare($sql);
    $stmt->bind_param($parametrosBindParams, ...$values); //* desempaquetar elememtos de un arreglo...
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $respuesta['proceso'] = 'correcto';
        $respuesta['id_creado'] = mysqli_insert_id($connect);
    } else {
        $respuesta['proceso'] = 'incorrecto';
        $respuesta['procesodesc'] = 'bd';
        $respuesta['Descripcion_error'] = $stmt->error;
    }

    return $respuesta;
}

function obtenerRegistro($tableName, $columnasConsulta, $condicion = 'true', $values = [])
{
    include 'bdconection.php';

    $sql = 'SELECT ' . $columnasConsulta . ' FROM ' . $tableName . ' WHERE ' . $condicion;
    $stmt = $connect->prepare($sql);

    if ($condicion !== 'true' && count($values) > 0) {
        $parametrosBindParams = prepararBindParam($values)[0];
        $stmt->bind_param($parametrosBindParams, ...$values); //* desempaquetar elememtos de un arreglo...
    }

    $stmt->execute();
    $respuesta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    return $respuesta;
}




function prepararBindParam($values)
{
    $parametro = '';

    for ($i = 0; $i < count($values); $i++) {
        $parametro = ($i + 1 === count($values)) ? $parametro . '?' : $parametro . '?,';
    }

    $parametrosBindParams = str_repeat('s', count($values));

    return [$parametrosBindParams, $parametro];
}
