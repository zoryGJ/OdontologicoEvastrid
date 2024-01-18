$(document).ready(() => {
    const papaModal = $("#overlay")
    const formOdontograma = $("#odontogramaModal")
    const body = $("body")
    const dientes = $(".diente")

    //*modales para convenciones (general)
    const overlayConvencionGeneral = $("#overlayConvencionGeneral")
    const btnCloseModalConvencionGeneral = $('#btnCloseModalConvencionGeneral')

    //*modales para convenciones (seccion)
    const overlayConvencionSeccion = $("#overlayConvencionSeccion")
    const btnCloseModalConvencionSeccion = $("#btnCloseModalConvencionSeccion")

    //*modal recuperar contraseña
    const overlayRecuperarContraseña = $("#overlayRecuperarContraseña")
    const ModalRecuperarContraseña = $("#ModalRecuperarContraseña")
    const btncloseModalRecuperarContraseña = $("#btncloseModalRecuperarContraseña")


    btnCloseModalConvencionGeneral.click((event) => {
        event.preventDefault()
        overlayConvencionGeneral.removeClass("overlayActive")
    })

    btnCloseModalConvencionSeccion.click((event) => {
        event.preventDefault()
        overlayConvencionSeccion.removeClass("overlayActive")
    })

    btncloseModalRecuperarContraseña.click((event) => {
        event.preventDefault();
        overlayRecuperarContraseña.removeClass("overlayActive")
    })

    //*abriendo modal de recuperar contraseña
    $("#recuperarContraseña").click((e) => {
        e.preventDefault()
        overlayRecuperarContraseña.toggleClass("overlayActive")
        ModalRecuperarContraseña.toggleClass("activeModal")
    })

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

    //* proceso de convenciones
    const dienteSeleccionado = {
        convencion: null,
        area: null,
        typeProcess: null,
        diente: null
    }

    //* limpieza del diente seleccionado
    const limpiarDienteSeleccionado = () => {
        dienteSeleccionado.area = null
        dienteSeleccionado.convencion = null
        dienteSeleccionado.typeProcess = null
        dienteSeleccionado.diente = null
    }

    //* eventos boton moda general diente
    const botonesModalGeneralDiente = $('#modalConvencionGeneral button')
    botonesModalGeneralDiente.each((index, button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault()

            const typeConvencion = button.getAttribute('typeConvencion')
            const imagenConvencionGeneral = button.getAttribute('data-name-img')
            const nombreConvencionGeneral = button.getAttribute('data-name-process')
            const divImageOperacionDiente = dienteSeleccionado.diente.childNodes[13]
            const imgOperacionDiente = divImageOperacionDiente.childNodes[1]

            if (typeConvencion === 'cerrar') {
                overlayConvencionGeneral.removeClass("overlayActive")
                return false
            }

            if (typeConvencion === 'limpiar') {
                divImageOperacionDiente.classList.remove('active')
                overlayConvencionGeneral.removeClass("overlayActive")

                imgOperacionDiente.setAttribute('src', '')
                dienteSeleccionado.diente.setAttribute('procesoDiente', '')
                dienteSeleccionado.diente.setAttribute('convencionDiente', '')

                return false
            }

            dienteSeleccionado.diente.setAttribute('procesoDiente', 'general')
            dienteSeleccionado.diente.setAttribute('convencionDiente', nombreConvencionGeneral)

            imgOperacionDiente.setAttribute('src', '../Img/convenciones/' + imagenConvencionGeneral)
            divImageOperacionDiente.classList.add('active')
            overlayConvencionGeneral.removeClass("overlayActive")
            limpiarDienteSeleccionado()
        })
    })

    //* eventos botones modal seccion diente 
    const botonesModalSeccionDiente = $("#modalConvencionSeccion button")
    botonesModalSeccionDiente.each((i, button) => {
        button.addEventListener("click", (event) => {
            event.preventDefault()
            const { area } = dienteSeleccionado
            const process = event.target.getAttribute("typeConvencion")

            switch (process) {
                case "conv1":
                    //* removiendo clases de convenciones en caso de que existan
                    area.classList.remove("active", "cariado", "amalgama", "resina")

                    //* agregando clase de convencion
                    area.classList.add("active", "cariado")
                    break

                case "conv2":
                    //* removiendo clases de convenciones en caso de que existan
                    area.classList.remove("active", "cariado", "amalgama", "resina")

                    //* agregando clase de convencion
                    area.classList.add("active", "amalgama")
                    break

                case "conv3":
                    //* removiendo clases de convenciones en caso de que existan
                    area.classList.remove("active", "cariado", "amalgama", "resina")

                    //* agregando clase de convencion
                    area.classList.add("active", "resina")
                    break

                case "limpiar":
                    dienteSeleccionado.diente.setAttribute('procesoDiente', '')
                    area.classList.remove("active", "cariado", "amalgama", "resina")
                    break
            }

            dienteSeleccionado.diente.setAttribute('procesoDiente', 'seccion')
            overlayConvencionSeccion.removeClass("overlayActive")
            limpiarDienteSeleccionado()
        })
    })

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

            seccionSeleccionada.addEventListener("click", (event) => {
                event.preventDefault()

                dienteSeleccionado.area = seccionSeleccionada
                dienteSeleccionado.diente = diente

                if (seccion === "general") {
                    dienteSeleccionado.typeProcess = "general"
                    overlayConvencionGeneral.addClass("overlayActive")
                } else {
                    dienteSeleccionado.typeProcess = "seccion"
                    overlayConvencionSeccion.addClass("overlayActive")
                }
            })
        }
    })
})
