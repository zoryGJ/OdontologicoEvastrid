<?php
include_once '../Modules/functions/sessions.php';
include_once '../Modules/functions/consultasGenerales.php';

if (!controllSession()) {
    header('Location: http://localhost/Evastrid/views/login.php');
}

//* consultas
$listadoDepartamentos = consultaDepartamentos();
$listadoIPS = consultaIPS();
$listadoTipoDocumentos = consultaTipoDocumentos();
$listadoTipoRegimen = consultaTipoRegimen();

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
            <a href="inicio.php">
                <p>Ir a Inicio</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>
        <form id="formPaciente">

            <h1>Datos de la IPS</h1>

            <div class="datos-ips general-1 general-2">

                <div class="nombre-ips">
                    <input id="nombreIPS" type="text" list="nombre_de_ips" placeholder="Seleccionar..." required>
                    <datalist id="nombre_de_ips">
                        <?php foreach ($listadoIPS as $ips) { ?>
                            <option data-value="<?php echo $ips['codigo']; ?>" value="<?php echo $ips['nombre_ips']; ?>">
                        <?php } ?>
                    </datalist>
                    <label for="">Nombre de la IPS</label>
                </div>

                <div class="sucursal-ips">
                    <input id="sucursalIPS" type="text" list="sucursal-ips" placeholder="Seleccionar..." required>
                    <label for="">Sucursal</label>
                </div>

            </div>

            <h1>Datos del Paciente</h1>

            <div class="datos-paciente general-2">

                <div class="d-personales general-1">
                    <div class="nombre-p">
                        <input id="pacienteNombre" type="text" required>
                        <label>Nombre (S)*</label>
                    </div>
                    <div class="apellido-1">
                        <input id="pacienteApellido1" type="text" required>
                        <label>Primer Apellido*</label>
                    </div>
                    <div class="apellido-2">
                        <input id="pacienteApellido2" type="text">
                        <label>Segundo Apellido</label>
                    </div>
                </div>

                <div class="fechas-paciente general-1">
                    <div class="fecha-n">
                        <input id="pacienteDate" type="date" required>
                        <label>Fecha de Nacimiento*</label>
                    </div>
                    <div class="fecha-inicio">
                        <input id="pacienteFechaInicioTrat" type="date">
                        <label>Fecha de Inicio del Tratamiento</label>
                    </div>
                </div>

                <div class="documento general-1">
                    <div class="tipo-dcto">
                        <input id="pacienteTipoDoc" type="text" list="tipo-dcto" required>
                        <datalist id="tipo-dcto">
                            <?php foreach ($listadoTipoDocumentos as $tipoDocumento) { ?>
                                <option data-value="<?php echo $tipoDocumento['codigo']; ?>" value="<?php echo $tipoDocumento['clase_de_documento']; ?>">
                            <?php } ?>
                        </datalist>
                        <label>Tipo de Documento*</label>
                    </div>
                    <div class="nro-dcto">
                        <input id="pacienteNumeroDoc" type="number" pattern="[0-9]*" required>
                        <label>Numero de Documento*</label>
                    </div>
                    <div class="sexo">
                        <select id="pacienteSexo" required>
                            <option value="">Seleccionar...</option>
                            <option value="mujer">Mujer</option>
                            <option value="hombre">Hombre</option>
                            <option value="rarito">Helicoptero apache t-24 con turbo compresor</option>
                        </select>
                        <label>Sexo</label>
                    </div>
                </div>

                <div class="edad">
                    <div class="años">
                        <input type="number">
                        <label>Edad</label> 
                        <!-- colocar edad en automatico -->
                    </div>
                    <div class="t-usuario">
                        <input id="pacienteTipoRegimen" type="text" list="t-usuario" placeholder="Seleccionar..." required>
                        <datalist id="t-usuario">
                            <?php foreach ($listadoTipoRegimen as $regimen) { ?>
                                <option data-value="<?php echo $regimen['codigo']; ?>" value="<?php echo $regimen['clase_de_usuario']; ?>">
                            <?php } ?>
                        </datalist>
                        <label>Tipo de Usuario</label>
                    </div>


                </div>

            </div>

            <h1>Residencia</h1>

            <div class="residencia">
                <div class="dptos-tel general-1">
                    <div class="dpto-1 general-2">
                        <input id="pacienteDepartamento" type="text" list="departamentos">
                        <datalist id="departamentos">
                            <option value="">
                            <?php foreach ($listadoDepartamentos as $departamento) { ?>
                            <option data-value="<?php echo $departamento['codigo']; ?>" value="<?php echo $departamento['departamento']; ?>">
                            <?php } ?>
                        </datalist>
                        <label>Departamento*</label>
                    </div>
                    <div class="Mcpio general-2">
                        <input id="pacienteMunicipio" type="text" list="municipios">
                        <datalist id="municipios">

                        </datalist>
                        <label>Municipios*</label>
                    </div>
                    <div class="telefono general-2">
                        <input id="pacienteTelefono" type="tel" required>
                        <label>Teléfono</label>
                    </div>
                </div>
                <div class="dir-r general-2">
                    <input id="pacienteDireccion" type="text" required>
                    <label>Dirección de Residencia</label>
                </div>
            </div>

            <h1>Antecedentes Familiares</h1>

            <div class="datos-ips general-1 general-2">
                <div class="nombre-ips checkbox">

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF1" type="checkbox" name="antecedentes_familiares" value="1">
                        <label for="antencedentesF1">Asma</label>
                    </div>
                    
                    <div class="checkboxOrganizado">
                        <input id="antencedentesF2" type="checkbox" name="antecedentes_familiares" value="2">
                        <label for="antencedentesF2">Hipertensión Arterial</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF3" type="checkbox" name="antecedentes_familiares" value="3">
                        <label for="antencedentesF3">Diabetes Mellitus</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF4" type="checkbox" name="antecedentes_familiares" value="4">
                        <label for="antencedentesF4">Diabetes tipo 2</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF5" type="checkbox" name="antecedentes_familiares" value="5">
                        <label for="antencedentesF5">Enfermedad Pulmonar</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF6" type="checkbox" name="antecedentes_familiares" value="6">
                        <label for="antencedentesF6">ACV</label>
                    </div>

                    <div class="checkboxOrganizado">
                        <input id="antencedentesF7" type="checkbox" name="antecedentes_familiares" value="7">
                        <label for="antencedentesF7">Cancer</label>
                    </div>
                    
                </div>
            </div>

            <div class="consulta">
                <div class="cuadro-texto cuadroTextoTamaño">
                    <textarea name="" id="antecedentesOtros" cols="30" rows="10" placeholder="Redactar la informacion en el cuadro de texto." required></textarea>
                    <label for="">Otros...</label>
                </div>
            </div>

            <div class="tiene">
                <h1>Persona Responsable</h1>

                <div class="tiene-si">
                    <input id="pacienteResponsableSI" name="p_responsable" value="SI" type="radio">
                    <label for="pacienteResponsableSI">SI</label>
                </div>
                <div class="tiene-si">
                    <input id="pacienteResponsableNO" name="p_responsable" value="NO" type="radio">
                    <label for="pacienteResponsableNO">NO</label>
                </div>
            </div>

            <div class="p-resp general-1">
                <div class="nombre-r general-2">
                    <input id="responsableNombre" type="text">
                    <label>Nombre (S)*</label>
                </div>

                <div class="apellido-r general-2">
                    <input id="responsableApellido" type="text">
                    <label>Apellido (S)*</label>
                </div>

                <div class="telefono general-2">
                    <input id="responsableTelefono" type="tel">
                    <label>Teléfono</label>
                </div>

                <div class="parentezco general-2">
                    <input id="responsableParentezco" type="text" list="parentezco">
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
                        <p>Guardar & Salir</p>
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>

                <div class="boton">
                    <button class="fin" id="btnGuardarContinuar">
                        <p>Continuar consulta</p>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </div>
            </div>



        </form>
    </div>



</div>


<script src="../JS/pacientes/guardadoPaciente.js"></script>



<?php include '../Modules/templates/footer.php'; ?>