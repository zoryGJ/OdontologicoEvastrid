//* Este codigo contiene solo los controladores para los inputs y elementos de la pagina guardado consulta 2

$(document).ready(() => {

    //* dientes del odontograma
    const dientesOdontograma = $(".diente")
    
    //* procesos
    dientesOdontograma.each((i, diente) => {
        //* si no existe el atributo procesoDiente se crea
        if (diente.getAttribute('procesodiente') === null) {
            diente.setAttribute('procesoDiente', '')
            diente.setAttribute('convencionDiente', '')
        }
    })
})