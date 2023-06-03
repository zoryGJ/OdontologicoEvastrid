$(document).ready(() => {


    //* form hmtl
    const formLogin = $('#formLogin')

    //* sumit form
    formLogin.submit((event) => {
        event.preventDefault()

        //* inputs form
        const emailAdmin = $('#emailAdmin').val()
        const claveAdmin = $('#claveAdmin').val()

        //* data ajax
        const data = new FormData()
        data.append('emailAdmin', emailAdmin)
        data.append('claveAdmin', claveAdmin)

        //* ajax
        const xhr = new XMLHttpRequest()
        xhr.open('POST', '../Modules/models/login.php', true)
        xhr.send(data)

        //* respuesta ajax
        xhr.onload = () => {
            //* proceso correcto
            if (xhr.status === 200) {
                let respuestaJson = xhr.responseText//? respuesta en formato json
                let respuestaObject = JSON.parse(respuestaJson)// ? respuesta en formato Objeti JS

                //* let respuestaObject = JSON.parse(xhr.responseText) <- en una linea seri así
                console.log(respuestaObject)

                if (respuestaObject.process === 'success') {
                    window.location.href = 'inicio.php'
                }
                else if (respuestaObject.process === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opsss',
                        text: respuestaObject.dataResponse,
                    })
                }
            }
        }
    })

})