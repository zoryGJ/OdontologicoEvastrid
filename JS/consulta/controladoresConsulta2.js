//* Este codigo contiene solo los controladores para los inputs y elementos de la pagina guardado consulta 2

$(document).ready(() => {

    //* dientes del odontograma
    const dientesOdontograma = $(".diente")

    //* inputs protesis
    const [inputSiProtesis, inputNoProtesis] = $('.protesis input')

    //* inputs tipo - descripcion
    const [textareaTipo, textareaDescripcion] = $('.ok .p2 textarea')

    //* eventos
    inputSiProtesis.addEventListener('click', () => {
        textareaTipo.removeAttribute('disabled')
        textareaDescripcion.removeAttribute('disabled')
    })

    inputNoProtesis.addEventListener('click', () => {
        textareaTipo.setAttribute('disabled', true)
        textareaDescripcion.setAttribute('disabled', true)
        textareaTipo.value = ''
        textareaDescripcion.value = ''
    })

    //* procesos
    dientesOdontograma.each((i, diente) => {
        diente.setAttribute('procesoDiente', '')
        diente.setAttribute('convencionDiente', '')
    })
})