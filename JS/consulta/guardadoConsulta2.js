//* este codigo contiene el guardado (solo el guardado) de la segunda parte de una consulta (el odontograma)

$(document).ready(() => {

    //* variables globales
    const formConsulta = $('#formConsulta')
    const dientesOdontograma = $(".diente")

    //* eventos
    formConsulta.submit((event) => {
        event.preventDefault();

        //* inputs form consulta -
        const protesisSi = $("#protesisSi").prop('checked') ? 'si' : 'no'
        const protesisTipo = $("#protesisTipo").prop('checked') ? 'si' : 'no'
        const protesisDescripcion = $("#protesisDescripcion").prop('checked') ? 'si' : 'no'
        const igieneOralSi = $("#igieneOralSi").prop('checked') ? 'si' : 'no'
        const frecuenciaCepilladoSi = $("#frecuenciaCepilladoSi").prop('checked') ? 'si' : 'no'
        const gradoRiesgoSi = $("#gradoRiesgoSi").prop('checked') ? 'si' : 'no'
        const sedaDentalSi = $("#sedaDentalSi").prop('checked') ? 'si' : 'no'
        const pigmentacionSi = $("#pigmentacionSi").prop('checked') ? 'si' : 'no'

        //* inputs datalist -
        const articular = capturarDataValue($("#datalistArticular").val(), 'articular')
        const pulpar = capturarDataValue($("#datalistPulpar").val(), 'articular')
        const periodontal = capturarDataValue($("#datalistPeriodontal").val(), 'articular')
        const dental = capturarDataValue($("#datalistDental").val(), 'articular')
        const cd = capturarDataValue($("#datalistCD").val(), 'articular')
        const tejidosBlandos = capturarDataValue($("#datalistTejidosBlandos").val(), 'articular')
        const otros = capturarDataValue($("#datalistOtros").val(), 'articular')

        const data = {
            consultaInfo: {
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
            dientesInfo: obtenerDientesInfo()
        }

        console.log(data);
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

            const procesos = Array.from(seccion.querySelectorAll('span')).map((span, index) => {
                if (span.classList.contains('active')) {
                    let operacion = null

                    if (index === 0) {
                        operacion = 'cariado'
                    }

                    if (index === 1) {
                        operacion = 'obturado - amalgama'
                    }

                    if (index === 2) {
                        operacion = 'obturado - resina'
                    }

                    return operacion
                }

                return false
            }).filter(value => value)

            return {
                nombre,
                procesos
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

    //* retorna el dataValue en un datalist. textobuscar: valor del input, datalist: datalist del cual se desea hacer busqueda
    function capturarDataValue(textoBuscar, datalist) {
        const optionDatalist = Array.from(document.querySelectorAll(`#${datalist} option`));
        const optionEncontrado = optionDatalist.find(option => option.value === textoBuscar);

        if (optionEncontrado) {
            console.log(optionEncontrado.getAttribute('data-value'));
            return optionEncontrado.getAttribute('data-value');
        } else {
            return null;
        }
    }
})