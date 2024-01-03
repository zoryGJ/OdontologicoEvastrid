<?php 
  include_once '../Modules/functions/sessions.php';

  if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost'.$rootViews.'/login.php');
  }
?>
<?php include '../Modules/templates/head.php'; ?>


<div class="cont-pacientes">

    <div class="pacientes">

        <div class="logo-admin patients">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

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
                        <h2>Zoraida Isabel García Julio</h2>
                        <h2>1.044.924.492</h2>
                    </div>
                </div>


                <table id="historialConsulta">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>
                                <div>04 - 04 - 2022</div>
                            </td>
                            <td>
                                <div>Articular A-161 Estomatitis ...</div>
                            </td>
                            <td>
                                <div>
                                    <a href="">
                                        <button title="Ver Historial">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>

                                    <a href="">
                                        <button title="Generar PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </button>
                                    </a>

                                    <a href="">
                                        <button title="Imprimir">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div>04 - 04 - 2022</div>
                            </td>
                            <td>
                                <div>Articular A-161 Estomatitis ...</div>
                            </td>
                            <td>
                                <div>
                                    <a href="">
                                        <button title="Ver Historial">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>

                                    <a href="">
                                        <button title="Generar PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </button>
                                    </a>

                                    <a href="">
                                        <button title="Imprimir">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div>04 - 04 - 2022</div>
                            </td>
                            <td>
                                <div>Articular A-161 Estomatitis ...</div>
                            </td>
                            <td>
                                <div>
                                    <a href="">
                                        <button title="Ver Historial">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>

                                    <a href="">
                                        <button title="Generar PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </button>
                                    </a>

                                    <a href="">
                                        <button title="Imprimir">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>

    </div>

    <?php include '../Modules/templates/footer.php'; ?>