
    $(document).ready( ()=> {

    //*variables de los textarea -tabla consultaMSQL (html)
    const fechaConsulta = $('#fechaConsulta')
    const motivoConsulta = $('#motivoConsulta')
    const evolucionEstadoActual = $('#evolucionEstadoActual')
    const antecedentesOdontologicos = $('#antecedentesOdontologicos')
    const examenEstomatologico = $('#examenEstomatologico')
    const documentoPacienteTrabajar = $('#pacienteTrabajar') //*no se ve, esta oculto para realizar el guardar y continuar

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

    //*variable boton de guardado y continuar (Zoraida)
    const btnGuardarContinuarConsulta1 = $('#btnGuardarContinuarConsulta1')

    //* variable formulario de guardado para consulta-1 (face1) (Manuel)
    const formConsulta1 = $('#formConsulta1')

    //*eventos
    formConsulta1.submit((event) => { 
        event.preventDefault()
        
        const datos = leerDatosFormularioConsultas1()
        const data = new FormData()

        //?traducir captada informacion a JSON
        data.append('informacionFormConsulta1', JSON.stringify(datos))
        data.append('tipoPeticion', 'consulta1')

        const ajax = new XMLHttpRequest()
        ajax.open('post', '../Modules/models/consultas/guardado1.php', true)
        ajax.send(data)
        ajax.onload = () => {
            if (ajax.status == 200) {
                let respuesta = JSON.parse(ajax.responseText)
                console.log(respuesta);
                if (respuesta.proceso === 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Exitoso!',
                        text: `La primera parte de la consulta ha sido registrada  \n(Preciona enter para continuar)`
                    }).then(() => {
                        window.location.href = 'consultas2.php?cedulaPaciente='+documentoPacienteTrabajar.val()+'&idConsulta='+respuesta.consultaID
                    })
                    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Opsss',
                        text: 'Ha ocurrido un error, intenta nuevamente',
                    })
                }
                
            }
        }
    })

    

    //*funciones
    const leerDatosFormularioConsultas1 = () => {

        const infoFormularioConsultas1 = {
            fechaConsulta: fechaConsulta.val(),
            motivoConsulta: motivoConsulta.val(),
            evolucionEstadoActual: evolucionEstadoActual.val(),
            antecedentesOdontologicos: antecedentesOdontologicos.val(),
            examenEstomatologico: examenEstomatologico.val(),
            pacienteTrabajar: documentoPacienteTrabajar.val(),

            articulacionTemporoMandibular: {
                ruidos: verificarRadioButtonTemporo(ruidosSI,ruidosNO),
                desviacion: verificarRadioButtonTemporo(desviacionSI,desviacionNO),
                cambioVolumen: verificarRadioButtonTemporo(cambioVolumenSI, cambioVolumenNO),
                bloqueoMandibular: verificarRadioButtonTemporo(bloqueoMandibularSI,bloqueoMandibularNO),
                limitacionApertura: verificarRadioButtonTemporo(limitacionAperturaSI,limitacionAperturaNO),
                dolorArticular: verificarRadioButtonTemporo(dolorArticularSI,dolorArticularNO),
                dolorMuscular: verificarRadioButtonTemporo(dolorMuscularSI,dolorMuscularNO)
            }
        } 

        console.log(infoFormularioConsultas1)

        return infoFormularioConsultas1
    }

    const asignarFecha = () => {
        let fecha = new Date()
        let dia = fecha.getDate()
        let mes = fecha.getMonth() + 1
        let anio = fecha.getFullYear()

        if (mes < 10) {
            mes = '0' + mes
        }
            
        if (dia < 10) {
            dia = '0' + dia
        }
        
        let fechaActual = anio + '-' + mes + '-' + dia
        fechaConsulta.val(fechaActual)
    }

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

    //* funciones iniciadoras
    asignarFecha()
    
});