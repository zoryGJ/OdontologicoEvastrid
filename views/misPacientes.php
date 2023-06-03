<?php 
  include_once '../Modules/functions/sessions.php';
  include_once '../Modules/functions/consultasGenerales.php';

  if (!controllSession()) {
    header('Location: http://localhost/Evastrid/views/login.php');
  }

  $pacientes = consultaTablaCondicion('pacientes',"");
?>
<?php include '../Modules/templates/head.php'; ?>

<div class="cont-pacientes">
    <div class="pacientes">
        <div class="logo-admin patient">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia misPacientes">
            <h3>Mis Pacientes <i class="fa-solid fa-hand-holding-heart"></i></h3>

        </div>
        <div class="salida">
            <a href="inicio.php">
                <p>Ir a Inicio</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>
        <table id="misPacientes">

            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($pacientes as $paciente) { ?>
                    <tr>
                    <td><?php echo $paciente['numero_documento']; ?></td>
                    <td><?php echo $paciente['nombres']; ?></td>
                    <td><?php echo $paciente['apellidoUno']." ".$paciente['apellidoDos']; ?></td>
                    <td class="ultimoTD">
                            <a href="registro_pacientes.php">
                                <button class="linea1" title="Editar Paciente">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>

                            <a href="f_consultas.php?cedulaPaciente=<?php echo $paciente['numero_documento']; ?>">
                                <button class="linea2" title="Nueva Consulta">
                                    <i class="fa-solid fa-file-medical"></i>
                                </button>
                            </a>

                            <a href="f_consultas2.php">
                                <button title="Última Consulta">
                                    <i class="fa-solid fa-tooth"></i>
                                </button>
                            </a>

                            <a href="historialConsultas.php">
                                <button title="Ver Historia Odontolgica">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>

                            <a href="">
                                <button title="Eliminar Paciente">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>





<?php include '../Modules/templates/footer.php'; ?>