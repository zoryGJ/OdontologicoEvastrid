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


function makeConsult($tableName, $columnasConsulta = [], $condicion = 'true', $values = [], $joins = [], $columnasAgrupar = [], $groupBy = [])
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
    
    foreach ($columnasConsulta as $columna) {
        $columnasSelect .= $columna . ', ';
    }

    if (!empty($columnasAgrupar) ) {
        foreach ($columnasAgrupar as $columna => $alias) {
            $columnasSelect .= 'GROUP_CONCAT(' . $columna . ') AS ' . $alias . ', ';
        }

        $columnasSelect = rtrim($columnasSelect, ', ');
    } else {

       if (!empty($columnasConsulta)) {
            $columnasSelect = rtrim($columnasSelect, ', ');
        } else {
            $columnasSelect = '*';
        }
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
    // var_dump([$sql, $values]);

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


function makeUpdate($tableName, $columnasUpdate, $condicion, $valuesUpdate, $valuesCondicion)
{
    include 'bdconection.php';

    $columnasUpdateQuery = '';
    $parametrosBindParams = '';

    foreach ($columnasUpdate as $columna) {
        $columnasUpdateQuery .= $columna . ' = ?, ';
        $parametrosBindParams .= 's';
    }

    $columnasUpdateQuery = rtrim($columnasUpdateQuery, ', ');

    foreach ($valuesCondicion as $value) {
        $valuesUpdate[] = $value;
        $parametrosBindParams .= 's';
    }

    $sql = 'UPDATE ' . $tableName . ' SET ' . $columnasUpdateQuery . ' WHERE ' . $condicion;
    $stmt = $connect->prepare($sql);
    // var_dump([$sql, $parametrosBindParams, $valuesUpdate]);
    $stmt->bind_param($parametrosBindParams, ...$valuesUpdate);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $respuesta['proceso'] = 'correcto';
    } else {
        $respuesta['proceso'] = 'incorrecto';
        $respuesta['procesodesc'] = 'bd';
        $respuesta['Descripcion_error'] = $stmt->error;
    }

    return $respuesta;
}

function makeDelete($tableName, $condicion, $values)
{
    include 'bdconection.php';

    $valuesDelete = '';
    $parametrosBindParams = '';

    foreach ($values as $value) {
        $valuesDelete .= $value . ', ';
        $parametrosBindParams .= 's';
    }

    $valuesDelete = rtrim($valuesDelete, ', ');

    $sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $condicion;
    $stmt = $connect->prepare($sql);
    $stmt->bind_param($parametrosBindParams, ...$values);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $respuesta['proceso'] = 'correcto';
    } else {
        $respuesta['proceso'] = 'incorrecto';
        $respuesta['procesodesc'] = 'bd';
        $respuesta['Descripcion_error'] = $stmt->error;
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
