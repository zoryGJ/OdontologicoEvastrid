$(document).ready(function(){

    const btnCerrarSession = $('#btnCerrarSession')
    console.log('Wasaaaaa');

    btnCerrarSession.click((e) => {
        e.preventDefault()

        const xhr = new XMLHttpRequest()
        xhr.open('GET', '../Modules/models/logout.php', true)
        xhr.send()

        xhr.onload = () => {
            if (xhr.status === 200) {
                const respuesta = JSON.parse(xhr.responseText)
                
                if (respuesta.proceso === 'success') {
                    window.location.href = 'login.php'
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Opsss',
                        text: 'Ha ocurrido un error',
                    })
                }
            }
        }
    })
})