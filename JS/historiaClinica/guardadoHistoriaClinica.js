$(document).ready(() => {

    //* variables globales
    const formHistoria = $('#formHistoria')

    //* eventos
    formHistoria.submit((event) => {
        event.preventDefault();

        //* inputs form historia -
        const antecedentesOdontologicos = $("#antecedentesOdontologicos").val()
        const protesisSi = $("#protesisSi").prop('checked') ? 'si' : 'no'
        const protesisTipo = $("#protesisTipo").val()
        const protesisDescripcion = $("#protesisDescripcion").val()
        const igieneOralSi = $("#igieneOralSi").prop('checked') ? 'si' : 'no'
        const frecuenciaCepilladoSi = $("#frecuenciaCepilladoSi").prop('checked') ? 'si' : 'no'
        const gradoRiesgoSi = $("#gradoRiesgoSi").prop('checked') ? 'si' : 'no'
        const sedaDentalSi = $("#sedaDentalSi").prop('checked') ? 'si' : 'no'
        const pigmentacionSi = $("#pigmentacionSi").prop('checked') ? 'si' : 'no'
        const pacienteTrabajar = $("#pacienteTrabajar").val()
        const pacienteNuevo = $("#pacienteNuevo").val()

        //* inputs datalist -
        const articular = capturarDataValue($("#datalistArticular").val(), 'articular')
        const pulpar = capturarDataValue($("#datalistPulpar").val(), 'articular')
        const periodontal = capturarDataValue($("#datalistPeriodontal").val(), 'articular')
        const dental = capturarDataValue($("#datalistDental").val(), 'articular')
        const cd = capturarDataValue($("#datalistCD").val(), 'articular')
        const tejidosBlandos = capturarDataValue($("#datalistTejidosBlandos").val(), 'articular')
        const otros = capturarDataValue($("#datalistOtros").val(), 'articular')

        //*variables tabla articulacion temporo mandibular 
        const ruidosSI = $('#ruidosSI')
        const ruidosNO = $('#ruidosNO')
        const desviacionSI = $('#desviacionSI')
        const desviacionNO = $('#desviacionNO')
        const cambioVolumenSI = $('#cambioVolumenSI')
        const cambioVolumenNO = $('#cambioVolumenNO')
        const bloqueoMandibularSI = $('#bloqueoMandibularSI')
        const bloqueoMandibularNO = $('#bloqueoMandibularNO')
        const limitacionAperturaSI = $('#limitacionAperturaSI')
        const limitacionAperturaNO = $('#limitacionAperturaNO')
        const dolorArticularSI = $('#dolorArticularSI')
        const dolorArticularNO = $('#dolorArticularNO')
        const dolorMuscularSI = $('#dolorMuscularSI')
        const dolorMuscularNO = $('#dolorMuscularNO')

        const informacionHistoria = {
            articulacionTemporoMandibular: {
                ruidos: verificarRadioButtonTemporo(ruidosSI, ruidosNO),
                desviacion: verificarRadioButtonTemporo(desviacionSI, desviacionNO),
                cambioVolumen: verificarRadioButtonTemporo(cambioVolumenSI, cambioVolumenNO),
                bloqueoMandibular: verificarRadioButtonTemporo(bloqueoMandibularSI, bloqueoMandibularNO),
                limitacionApertura: verificarRadioButtonTemporo(limitacionAperturaSI, limitacionAperturaNO),
                dolorArticular: verificarRadioButtonTemporo(dolorArticularSI, dolorArticularNO),
                dolorMuscular: verificarRadioButtonTemporo(dolorMuscularSI, dolorMuscularNO)
            }, 
            historiaInfo: {
                antecedentesOdontologicos,
                protesisSi,
                protesisTipo,
                protesisDescripcion,
                igieneOralSi,
                frecuenciaCepilladoSi,
                gradoRiesgoSi,
                sedaDentalSi,
                pigmentacionSi,
                articular,
                pulpar,
                periodontal,
                dental,
                cd,
                tejidosBlandos,
                otros
            },
            pacienteTrabajar
        }
        
        
        const datos = new FormData()
        datos.append('informacionHistoria', JSON.stringify(informacionHistoria))

        //* proceso de ajax
        const xhr = new XMLHttpRequest()

        xhr.open('POST', '../Modules/models/historiaClinica/guardado.php', true)
        xhr.send(datos)

        xhr.onload = () => {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const response = JSON.parse(xhr.responseText)

                if (response.process == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Guardado',
                        text: 'Historia clinica registrada y/o actualizada',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        if (pacienteNuevo) {
                            window.location.href = `consulta.php?cedulaPaciente=${pacienteTrabajar}`
                        }else{
                            window.location.href = 'misPacientes.php'
                        }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al guardar odontograma',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        }
    })

    //* retorna el dataValue en un datalist. textobuscar: valor del input, datalist: datalist del cual se desea hacer busqueda
    function capturarDataValue(textoBuscar, datalist) {
        const optionDatalist = Array.from(document.querySelectorAll(`#${datalist} option`));
        const optionEncontrado = optionDatalist.find(option => option.value === textoBuscar);

        if (optionEncontrado) {
            return optionEncontrado.getAttribute('data-value');
        } else {
            return null;
        }
    }


    //* verifica si el radio button esta seleccionado
    const verificarRadioButtonTemporo = (checkedSI, checkedNO) => {

        let respuesta
        if (checkedSI.prop('checked')) {
            respuesta = 'SI'
        }
        if (checkedNO.prop('checked')) {
            respuesta = 'NO'
        }

        return respuesta

    }
})