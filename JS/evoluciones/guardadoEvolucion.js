//* este codigo contiene el guardado (solo el guardado) de las evoluciones de una consulta

$(document).ready(() => {

    //* variables globales
    const formEvolucion = $('#formEvolucion')
    const dientesOdontograma = $(".diente")

    //* eventos
    formEvolucion.submit((event) => {
        event.preventDefault();

        //* inputs form consulta -
        const evolucionFecha = $('#evolucionFecha').val()
        const evolucionActividad = $('#evolucionActividad').val()
        const evolucionCodigoCups = $('#evolucionCodigoCups').val()
        const evolucionCopago = $('#evolucionCopago').val()
        const evolucionDescripcion = $('#evolucionDescripcion').val()
        const numeroConsulta = $('#numeroConsulta').val()

        //* inputs datalist -

        const informacionEvolucion = {
            evolucionInfo: {
                evolucionFecha,
                evolucionActividad,
                evolucionCodigoCups,
                evolucionCopago,
                evolucionDescripcion
            },
            consultaInfo: {
                numeroConsulta
            },
            dientesInfo: obtenerDientesInfo()
        }

        // console.log(informacionEvolucion);

        const datos = new FormData()
        datos.append('informacionEvolucion', JSON.stringify(informacionEvolucion))

        //* proceso de ajax
        const xhr = new XMLHttpRequest()

        xhr.open('POST', '../Modules/models/evoluciones/guardado.php', true)
        xhr.send(datos)

        xhr.onload = () => {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const response = JSON.parse(xhr.responseText)

                if (response.process == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Guardado',
                        text: 'evolucion guardada correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.history.back()
                    })
                } else {
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

    //* funciones-
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

})