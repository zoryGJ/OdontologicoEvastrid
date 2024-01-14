<?php
include_once '../Modules/functions/sessions.php';

if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/login.php');
}
?>

<?php
try {
    include '../Modules/functions/funcionesSql.php';

    //* proceso 1: obtener los datos del paciente
    $numeroConsulta = $_GET['numeroConsulta'];
    $consulta = obtenerRegistro('consultas', '*', 'codigo = ?', [$numeroConsulta])[0];

    if (!$consulta) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //* proceso 2: obtener los datos del paciente
    $paciente = makeConsult(
        'pacientes',
        '*',
        'numero_documento = ?',
        [$consulta['numero_documento_paciente_FK']],
        [' INNER JOIN tipos_documentos ON tipos_documentos.codigo = pacientes.codigo_tipo_documento_FK']
    )[0];

    if (!$paciente) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $fechaNacimiento = new DateTime($paciente['fecha_nacimiento']);
    $edadPaciente = $fechaNacimiento->diff(new DateTime())->y;

    //* proceso 3: obtener las evoluciones de la consulta
    $listadoEvoluciones = makeConsult('evoluciones_h_c', '*', 'codigo_consultas_FK = ?', [$numeroConsulta]);
} catch (\Throwable $th) {
    var_dump($th);
}

?>

<?php include '../Modules/templates/head.php'; ?>

<div class="cont-pacientes">

    <div class="pacientes">

        <div class="logo-admin">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia">
            <h1>HISTORIA CLINICA ODONTOLÓGICA</h1>
            <h3>Evolución De Historia Clinica <br> Odontológica</h3>
        </div>

        <div class="salida">
            <a href="inicio.php" id="btnGoBack">
                <p>Regresar</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>

        <form action="">

            <h1>Datos del Paciente</h1>

            <div class="datos-paciente general-2">

                <div class="d-personales general-1">
                    <div class="nombre-p">
                        <input type="text" value="<?php echo $paciente['nombres']; ?>" disabled>
                        <label>Nombre (S)*</label>
                    </div>
                    <div class="apellido-1">
                        <input type="text" value="<?php echo $paciente['apellidoUno']; ?>" disabled>
                        <label>Primer Apellido*</label>
                    </div>
                    <div class="apellido-2">
                        <input type="text" value="<?php echo $paciente['apellidoDos']; ?>" disabled>
                        <label>Segundo Apellido</label>
                    </div>
                </div>

                <div class="fechas-paciente general-1">
                    <div class="fecha-n evolucion">
                        <input type="date" value="<?php echo $paciente['fecha_nacimiento']; ?>" disabled>
                        <label>Fecha de Nacimiento*</label>
                    </div>
                    <div class="años evolucion">
                        <input type="number" value="<?php echo $edadPaciente; ?>" disabled>
                        <label>Edad</label>
                    </div>
                </div>

                <div class="documento general-1">
                    <div class="tipo-dcto">
                        <input type="text" value="<?php echo $paciente['clase_de_documento']; ?>" disabled>
                        <label>Tipo de Documento*</label>
                    </div>
                    <div class="nro-dcto">
                        <input type="number" value="<?php echo $paciente['numero_documento']; ?>" disabled>
                        <label>Numero de Documento*</label>
                    </div>
                    <div class="sexo">
                        <input type="text" value="<?php echo $paciente['sexo'] ?>" disabled>
                        <label>Sexo</label>
                    </div>
                </div>

            </div>

            <div class="nueva-evolucion">
                <a href="nuevaEvolucion.php?numeroConsulta=<?php echo $numeroConsulta; ?>">
                    <i class="fa-solid fa-plus"></i> Agregar evolución
                </a>
            </div>

            <h1>Evoluciones</h1>

            <?php if (!(is_bool($listadoEvoluciones[0]) && $listadoEvoluciones[0] === false)) : ?>
                <?php if (count($listadoEvoluciones) > 0) : ?>

                    <?php $count = 1 ?>

                    <?php foreach ($listadoEvoluciones as $evolucion) : ?>

                        <form id="formEvolucion">
                            <div class="datos-paciente general-2">
                                <div class="articulacion evolucion evolucionList">

                                    <h1>Evolucion <?php echo $count; ?> </h1>
                                    <p><span>Fecha: </span> <?php echo $evolucion['fecha_evolucion']; ?></p>
                                    <p><span>Actividad: </span> <?php echo $evolucion['actividad']; ?></p>
                                    <p><span>Descripcion procedimiento: </span> <?php echo $evolucion['descripcion_procedimiento']; ?></p>

                                    <div class="btn-inpect-evolution">
                                        <div class="nueva-evolucion">
                                            <a href="evolucion.php?numeroEvolucion=<?php echo $evolucion['codigo']; ?>">
                                                <i class="fa-solid fa-eye"></i> Inspeccionar evolución
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php $count++ ?>
                    <?php endforeach; ?>
                <?php endif ?>

            <?php else : ?>
                <h4>Esta consulta no posee evoluciones registradas todavía</h4>
            <?php endif; ?>



        </form>
    </div>

</div>


<script>
    const btnGoBack = document.querySelector('#btnGoBack');

    btnGoBack.addEventListener('click', (event) => {
        event.preventDefault();
        window.history.back();
    })
</script>



<?php include '../Modules/templates/footer.php'; ?>