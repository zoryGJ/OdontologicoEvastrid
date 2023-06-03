$(document).ready( ()=> {

    const modal = $('#overlay')
    const modalFomAdmin = $('#modalFomAdmin')
    const body = $('body')
    const botonesEditar = $('.editarAdmi')
    const titleFormAdmin = $('#titleFormAdmin') 

    let a;
    

    botonesEditar.each((i,botonquerecorre)=>{
        botonquerecorre.addEventListener('click',(e)=>{
            e.preventDefault()

            //*el attr me coloca el valor que agarra val y lo coloca en el elemento que en este caso agarra el id.
            $('#nombreUsuario').val(botonquerecorre.getAttribute('nombreAdmin'))
            $('#apellidosUsuario').val(botonquerecorre.getAttribute('apellidoAdmin'))
            $('#correoUsuario').val(botonquerecorre.getAttribute('emailAdmin'))
            $('#cargoUsuario').val(botonquerecorre.getAttribute('cargoAdmin'))
            $('#claveUsuario').val('')//* al actualizar usuarios, la clave debe ser nueva


            //* asignando id del admin seleccionado (el boton que se le dio click) al input hidden del formulario llamado 'idAministrador'
            $('#idAministrador').val(botonquerecorre.getAttribute('idAdmin'))

            //* asiganando texto y acciones a elementos, cuando el formulario es para edicion
            titleFormAdmin.text('Editar datos')
            $('#btnSubmitFormAdmin p').text('Editar & finalizar')
            ActivarDesactivar()
        })
   })


    $('#newUsu').click((e)=> { 
        e.preventDefault();

        //* asiganando texto y acciones a elementos, cuando el formulario es para creación
        titleFormAdmin.text('Nuevo Administrador')
        $('#btnSubmitFormAdmin p').text('Guardar & Finalizar')

        ActivarDesactivar()    
    });

    $('#CloseModalA').click( (e)=>  { 
        e.preventDefault();
        $("#modalFomAdmin :input").val(''); //** para limpiar las casillas cuando se cierre
        
        ActivarDesactivar()           
    });

    function ActivarDesactivar() {
        modal.toggleClass("overlayActive") 
        body.toggleClass("bodyHideScroll")
        modalFomAdmin.toggleClass('activeModal')
    }
});

