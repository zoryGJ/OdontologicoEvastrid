<?php
include_once '../Modules/functions/sessions.php';
include_once '../Modules/functions/consultasGenerales.php';
include_once '../Modules/functions/funcionesSql.php';

if (!controllSession()) {
    $rootViews = dirname($_SERVER['PHP_SELF']);
    header('Location: http://localhost' . $rootViews . '/login.php');
}

//* consultas
$listadoDepartamentos = consultaDepartamentos();
$listadoIPS = consultaIPS();
$listadoTipoDocumentos = consultaTipoDocumentos();
$listadoTipoRegimen = consultaTipoRegimen();

$cedulaPaciente = $_GET['cedulaPaciente'];

$paciente = makeConsult(
    'pacientes',
    [
        'pacientes.nombres',
        'pacientes.apellidoUno',
        'pacientes.apellidoDos',
        'pacientes.fecha_nacimiento',
        'pacientes.fecha_inicio_tratamiento',
        'tipos_documentos.clase_de_documento',
        'pacientes.numero_documento',
        'pacientes.sexo',
        'pacientes.telefono',
        'residencias.direccion_residencia',
        'municipios.municipio',
        'departamentos.departamento',
        'departamentos.codigo as codigo_departamento',
        'pacientes.otrosAntecedentesFamiliares',
    ],
    "pacientes.numero_documento = ?",
    [$cedulaPaciente],
    [
        'INNER JOIN residencias ON residencias.codigo = pacientes.codigo_residencia_FK ',
        'INNER JOIN tipos_documentos ON tipos_documentos.codigo = pacientes.codigo_tipo_documento_FK ',
        'LEFT JOIN responsables ON responsables.numero_documento_paciente_FK = pacientes.numero_documento ',
        'INNER JOIN municipios ON municipios.codigo = residencias.codigo_municipio_FK ',
        'INNER JOIN departamentos ON departamentos.codigo = municipios.codigo_departamento_FK ',
    ]
)[0];

if (is_bool($paciente) && $paciente == false) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$antecedentesFamiliares = makeConsult(
    'antecedentes_familiares_pacientes',
    [
        'antecedentes_familiares.lista_antecedentes_familiares'
    ],
    "antecedentes_familiares_pacientes.numero_documento_paciente_FK  = ?",
    [$cedulaPaciente],
    [
        'INNER JOIN antecedentes_familiares ON antecedentes_familiares.codigo = antecedentes_familiares_pacientes.codigo_antecedentes_familiares_FK ',
    ]
);

if (!(is_bool($antecedentesFamiliares[0]) && $antecedentesFamiliares[0] == false)) {
    $chekboxAntecedentesFamiliares = [];
    foreach ($antecedentesFamiliares as $antecedentesFamiliar) {
        $chekboxAntecedentesFamiliares[$antecedentesFamiliar['lista_antecedentes_familiares']] = true;
    }
}

$responables = makeConsult(
    'responsables',
    [
        'responsables.nombres',
        'responsables.apellidos',
        'responsables.telefono',
        'responsables.parentezco',
    ],
    "responsables.numero_documento_paciente_FK = ?",
    [$cedulaPaciente]
)[0];


if (!(is_bool($responables) && $responables == false)) {
    $responables['isResponsable'] = true;
} else {
    $responables = [];
    $responables['isResponsable'] = false;
    $responables['nombres'] = '';
    $responables['apellidos'] = '';
    $responables['telefono'] = '';
    $responables['parentezco'] = '';
}

$municipiosDepartamentoelegido = makeConsult(
    'municipios',
    [
        'municipios.municipio',
        'municipios.codigo'
    ],
    "municipios.codigo_departamento_FK = ?",
    [$paciente['codigo_departamento']]
);


?>
<?php include '../Modules/templates/head.php'; ?>

<div class="cont-pacientes">

    <div class="pacientes">

        <div class="logo-admin vistaFConsultas">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia">
            <h1>HISTORIA CLINICA ODONTOLÓGICA</h1>
            <h3>Registro de Paciente</h3>
        </div>

        <div class="salida">
            <a href="inicio.php" id="btnGoBack">
                <p>Ir a Inicio</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>
        <form id="formPaciente">

            <h1>Datos del Paciente</h1>

            <div class="datos-paciente general-2">

                <div class="d-personales general-1">
                    <div class="nombre-p">
                        <input id="pacienteNombre" type="text" required value="<?php echo $paciente['nombres']; ?>">
                        <label>Nombre (S)*</label>
                    </div>
                    <div class="apellido-1">
                        <input id="pacienteApellido1" type="text" required value="<?php echo $paciente['apellidoUno']; ?>">
                        <label>Primer Apellido*</label>
                    </div>
                    <div class="apellido-2">
                        <input id="pacienteApellido2" type="text" value="<?php echo $paciente['apellidoDos']; ?>">
                        <label>Segundo Apellido</label>
                    </div>
                </div>

                <div class="fechas-paciente general-1">
                    <div class="fecha-n">
                        <input id="pacienteDate" type="date" required value="<?php echo $paciente['fecha_nacimiento']; ?>">
                        <label>Fecha de Nacimiento*</label>
                    </div>
                    <div class="fecha-inicio">
                        <input id="pacienteFechaInicioTrat" type="date" value="<?php echo $paciente['fecha_inicio_tratamiento']; ?>">
                        <label>Fecha de Inicio del Tratamiento</label>
                    </div>
                </div>

                <div class="documento general-1">
                    <div class="tipo-dcto">
                        <input id="pacienteTipoDoc" type="text" list="tipo-dcto" required value="<?php echo $paciente['clase_de_documento']; ?>">
                        <datalist id="tipo-dcto">
                            <?php foreach ($listadoTipoDocumentos as $tipoDocumento) { ?>
                                <option data-value="<?php echo $tipoDocumento['codigo']; ?>" value="<?php echo $tipoDocumento['clase_de_documento']; ?>">
                                <?php } ?>
                        </datalist>
                        <label>Tipo de Documento*</label>
                    </div>
                    <div class="nro-dcto">
                        <input id="pacienteNumeroDoc" type="number" pattern="[0-9]*" required value="<?php echo $paciente['numero_documento']; ?>">
                        <label>Numero de Documento*</label>
                    </div>
                    <div class="sexo">
                        <select id="pacienteSexo" required>
                            <option value="">Seleccionar...</option>
                            <option value="mujer" <?php echo $paciente['sexo'] == 'mujer' ? 'selected' : '' ?>>Mujer</option>
                            <option value="hombre" <?php echo $paciente['sexo'] == 'hombre' ? 'selected' : '' ?>>Hombre</option>
                        </select>
                        <label>Sexo</label>
                    </div>
                </div>

                <div class="edad">
                    <div class="t-usuario">
                        <input id="pacienteTipoRegimen" type="text" disabled value="<?php echo 'Particular' ?>">
                        <label>Tipo de Usuario</label>
                    </div>
                </div>
            </div>

            <h1>Residencia</h1>

            <div class="residencia">
                <div class="dptos-tel general-1">
                    <div class="dpto-1 general-2">
                        <input id="pacienteDepartamento" type="text" list="departamentos" value="<?php echo $paciente['departamento']; ?>">
                        <datalist id="departamentos">
                            <option value="">
                                <?php foreach ($listadoDepartamentos as $departamento) { ?>
                            <option data-value="<?php echo $departamento['codigo']; ?>" value="<?php echo $departamento['departamento']; ?>">
                            <?php } ?>
                        </datalist>
                        <label>Departamento*</label>
                    </div>
                    <div class="Mcpio general-2">
                        <input id="pacienteMunicipio" type="text" list="municipios" value="<?php echo $paciente['municipio']; ?>">
                        <datalist id="municipios">
                            <?php foreach ($municipiosDepartamentoelegido as $municipio) { ?>
                                <option data-value="<?php echo $municipio['codigo']; ?>" value="<?php echo $municipio['municipio']; ?>">
                            <?php } ?>
                        </datalist>
                        <label>Municipios*</label>
                    </div>
                    <div class="telefono general-2">
                        <input id="pacienteTelefono" type="tel" required value="<?php echo $paciente['telefono']; ?>">
                        <label>Teléfono</label>
                    </div>
                </div>
                <div class="dir-r general-2">
                    <input id="pacienteDireccion" type="text" required value="<?php echo $paciente['direccion_residencia']; ?>">
                    <label>Dirección de Residencia</label>
                </div>
            </div>

            <h1>Antecedentes Familiares</h1>

            <div class="datos-ips general-1 general-2">
                <div class="nombre-ips checkbox">

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF1" type="checkbox" name="antecedentes_familiares" value="1" <?php echo isset($chekboxAntecedentesFamiliares['Asma']) ? 'checked' : '' ?>>
                        <label for="antencedentesF1">Asma</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF2" type="checkbox" name="antecedentes_familiares" value="2" <?php echo isset($chekboxAntecedentesFamiliares['Hipertension Arterial']) ? 'checked' : '' ?>>
                        <label for="antencedentesF2">Hipertensión Arterial</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF3" type="checkbox" name="antecedentes_familiares" value="3" <?php echo isset($chekboxAntecedentesFamiliares['Diabetes Mellitus']) ? 'checked' : '' ?>>
                        <label for="antencedentesF3">Diabetes Mellitus</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF4" type="checkbox" name="antecedentes_familiares" value="4" <?php echo isset($chekboxAntecedentesFamiliares['Diabetes tipo 2']) ? 'checked' : '' ?>>
                        <label for="antencedentesF4">Diabetes tipo 2</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF5" type="checkbox" name="antecedentes_familiares" value="5" <?php echo isset($chekboxAntecedentesFamiliares['Enfermedad Pulmonar']) ? 'checked' : '' ?>>
                        <label for="antencedentesF5">Enfermedad Pulmonar</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF6" type="checkbox" name="antecedentes_familiares" value="6" <?php echo isset($chekboxAntecedentesFamiliares['ACV']) ? 'checked' : '' ?>>
                        <label for="antencedentesF6">ACV</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF7" type="checkbox" name="antecedentes_familiares" value="7" <?php echo isset($chekboxAntecedentesFamiliares['Cancer']) ? 'checked' : '' ?>>
                        <label for="antencedentesF7">Cancer</label>
                    </div>

                </div>
            </div>

            <div class="consulta">
                <div class="cuadro-texto cuadroTextoTamaño">
                    <textarea name="" id="antecedentesOtros" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required><?php echo $paciente['otrosAntecedentesFamiliares']; ?></textarea>
                    <label for="">Otros...</label>
                </div>
            </div>

            <div class="tiene">
                <h1>Persona Responsable</h1>

                <div class="tiene-si">
                    <input id="pacienteResponsableSI" name="p_responsable" value="SI" type="radio" <?php echo $responables['isResponsable'] ? 'checked' : '' ?>>
                    <label for="pacienteResponsableSI">SI</label>
                </div>
                <div class="tiene-si">
                    <input id="pacienteResponsableNO" name="p_responsable" value="NO" type="radio" <?php echo !$responables['isResponsable'] ? 'checked' : '' ?>>
                    <label for="pacienteResponsableNO">NO</label>
                </div>
            </div>

            <div class="p-resp general-1">
                <div class="nombre-r general-2">
                    <input id="responsableNombre" type="text" value="<?php echo $responables['nombres']; ?>">
                    <label>Nombre (S)*</label>
                </div>

                <div class="apellido-r general-2">
                    <input id="responsableApellido" type="text" value="<?php echo $responables['apellidos']; ?>">
                    <label>Apellido (S)*</label>
                </div>

                <div class="telefono general-2">
                    <input id="responsableTelefono" type="tel" value="<?php echo $responables['telefono']; ?>">
                    <label>Teléfono</label>
                </div>

                <div class="parentezco general-2">
                    <input id="responsableParentezco" type="text" list="parentezco" value="<?php echo $responables['parentezco']; ?>">
                    <datalist id="parentezco">
                        <option value="Padre">
                        <option value="Madre">
                        <option value="Hermano/a">
                        <option value="Otro, cual?">
                    </datalist>
                    <label>Parentezco*</label>
                </div>
            </div>


            <div class="botones">
                <div class="boton">
                    <button class="fin" id="btnGuardarSalir">
                        <p>Actualizar</p>
                    </button>
                </div>
            </div>



        </form>
    </div>



</div>


<script src="../JS/pacientes/actualizadoPaciente.js"></script>
<script>
    const btnGoBack = document.querySelector('#btnGoBack');

    btnGoBack.addEventListener('click', (event) => {
        event.preventDefault();
        window.history.back();
    })
</script>


<?php include '../Modules/templates/footer.php'; ?>