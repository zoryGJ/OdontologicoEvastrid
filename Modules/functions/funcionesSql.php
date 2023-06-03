<?php

function crearInsert($tableName, $columsTable, $values){

    try {

        include '../../functions/bdconection.php';
        
        $parametro = '';
        
        for ($i=0; $i < count($values); $i++) {
            
            if ($i+1 === count($values)) {
                $parametro = $parametro.'?';
            } else {
                $parametro = $parametro.'?,';
            }

        }
        
        $parametrosBindParams = str_repeat('s', count($values));

        $sql = "INSERT INTO ".$tableName."(".$columsTable.") VALUES (".$parametro.")";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param($parametrosBindParams, ...$values); //* desempaquetar elememtos de un arreglo...
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $respuesta['proceso'] = 'correcto';
            $respuesta['id_creado'] = mysqli_insert_id($connect);
        }else{
            $respuesta['proceso'] = 'incorrecto';
            $respuesta['procesodesc'] = 'bd';
            $respuesta['Descripcion_error'] = $stmt->error;
        }

        
    } catch (\Throwable $th) {
        $erroDescription = array(
            'texto del error' => $th->getLine(),
            'descripcion error' => $th->getMessage(),
            'proceso' => 'incorrecto',
            'procesodesc' => 'grave'
        );

        $respuesta = $erroDescription;
    }

    return $respuesta;

}


