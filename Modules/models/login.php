<?php 

//* tomando datos de post y limpiandolos de datos malisiosos
$emailAdmin = isset($_POST['emailAdmin']) ? htmlspecialchars($_POST['emailAdmin'], ENT_QUOTES, 'UTF-8') : '';
$claveAdmin = isset($_POST['claveAdmin']) ? htmlspecialchars($_POST['claveAdmin'], ENT_QUOTES, 'UTF-8') : '';

//* conexion a base de datos
include_once '../functions/bdconection.php';

//* estructura de respuesta
$respuesta = array(
    'process' => 'error',
    'dataResponse' => 'Usuario no encontrado'
);

//* consultado usuario
$query = 'SELECT * FROM administradores WHERE email = ?';
$stmt = $connect->prepare($query);
$stmt->bind_param('s', $emailAdmin);
$stmt->execute();

//* capturando consulta
$consultaAdmin = $stmt->get_result()->fetch_assoc();

//* compronando que lleguen datos
if (count($consultaAdmin) > 0) {

    $claveAdminBD = $consultaAdmin['clave'];
    
    //* compronando claves
    if (password_verify($claveAdmin, $claveAdminBD)) {
        
        //*iniciando session
        session_start();
        $_SESSION['idAdmin'] = $consultaAdmin['codigo'];
        $_SESSION['nombre'] = $consultaAdmin['nombres'].' '.$consultaAdmin['apellidos'];

        //* respuesta correcta
        $respuesta['process'] = 'success';
        $respuesta['dataResponse'] = $_SESSION;

    }else{
        $respuesta['dataResponse'] = 'Clave incorrecta';
    }
}

//* retornando respuesta
echo json_encode($respuesta);