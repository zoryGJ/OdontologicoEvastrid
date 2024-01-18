
$(document).ready(() => {

    //*variables de los textarea -tabla consultaMSQL (html)
    const fechaConsulta = $('#fechaConsulta')
    const motivoConsulta = $('#motivoConsulta')
    const evolucionEstadoActual = $('#evolucionEstadoActual')
    const examenEstomatologico = $('#examenEstomatologico')
    const documentoPacienteTrabajar = $('#pacienteTrabajar')

    //*variable dientes odontograma
    const dientesOdontograma = $(".diente")

    //* variable formulario de guardado para consulta-1 (face1) (Manuel)
    const formConsulta1 = $('#formConsulta1')

    //*eventos
    formConsulta1.submit((event) => {
        event.preventDefault()

        const datos = leerDatosFormularioConsultas1()
        const data = new FormData()

        //?traducir captada informacion a JSON
        data.append('informacionConsulta', JSON.stringify(datos))
        data.append('tipoPeticion', 'consulta1')

        const ajax = new XMLHttpRequest()
        ajax.open('post', '../Modules/models/consultas/guardado.php', true)
        ajax.send(data)
        ajax.onload = () => {
            if (ajax.status == 200) {
                console.log(ajax.responseText);
                let respuesta = JSON.parse(ajax.responseText)
                console.log(respuesta);
                if (respuesta.proceso === 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Guardado',
                        text: 'Consulta registrada',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = 'inicio.php'
                    })
                } else {
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

        const infoForm = {
            fechaConsulta: fechaConsulta.val(),
            motivoConsulta: motivoConsulta.val(),
            evolucionEstadoActual: evolucionEstadoActual.val(),
            examenEstomatologico: examenEstomatologico.val(),
            pacienteTrabajar: documentoPacienteTrabajar.val(),
            dientesInfo: obtenerDientesInfo()
        }

        return infoForm
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

    //* funciones iniciadoras
    asignarFecha()


    //* funciones para obtener información de los dientes del odontograma
    function obtenerDientesInfo() {
        const dientes = Array.from(dientesOdontograma)

        const dientesInfo = dientes.map((diente) => {
            const procesoDiente = diente.getAttribute('procesodiente')

            if (procesoDiente === 'general') {
                return procesoDienteGeneral(diente)
            }

            if (procesoDiente === 'seccion') {
                return procesoDienteSeccion(diente)
            }

            return {
                numeroDiente: diente.getAttribute('dientenumero'),
                tipoOperacion: 'NA',
                nombreConvencion: '',
                operacionesSeccion: []
            }
        })

        return dientesInfo
    }

    function procesoDienteGeneral(diente) {
        return {
            numeroDiente: diente.getAttribute('dientenumero'),
            tipoOperacion: 'general',
            nombreConvencion: diente.getAttribute('convenciondiente'),
            operacionesSeccion: []
        }
    }

    function procesoDienteSeccion(diente) {
        const secciones = [
            diente.querySelector('.top'),
            diente.querySelector('.bot'),
            diente.querySelector('.left'),
            diente.querySelector('.right'),
            diente.querySelector('.center')
        ]

        const operacionesSeccion = secciones.map(seccion => {
            const nombre = verificarClase(seccion)
            let proceso = ''

            if (seccion.classList.contains('cariado')) {
                proceso = 'Cariado'
            }

            if (seccion.classList.contains('amalgama')) {
                proceso = 'Obturado - Amalgama'
            }

            if (seccion.classList.contains('resina')) {
                proceso = 'Obturado - Resina'
            }

            return {
                nombre,
                proceso
            }
        })

        return {
            numeroDiente: diente.getAttribute('dientenumero'),
            tipoOperacion: 'seccion',
            nombreConvencion: '',
            operacionesSeccion
        }
    }

    function verificarClase(div) {
        let clases = ['bot', 'top', 'left', 'right', 'center']

        for (let i = 0; i < clases.length; i++) {
            if (div.classList.contains(clases[i])) {
                return clases[i]
            }
        }

        return ''
    }

});