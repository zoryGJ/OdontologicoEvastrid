$(document).ready(() => {
    
    //* variables globales (html)
    const nombre_de_ips = $('#nombreIPS')
    const sucursalIPS = $('#sucursalIPS')
    const pacienteNombre = $('#pacienteNombre')
    const pacienteApellido1 = $('#pacienteApellido1')
    const pacienteApellido2 = $('#pacienteApellido2')
    const pacienteDate = $('#pacienteDate')
    const pacienteFechaInicioTrat = $('#pacienteFechaInicioTrat')
    const pacienteTipoDoc = $('#pacienteTipoDoc')
    const pacienteNumeroDoc = $('#pacienteNumeroDoc')
    const pacienteSexo = $('#pacienteSexo')
    const pacienteTipoRegimen = $('#pacienteTipoRegimen')
    const pacienteTelefono = $('#pacienteTelefono')
    const pacienteDireccion = $('#pacienteDireccion')
    const asma = $('#antencedentesF1')
    const hipertersion = $('#antencedentesF2')
    const diabetesMellitus = $('#antencedentesF3')
    const diabetesTipoDos = $('#antencedentesF4')
    const enfermedadPulmonar = $('#antencedentesF5')
    const ACV = $('#antencedentesF6')
    const cancer = $('#antencedentesF7')
    const otrosAntecedentes = $('#antecedentesOtros')
    

    const pacienteResponsableSI = $('#pacienteResponsableSI')
    const pacienteResponsableNO = $('#pacienteResponsableNO')

    const pacienteDepartamento = $('#pacienteDepartamento')
    const pacienteDepartamentoDatalist = $('#departamentos')
    const pacienteMunicipio = $('#pacienteMunicipio')
    const pacienteMunicipioDatalist = $('#municipios')

    //* variables seccion responable
    const responsableNombre = $('#responsableNombre')
    const responsableApellido = $('#responsableApellido')
    const responsableTelefono = $('#responsableTelefono')
    const responsableParentezco = $('#responsableParentezco')

    //* botones submit form
    const btnGuardarSalir = $('#btnGuardarSalir')
    const btnGuardarContinuar = $('#btnGuardarContinuar')

    //* eventos
    pacienteResponsableSI.click((event) => {
        responsableNombre.attr('disabled', false)
        responsableApellido.attr('disabled', false)
        responsableTelefono.attr('disabled', false)
        responsableParentezco.attr('disabled', false)
    })

    pacienteResponsableNO.click((event) => {
        responsableNombre.attr('disabled', true)
        responsableApellido.attr('disabled', true)
        responsableTelefono.attr('disabled', true)
        responsableParentezco.attr('disabled', true)

        responsableNombre.val('')
        responsableApellido.val('')
        responsableTelefono.val('')
        responsableParentezco.val('') 
    })

    pacienteDepartamento.blur((event) => {
        const departamentoNombre = encodeURIComponent(event.target.value)
        const url = '../Modules/models/pacientes/guardado1.php?tipoPeticion=consultarDepartamento&nombreDepartamento='+departamentoNombre

        pacienteMunicipioDatalist.empty()
        
        if (departamentoNombre.trim() === '') {
            return false
        }

        const ajax = new XMLHttpRequest()
        ajax.open('GET', url, true)
        ajax.send()
        ajax.onload = () => {
            if (ajax.status === 200) {
                console.log(ajax.responseText);
                const listadoMunicipios = JSON.parse(ajax.responseText)

                listadoMunicipios.forEach(({codigo: municipioID, municipio: municipioNombre}) => {
                    let optionDatalist = document.createElement('option')// <option></option>
                    optionDatalist.value = municipioNombre
                    optionDatalist.setAttribute('data-value', municipioID)
                    pacienteMunicipioDatalist.append(optionDatalist)
                });
            }
        }
    })


    btnGuardarSalir.click((event) => {
        event.preventDefault()
        const datos = leerDatosFormulario()
        const data = new FormData()
        data.append('informacionFormRegistroPaciente', JSON.stringify(datos)) //*stringify traduce js a json
        data.append('tipoPeticion', 'crearPaciente') //* asi controlo que en php se meta en el condicional que corresponde a la vista correcta en ese caso registroPaciente

        const ajax = new XMLHttpRequest()
        ajax.open('post', '../Modules/models/pacientes/guardado1.php', true)
        ajax.send(data)
        ajax.onload = () => {
            if (ajax.status == 200) {
                console.log(ajax.responseText);
                let respuesta = JSON.parse(ajax.responseText)
                console.log(respuesta)

                if (respuesta.proceso == 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Exitoso',
                        text: 'Paciente Creado',
                    }).then(function (click) {
                        window.location.href = "inicio.php"
                    })
                }else{
                    if (respuesta.proceso == 'incorrecto') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lo sentimos...',
                            text: 'Ha ocurrido un error, intentalo nuevamente',
                        })
                    }else{
                        if (respuesta.proceso == 'PacienteExistente') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lo sentimos...',
                                text: 'Este Paciente ya se encuentra registrado',
                            })
                        }
                        
                    }
                }
            }
        }
    })

    btnGuardarContinuar.click((event) => {
        event.preventDefault()
        const datos = leerDatosFormulario()
        const data = new FormData()
        data.append('informacionFormRegistroPaciente', JSON.stringify(datos)) //*stringify traduce js a json
        data.append('tipoPeticion', 'crearPaciente') //* asi controlo que en php se meta en el condicional que corresponde a la vista correcta en ese caso registroPaciente

        const ajax = new XMLHttpRequest()
        ajax.open('post', '../Modules/models/pacientes/guardado1.php', true)
        ajax.send(data)
        ajax.onload = () => {
            if (ajax.status == 200) {
                console.log(ajax.responseText);
                let respuesta = JSON.parse(ajax.responseText)
                console.log(respuesta)

                if (respuesta.proceso == 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Exitoso',
                        text: 'Paciente Creado',
                    }).then(function (click) {
                        window.location.href = "f_consultas.php?cedulaPaciente="+pacienteNumeroDoc.val()
                    })
                }else{
                    if (respuesta.proceso == 'incorrecto') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lo sentimos...',
                            text: 'Ha ocurrido un error, intentalo nuevamente',
                        })
                    }else{
                        if (respuesta.proceso == 'PacienteExistente') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lo sentimos...',
                                text: 'Este Paciente ya se encuentra registrado',
                            })
                        }
                        
                    }
                }
            }
        }
    })

    //*Funciones
    //id= tipo-dcto, 
    const buscardatalist = (idDatalist, valorBuscado) => {

        const datalist = document.getElementById(idDatalist)
        const options = Array.from(datalist.options)

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            if (valorBuscado.trim() === option.getAttribute('value').trim()) { 
                return option.getAttribute('data-value')
            }
        }

        return 'no found'
    }

    const verificacionCheked = (variableId) => {

        if (variableId.prop('checked')) {
           return variableId.val()
        }else{
            return ''
        }
    }


    const leerDatosFormulario = () => {
        const infoFormulario = {
            nombreIps:  buscardatalist('nombre_de_ips', nombre_de_ips.val()),
            sucursalIps: sucursalIPS.val(),
            nombre: pacienteNombre.val(),
            apellido1: pacienteApellido1.val(),
            apellido2: pacienteApellido2.val(),
            fechaNacicimiento: pacienteDate.val(),
            fehcaInicio: pacienteFechaInicioTrat.val(),
            tipoDocumento: buscardatalist('tipo-dcto', pacienteTipoDoc.val()),
            numeroDocumento: pacienteNumeroDoc.val(),
            sexo: pacienteSexo.val(),
            tipoRegimen: buscardatalist('t-usuario', pacienteTipoRegimen.val()),
            municipio: buscardatalist('municipios', pacienteMunicipio.val()) ,
            telefono: pacienteTelefono.val(),
            pacienteDireccion: pacienteDireccion.val(),
            personaResponsable: false,
            asma: verificacionCheked(asma),//1
            hipertension: verificacionCheked(hipertersion),//2
            diabetesMellitus: verificacionCheked(diabetesMellitus), //3
            diabetesTipoDos: verificacionCheked(diabetesTipoDos),//4
            enfermedadPulmonar: verificacionCheked(enfermedadPulmonar), //5
            acv: verificacionCheked(ACV), //6
            cancer: verificacionCheked(cancer), //7
            otrosAntecedentesFamiliares: otrosAntecedentes.val(),
        }
        
        if (pacienteResponsableSI.prop('checked')) {    
             
            infoFormulario.aplica = pacienteResponsableSI.val()
            infoFormulario.nombrePersonaResponsable = responsableNombre.val()
            infoFormulario.apellidosPersonaResponsable = responsableApellido.val()
            infoFormulario.telefonoPersonaResponsable = responsableTelefono.val()
            infoFormulario.parentezcoPersonaResponsable = responsableParentezco.val()

            infoFormulario.personaResponsable = true
        }

        console.log(infoFormulario);


        return infoFormulario
    }
})