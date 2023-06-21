$(document).ready(() => {
  const papaModal = $("#overlay")
  const formOdontograma = $("#odontogramaModal")
  const body = $("body")
  const dientes = $(".diente")

  //*modales para convenciones (general)
  const overlayConvencionGeneral = $("#overlayConvencionGeneral")
  const modalConvencionGeneral = $("#modalConvencionGeneral")
  const btnCloseModalConvencionGeneral = $('#btnCloseModalConvencionGeneral')

  //*modales para convenciones (seccion)
  const overlayConvencionSeccion = $("#overlayConvencionSeccion")
  const modalConvencionSeccion = $("#modalConvencionSeccion")
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

  btncloseModalRecuperarContraseña.click( (event) => { 
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

  // var a = {
  //   diente_18: {
  //     tipoOperacion: 'general',
  //     nombreConvencio: 'endodoncia',
  //     operacionesseccion: []
  //   },
  //   diente_17: {
  //     tipoOperacion: 'seccion',
  //     nombreConvencio: '',
  //     operacionesseccion: [
  //       {
  //         nombreSeccion: 'top',
  //         opciones: ['roja','verde','azul']
  //       },
  //       {
  //         nombreSeccion: 'bot',
  //         opciones: ['azul']
  //       }
  //     ]
  //   }
  // }

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
      const element = seccionesDiente[seccion]

      element.addEventListener("click", (event) => {
        event.preventDefault()

        dienteSeleccionado.area = element
        dienteSeleccionado.diente = diente

        if (seccion === "general") {
          //* procesos convencion general
          dienteSeleccionado.typeProcess = "general"
          overlayConvencionGeneral.addClass("overlayActive")
        } else {
          //* procesos convencion diente
          dienteSeleccionado.typeProcess = "seccion"
          overlayConvencionSeccion.addClass("overlayActive")
        }
      })
    }
  })

  //* eventos boton moda general diente
  const botonesModalGeneralDiente = $('#modalConvencionGeneral button')
  botonesModalGeneralDiente.each((index, button) => {
    button.addEventListener('click', (event) => {
      const typeConvencion = button.getAttribute('typeConvencion')
      const divImageOperacionDiente = dienteSeleccionado.diente.childNodes[13]
      const imgOperacionDiente = divImageOperacionDiente.childNodes[1]

      
      if (typeConvencion === 'cerrar') {
        overlayConvencionGeneral.removeClass("overlayActive")
        return false
      }

      if (typeConvencion !== 'limpiar') {
        event.preventDefault()

        const imagenConvencionGeneral = button.getAttribute('data-name-img')

        imgOperacionDiente.setAttribute('src', '../Img/convenciones/'+imagenConvencionGeneral)
        divImageOperacionDiente.classList.add('active')
        overlayConvencionGeneral.removeClass("overlayActive")
      }else{
        
        imgOperacionDiente.setAttribute('src', '')
        divImageOperacionDiente.classList.remove('active')
        overlayConvencionGeneral.removeClass("overlayActive")
      }
      
    })
  })

  //* eventos botones modal seccion diente 
  const botonesModalSeccionDiente = $("#modalConvencionSeccion button")
  botonesModalSeccionDiente.each((i, button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault()
      const { area } = dienteSeleccionado
      const process = event.target.getAttribute("typeConvencion")

      const span1 = area.childNodes[1]
      const span2 = area.childNodes[3]
      const span3 = area.childNodes[5]

      switch (process) {
        case "conv1":
          span1.classList.add("active")
          break

        case "conv2":
          span2.classList.add("active")
          break

        case "conv3":
          span3.classList.add("active")
          break

        case "limpiar":
          span1.classList.remove("active")
          span2.classList.remove("active")
          span3.classList.remove("active")
          break
      }
      dienteSeleccionado.area = null
      dienteSeleccionado.convencion = null
      dienteSeleccionado.typeProcess = null
      dienteSeleccionado.diente = null
      overlayConvencionSeccion.removeClass("overlayActive")
    })
  })
})
