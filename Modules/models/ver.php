<?php
function crear($tableName, $colums, $values){

    try {
        include 'conexion.php';

        $parametro = str_repeat('?', count($valores)); //* str_repeat cuenta y agrega los valores en la sentencia, recorre la variable
        $parametrosBindParam = str_repeat('s', count($valores));

        $sql = "INSERT INTO ".$tableName." (".$colums.") values (".$parametro.")";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($parametrosBindParam, ...$values);
        
    } catch (\Throwable $th) {
        $erroDescription = array(
            'texto del error' => $th->getLine(),
            'descripcion error' => $th->getMessage()
        );

        $resultado = $erroDescription;
    }

}


crear('Paciente', 'nombre, apellido, edad', [$nombre, $apellido, $edad]);
crear('Municipio', 'nombre, apellido, edad', [$nombre, $apellido, $edad]);
crearInsert('pac','nombre... codigo_tipo_documento_FK',[$nombre, $apellido,  $tipoDocumento]);
