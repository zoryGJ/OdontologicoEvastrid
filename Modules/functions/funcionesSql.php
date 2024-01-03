<?php

function crearInsert($tableName, $columsTable, $values)
{
    include 'bdconection.php';

    $parametrosBindParams = prepararBindParam($values);
    $parametro = $parametrosBindParams[1];
    $parametrosBindParams = $parametrosBindParams[0];


    $sql = "INSERT INTO " . $tableName . "(" . $columsTable . ") VALUES (" . $parametro . ")";
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

function obtenerRegistro($tableName, $columnasConsulta, $condicion = 'true', $values = [], $join = '')
{
    include 'bdconection.php';

    $sql = 'SELECT ' . $columnasConsulta . ' FROM ' . $tableName . ' ' . $join . ' WHERE ' . $condicion;
    $stmt = $connect->prepare($sql);

    if ($condicion !== 'true' && count($values) > 0) {
        $parametrosBindParams = prepararBindParam($values)[0];
        $stmt->bind_param($parametrosBindParams, ...$values); //* desempaquetar elementos de un arreglo...
    }

    $stmt->execute();
    $respuesta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    if (empty($respuesta)) {
        return [false];
    }

    return $respuesta;
}


function makeConsult($tableName, $columnasConsulta = [], $condicion = 'true', $values = [], $joins = [], $columnasConvenciones = [], $groupBy = [])
{
    include 'bdconection.php';


    $joinsConsulta = '';
    if (!empty($joins)) {
        foreach ($joins as $join) {
            $joinsConsulta .= $join . ' ';
        }
    }else{
        $join = '';
    }

    $columnasSelect = '';
    if (!empty($columnasConvenciones)) {
        foreach ($columnasConsulta as $columna) {
            $columnasSelect .= $columna . ', ';
        }

        foreach ($columnasConvenciones as $columna => $alias) {
            $columnasSelect .= 'GROUP_CONCAT(' . $columna . ') AS ' . $alias . ', ';
        }

        $columnasSelect = rtrim($columnasSelect, ', ');
    } else {
        $columnasSelect = '*';
    }

    if (!empty($groupBy)) {
        $groupBySQL = 'GROUP BY ';

        foreach ($groupBy as $columna) {
            $groupBySQL .= $columna . ', ';
        }

        $groupBySQL = rtrim($groupBySQL, ', ');
    }else{
        $groupBySQL = '';
    }


    $sql = 'SELECT ' . $columnasSelect . ' FROM ' . $tableName . ' ' . $joinsConsulta . ' WHERE ' . $condicion . ' ' . $groupBySQL;
    $stmt = $connect->prepare($sql);

    if ($condicion !== 'true' && count($values) > 0) {
        $parametrosBindParams = prepararBindParam($values)[0];
        $stmt->bind_param($parametrosBindParams, ...$values);
    }

    $stmt->execute();
    $respuesta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    if (empty($respuesta)) {
        return [false];
    }

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
