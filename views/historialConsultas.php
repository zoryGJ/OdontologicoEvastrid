<?php
include_once '../Modules/functions/sessions.php';

if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/login.php');
}
?>

<?php

include_once '../Modules/functions/funcionesSql.php';

//* proceso 1: obtener el id del paciente
$idPaciente = $_GET['cedulaPaciente'];

//* proceso 2: obtener las consultas del paciente
$consultas = obtenerRegistro('consultas', '*', 'numero_documento_paciente_FK  = ?', [$idPaciente]);

if ($consultas[0] === false) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/misPacientes.php');
}

//* proceso 3: obtener los datos del paciente
$paciente = obtenerRegistro('pacientes', '*', 'numero_documento = ?', [$idPaciente])[0];
?>

<?php include '../Modules/templates/head.php'; ?>


<div class="cont-pacientes">

    <div class="pacientes">

        <div class="titulo-historia">
            <h3>Historial de Consultas Odontológicas</h3>
        </div>

        <div class="salida">
            <a href="misPacientes.php">
                <p>Regresar</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>


        <div class="padreHC">

            <div class="historial">

                <div class="dad-historial">
                    <div class="hPaciente">
                        <h3>Paciente: </h3>
                        <h3>Identificación: </h3>

                    </div>

                    <div class="hPaciente1">
                        <h2><?php echo $paciente['nombres'] . ' ' . $paciente['apellidoUno'] . ' ' . $paciente['apellidoDos']; ?></h2>
                        <h2><?php echo $paciente['numero_documento']; ?></h2>
                    </div>
                </div>


                <table id="historialConsulta">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Motivo de consulta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($consultas as $consulta) : ?>
                            <tr>
                                <td>
                                    <div><?php echo $consulta['fecha_consulta']; ?></div>
                                </td>
                                <td>
                                    <div><?php echo $consulta['motivo_consulta']; ?></div>
                                </td>
                                <td>
                                    <div>
                                        <a href="ver_consulta.php?numeroConsulta=<?php echo $consulta['codigo']; ?>" title="Ver consulta">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="" title="Generar PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>

    <?php include '../Modules/templates/footer.php'; ?>