<?php

//* tomando datos de post y limpiandolos de datos malisiosos
$emailAdmin = isset($_POST['emailAdmin']) ? htmlspecialchars($_POST['emailAdmin'], ENT_QUOTES, 'UTF-8') : '';
$claveAdmin = isset($_POST['claveAdmin']) ? htmlspecialchars($_POST['claveAdmin'], ENT_QUOTES, 'UTF-8') : '';

//* conexion a base de datos
include '../functions/funcionesSql.php';

//* estructura de respuesta
$respuesta = array(
    'process' => 'error',
    'dataResponse' => 'Usuario no encontrado'
);

//* consultado usuario
$admin = makeConsult('administradores', ['*'], 'email = ?', [$emailAdmin])[0];

//* comprobando si existe el usuario

if (!(is_bool($admin) && $admin == false)) {
    $claveAdminBD = $admin['clave'];

    //* compronando claves
    if (password_verify($claveAdmin, $claveAdminBD)) {

        //*iniciando session
        session_start();
        $_SESSION['idAdmin'] = $admin['codigo'];
        $_SESSION['nombre'] = $admin['nombres'] . ' ' . $admin['apellidos'];

        //* respuesta correcta
        $respuesta['process'] = 'success';
        $respuesta['dataResponse'] = $_SESSION;
    } else {
        $respuesta['dataResponse'] = 'Clave incorrecta';
    }
} else {
    $respuesta['dataResponse'] = 'El administrador ingresado no se encuentra registrado';
}

//* retornando respuesta
echo json_encode($respuesta);
