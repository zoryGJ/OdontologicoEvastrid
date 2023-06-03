<?php 

    //? recibimos de registro.JS la informacion traducida, colocar nombres tal cual esta en la base de datos.
    
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $cargo = $_POST['cargo'];
    $clave = $_POST['clave'];
    //!encriptamos la clave es decir le colocamos seguridad para que no se descifre.
    $claveEncriptada = password_hash($clave, PASSWORD_BCRYPT);

    //* para verificar que me llegan en las variables, hacer echo json_encode($_POST) esto envia los datos a JS y lo termino de traducir y verifico con un LOG

    //? realizamos la desestructuracion de los datos obtenidos e incluimos la base de datos

    $respuesta = array('proceso'=>'incorrecto');

    include '../functions/bdconection.php';

    //? realizamos la inserccion de los datos recibidos a la base de datos

    $sqlInsercion = "INSERT INTO administradores(nombres, apellidos, email, cargo, clave) values (?,?,?,?,?)";

    $stmt = $connect->prepare($sqlInsercion);
    $stmt->bind_param('sssss', $nombres, $apellidos, $email, $cargo, $claveEncriptada);
    $stmt->execute();


    //?hacer arreglo arriba del include se llama arreglo de respuesta
    //? realizar aqui debajo condicional de respuesta: va a verificar si hubo filas afectadas o cambiadas en la inserccion, si hubo es correcto pq se agregaron, si no es incorrecto pq no se agregaron.
    
    if ($stmt->affected_rows > 0) {
        $respuesta['proceso'] = 'correcto';
    } else {
        $respuesta['descripcion_error'] = $stmt->error;     
    }
    



    echo json_encode($respuesta); //? este señor envia la informacion procesada de php a JS para ser traducida a json y a js y ser mostrada al usuario final




