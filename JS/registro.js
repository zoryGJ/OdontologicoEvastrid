//! agarramos el documento completo

$(document).ready(function () {

    //! dentro del documento agarrar el formulario a trabajar con el #id propio.

    const formNuevoAmind = $('#formularioNuevoAdministrador')

    //?agregamos evento submit para que agarre los campos rellenados por el usuario en los input


    formNuevoAmind.submit(function (e) { 

        e.preventDefault()

        //? agarramos la informacion neta osea el valor o value, utilizando variables, id, etc, (recordar verificar que se agarraron los datos con un LOG)

        const nombresUsuario = $('#nombreUsuario').val();
        const apellidosUsuario = $('#apellidosUsuario').val();
        const correoUsuario = $('#correoUsuario').val();
        const cargoUsuario = $('#cargoUsuario').val();
        const claveUsuario = $('#claveUsuario').val();
        
        //? Procedemos a traducir la informacion al lenguaje JSON para asi poderla enviar a php, se utilizan los nombres de las columnas tal cual estan escritos en la base de datos.

        let data = new FormData()
        data.append("nombres", nombresUsuario)
        data.append("apellidos", apellidosUsuario)
        data.append("email", correoUsuario)
        data.append("cargo", cargoUsuario)
        data.append("clave", claveUsuario)

        const textBtnSubmit  = $('#btnSubmitFormAdmin p').html()
        if (textBtnSubmit === 'Editar &amp; finalizar') {
            //* añadiendo id del administrador al objeto 'data' para usarlo en el post del proceso dactualizacion
            data.append('idAdmin', $('#idAministrador').val())
            actAministrador(data)
        }else{
            crearAdministrador(data)
        }
        
    });
});


function crearAdministrador(infoNuevoAdmin) {
    //? le colocamos XHTML para tranducirla de JSON a PHP

    let ajax = new XMLHttpRequest()

    //? preparamos informacion traducida y elegimos el metodo para enviarla a php, y enrrutamos al  modulo php

    ajax.open('POST', '../Modules/models/registro.php', true)

    //? enviamos la informacion a php, -> es el momento de trabajar en el modulo php.

    ajax.send(infoNuevoAdmin)

    //? recibimos informacion que me envia php. antes verificamos haciendo LOG a la variable de la respuesta haber que me informacion trae guardada(cuando este todo listo hacer el condicional)

    ajax.onload = () => {


        if (ajax.status == 200) {

            let respuestaDePhp = JSON.parse(ajax.responseText)

            console.log(respuestaDePhp);

            //? este msj lo sacamos de la pagina sweetalert2 para mostrar msj de alertas
            if (respuestaDePhp.proceso == "correcto") {

                Swal.fire({
                    icon: 'success',
                    title: 'Exitoso',
                    text: 'Usuario Guardado Correctamente',
                }).then(function (click) {
                    window.location.href = "login.php"
                })
                
                //!revisalo luego direccionalo al login cuando ya lo hayas creado, limpiar el formulario y cerrar el modal
            
            } else {
                if (respuestaDePhp.proceso == "incorrecto") {

                    Swal.fire({
                        icon: 'error',
                        title: 'Lo sentimos...',
                        text: 'Ha ocurrido un error, intentalo nuevamente',
                    })

                }
            }

            console.log(respuestaDePhp);

        }

    }
}



function actAministrador(infoEditAdmin) {
    //? le colocamos XHTML para tranducirla de JSON a PHP

    let ajax = new XMLHttpRequest()

    //? preparamos informacion traducida y elegimos el metodo para enviarla a php, y enrrutamos al  modulo php

    ajax.open('POST', '../Modules/models/editAdmin.php', true)

    //? enviamos la informacion a php, -> es el momento de trabajar en el modulo php.

    ajax.send(infoEditAdmin)

    //? recibimos informacion que me envia php. antes verificamos haciendo LOG a la variable de la respuesta haber que me informacion trae guardada(cuando este todo listo hacer el condicional)

    ajax.onload = () => {


        if (ajax.status == 200) {

            let respuestaDePhp = JSON.parse(ajax.responseText)

            console.log(respuestaDePhp);

            //? este msj lo sacamos de la pagina sweetalert2 para mostrar msj de alertas
            if (respuestaDePhp.proceso == "correcto") {

                Swal.fire({
                    icon: 'success',
                    title: 'Exitoso',
                    text: 'Usuario Actualizado Correctamente',
                }).then(function (click) {
                    window.location.reload()
                })
                
                //!revisalo luego direccionalo al login cuando ya lo hayas creado, limpiar el formulario y cerrar el modal
            
            } else {
                if (respuestaDePhp.proceso == "incorrecto") {

                    Swal.fire({
                        icon: 'error',
                        title: 'Lo sentimos...',
                        text: 'Ha ocurrido un error, intenta nuevamente',
                    })

                }
            }

        }

    }
}
