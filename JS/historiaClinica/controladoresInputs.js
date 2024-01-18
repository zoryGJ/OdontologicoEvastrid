$(document).ready(() => {
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


})