<?php
include_once '../Modules/functions/sessions.php';

if (!controllSession()) {
    header('Location: http://localhost/Evastrid/views/login.php');
}
?>

<?php include '../Modules/templates/head.php'; ?>

<?php

include '../Modules/functions/bdconection.php';

//*consultando convenciones Generales
$sql = "SELECT * FROM  convenciones";
$stmt = $connect->prepare($sql);
$stmt->execute();
$convencionesDesordenadas = $stmt->get_result();
$convencionesOrdenadas = $convencionesDesordenadas->fetch_all(MYSQLI_ASSOC);

//*consultando convenciones Obturado y Cariado OC

$sqlOC = "SELECT * FROM convenciones_oc";
$stmtOC = $connect->prepare($sqlOC);
$stmtOC->execute();
$convencionesSeccionDesordenadas = $stmtOC->get_result();
$convencionesSeccionOrdenadas = $convencionesSeccionDesordenadas->fetch_all(MYSQLI_ASSOC);


?>


<link rel="stylesheet" href="../css/ondotogramaManuel.css">
<div class="cont-pacientes">

    <div class="pacientes">

        <div class="logo-admin">
            <img src="../Img/Logo2.jpg" alt="">
        </div>

        <div class="titulo-historia">
            <h1>HISTORIA CLINICA ODONTOLÓGICA</h1>
            <h3>Consulta Odontológica: <br> Odontógrama & Diagnóstico</h3>
        </div>

        <div class="salida">
            <a href="inicio.php">
                <p>Ir a Inicio</p>
                <i class="fa-solid fa-person-walking-arrow-right"></i>
            </a>
        </div>

        <form action="">

            <div class="only-odontograma">
                <h1 class="h1centrar g-odontograma">Odontógrama</h1>

                <div class="g-evolucion">
                    <button class="nueva evolucion g-odontograma" title="Gestionar nueva evolución" id="gestionarOdontograma">
                        <i class="fa-solid fa-teeth"></i>
                        <h3>Gestiona tu Odontograma</h3>
                    </button>
                </div>

                <div class="g-evolucion hiddenEvolucion">
                    <button class="nueva evolucion" title="Gestionar nueva evolución">
                        <i class="fa-solid fa-plus"></i>
                        <h3>Gestionar Evolución</h3>
                    </button>
                </div>
            </div>



            <h1 class="t-protesis">Prótesis</h1>

            <div class="protesis">

                <div class="p1">
                    <p>Presencia de Prótesis</p>

                    <div>

                        <div class="input-p">
                            <input name="protesis" value="SI" type="radio">
                            <label>SI</label>
                        </div>

                        <div class="input-p">
                            <input name="protesis" value="NO" type="radio">
                            <label>NO</label>
                        </div>

                    </div>
                </div>

                <div class="ok">
                    <div class="p2">
                        <textarea placeholder="Escribe aquí"></textarea>
                        <label>Tipo</label>
                    </div>

                    <div class="p2">
                        <textarea placeholder="Escribe aquí"></textarea>
                        <label>Descripción</label>
                    </div>
                </div>

            </div>

            <h1>Higiene Oral</h1>

            <div class="higiene">

                <div>
                    <p>Higiene Oral</p>

                    <div>
                        <input name="higiene" value="SI" type="radio">
                        <label>SI</label>
                    </div>

                    <div>
                        <input name="higiene" value="NO" type="radio">
                        <label>NO</label>
                    </div>

                </div>

                <div>
                    <p>Frecuencia de Cepillado</p>

                    <div>
                        <input name="frecuencia" value="SI" type="radio">
                        <label>SI</label>
                    </div>

                    <div>
                        <input name="frecuencia" value="NO" type="radio">
                        <label>NO</label>
                    </div>

                </div>

                <div>
                    <p>Grado de Riesgo</p>

                    <div>
                        <input name="riesgo" value="SI" type="radio">
                        <label>SI</label>
                    </div>

                    <div>
                        <input name="riesgo" value="NO" type="radio">
                        <label>NO</label>
                    </div>

                </div>

                <div>
                    <p>Seda Dental</p>

                    <div>
                        <input name="seda" value="SI" type="radio">
                        <label>SI</label>
                    </div>

                    <div>
                        <input name="seda" value="NO" type="radio">
                        <label>NO</label>
                    </div>

                </div>

                <div>
                    <p>Pigmentaciones</p>

                    <div>
                        <input name="pigmento" value="SI" type="radio">
                        <label>SI</label>
                    </div>

                    <div>
                        <input name="pigmento" value="NO" type="radio">
                        <label>NO</label>
                    </div>

                </div>

            </div>

            <div class="tablas t1">

                <h3>Diagnósticos</h3>

                <div class="articulacion">

                    <div class="head_art he_1">
                        <h3 class="h-d">Diagnóstico</h3>
                        <h3>Código CIES & Concepto</h3>
                    </div>

                    <div class="body_art ba_1">
                        <label>Articular</label>
                        <input type="text" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Pulpar</label>
                        <input type="text" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Periodontal</label>
                        <input type="text" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Dental</label>
                        <input type="text" list="articular" placeholder="Seleccionar...">

                    </div>

                    <div class="body_art ba_1">
                        <label>C y D</label>
                        <input type="text" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1">
                        <label>Tejidos Blandos</label>
                        <input type="text" list="articular" placeholder="Seleccionar...">
                    </div>

                    <div class="body_art ba_1 bottom_no">
                        <label>Otros</label>
                        <input type="text" list="articular" placeholder="Escribir...">
                    </div>

                    <datalist id="articular">
                        <option value="A690 - ESTOMATITIS ULCERATIVA NECROTIZANTE">
                        <option value="K005 - ALTERACIONES HEREDITARIAS DE LA ESTRUCTURA DENTARIA, NO CLASIFICADAS EN OTRA PARTE">
                        <option value="A690 - ESTOMATITIS ULCERATIVA NECROTIZANTE">
                    </datalist>
                </div>
            </div>

            <div class="consulta">
                <!-- Style Consentimiento informado -->
                <div class="cuadro-texto consentimiento">
                    <h3>Consentimiento Informado</h3>
                    <p>
                        Por medio de la presente constancia, en pleno uso de mis facultades mentales, otorgo en forma libre de mi consentimiento al Doctor(a) <span>EVASTRID PARDO</span> para que por su intermedio en ejercicio legal de su profesión, asi como de los demás profesionales de la salud que se requieran, y con el concurso del personal auxiliar de servicios asistenciales de la entidad, se me practique los procedimientos por mi el costo por los tratamientos que se encuentran excluidos del Plan Obligatorio de Salud-POS.
                    </p>
                </div>

            </div>

            <!-- Style fecha y firma: se emulan las clases del registro del paciente -->

            <div class="datos-paciente general-2">

                <div class="documento general-1">
                    <div class="nro-dcto">
                        <input type="text">
                        <label>Firma del Odontólogo*</label>
                    </div>
                    <div class="sexo">
                        <input type="text">
                        <label>Firma del Paciente</label>
                    </div>
                </div>

            </div>

            <div class="botones">

                <div class="boton">
                    <button class="fin">
                        <p>Guardar & Finalizar</p>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </div>
 
                <div class="pdf">
                    <i class="fa-regular fa-file-pdf"></i>
                    <button>
                        <h5>Generar PDF</h5>
                        <i class="fa-solid fa-download"></i>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>


<div class="overlayOdontograma" id="overlay">
    <div class="odontogramaModal" id="odontogramaModal">
        <div class="encabezadoModal">
            <h1>Odontograma</h1>
            <button id="btnCloseModal">
                x
            </button>
        </div>
        <form action="">
            <div class="odontogramaM">
                <div class="cuadrante">
                    <div class="seccionSuperior inv">
                        <div class="diente" id="diente-11">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>11</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-12">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>12</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-13">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>13</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-14">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>14</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-15">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>15</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-16">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>16</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-17">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>17</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-18">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>18</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="seccionInferior inv">
                        <div class="diente" id="diente-51">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>51</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-52">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>52</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-53">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>53</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-54">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>54</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>55</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cuadrante">
                    <div class="seccionSuperior">
                        <div class="diente" id="diente-21">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>21</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-22">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>22</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-23">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>23</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-24">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>24</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-25">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>25</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-26">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>26</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-27">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>27</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-28">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>28</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="seccionInferior">
                        <div class="diente" id="diente-61">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>61</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-62">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>62</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-63">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>63</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-64">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>64</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-65">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>65</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cuadrante">
                    <div class="seccionSuperior inv">
                        <div class="diente" id="diente-81">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>81</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-82">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>82</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-83">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>83</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-84">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>84</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-85">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>85</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="seccionInferior inv">
                        <div class="diente" id="diente-41">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>41</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-42">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>42</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-43">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>43</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-44">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>44</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-45">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>45</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-46">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>46</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-47">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>47</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-48">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>48</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cuadrante">
                    <div class="seccionSuperior">
                        <div class="diente" id="diente-71">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>71</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-72">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>72</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-73">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>73</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-74">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>74</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-75">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>75</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="seccionInferior">
                        <div class="diente" id="diente-31">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>31</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-32">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>32</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-33">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>33</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-34">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>34</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-35">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>35</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-36">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>36</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-37">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>37</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                        <div class="diente" id="diente-38">
                            <button class="sectionDiente top v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente left h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente center v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente right h">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="sectionDiente bot v">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="general" title="Diente General">
                                <i class="fa-solid fa-tooth"></i>
                                <p>38</p>
                            </button>
                            <div class="imgOperacionGeneral">
                                <img src="../Img/convenciones/P_m_E.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="overlayConvencionesGeneral" id="overlayConvencionGeneral">
    <div class="convencionesGeneralModal" id="modalConvencionGeneral">
        <div class="title">
            <h2>Convencion general de diente</h2> 

            <button typeConvencion="cerrar" id="btnCloseModalConvencionGeneral">
                x
            </button>
        </div>
        <div class="convenciones general">

            <?php foreach ($convencionesOrdenadas as $numerosLlaves => $posicionesConvencion) { ?>

                <button typeConvencion="proceso" data-name-img='<?php echo $posicionesConvencion['figura']; ?>' data-name-process="<?php echo $posicionesConvencion['convencion']; ?>">
                    <div class="text">
                        <h3><?php echo $posicionesConvencion['convencion']; ?></h3>
                    </div>
                    <div class="image">
                        <img src="../Img/convenciones/<?php echo $posicionesConvencion['figura']; ?>" alt="">
                    </div>
                    <div class="color">
                        <p><?php echo $posicionesConvencion['color']; ?></p>
                    </div>
                </button>

            <?php } ?>

            <button typeConvencion="limpiar">
                <div class="text limpiar">
                    <h3>Limpiar</h3>
                </div>
            </button>

        </div>
    </div>
</div>

<div class="overlayConvencionesSeccionDiente" id="overlayConvencionSeccion">
    <div class="convencionesSeccionDiente" id="modalConvencionSeccion">
        <div class="title">
            <h2>Convenciones seccion diente</h2>

            <button id="btnCloseModalConvencionSeccion">
                x
            </button>
        </div>
        <div class="convenciones seccion">

            <?php $contConv = 1; ?>
            <?php foreach ($convencionesSeccionOrdenadas as $numKey => $posicionesSeccion) { ?>


                <button typeConvencion="conv<?php echo $contConv; ?>">
                    <div class="text">
                        <h3><?php echo $posicionesSeccion['convencion']; ?></h3>
                    </div>
                    <div class="image">
                        <i class="fa-solid fa-square"></i>
                    </div>
                </button>

                <?php $contConv++; ?>

            <?php } ?>

            <button typeConvencion="limpiar">
                <div class="text">
                    <h3>Limpiar</h3>
                </div>
            </button>
        </div>
    </div>
</div>


<script src="../JS/modalOdontograma.js"></script>

<?php include '../Modules/templates/footer.php'; ?>