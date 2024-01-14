$(document).ready(() => {
    const papaModal = $("#overlay")
    const formOdontograma = $("#odontogramaModal")
    const body = $("body")
    const dientes = $(".diente")

    $("#gestionarOdontograma").click((e) => {
        e.preventDefault()
        ActivarDesactivarModal()
    })

    $("#btnCloseModal").click((e) => {
        e.preventDefault()
        ActivarDesactivarModal()
    })

    function ActivarDesactivarModal() {
        papaModal.toggleClass("overlayActive")
        formOdontograma.toggleClass("activeModal")
        body.toggleClass("bodyHideScroll")
    }


    //* eventos para capturar información de un diente seleccionado y mostrar modal segun accion
    dientes.each((i, diente) => {
        const nodosDiente = diente.childNodes
        const seccionesDiente = {
            top: nodosDiente[1],
            left: nodosDiente[3],
            center: nodosDiente[5],
            right: nodosDiente[7],
            botton: nodosDiente[9],
            general: nodosDiente[11],
        }

        for (const seccion in seccionesDiente) {
            const seccionSeleccionada = seccionesDiente[seccion]

            seccionSeleccionada.setAttribute("disabled", "disabled")
        }
    })
})
