$(document).ready( ()=> {
    $('#misPacientes').dataTable({
        
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'pdf', 
        ]
    });
 
    $('#historialConsulta').dataTable({

        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'pdf', 
        ]

    })

} ); 

