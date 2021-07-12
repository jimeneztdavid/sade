
$(document).ready(function(){
  
    /** 
    *** Tabla de Atleta(s)
    **/
    $('table').on( 'click', 'tr', function () { 
       if ( $(this).hasClass('selected') ) {
           $(this).removeClass('selected');
           data = undefined;
       } else {
           table.$('tr.selected').removeClass('selected');
           $(this).addClass('selected');
           data = $('table').DataTable().row('.selected').data();
       }
    });
    var table = $('table').DataTable({
      ajax: {
        url: '/atleta',
        type: 'GET',
         dataSrc: ""
        },
      columns: [
        { data: 'nombre' },
        { data: 'apellido' },
        { data: 'cedula' },
        { data: 'correo' }
      ],
      responsive: true,
      language: {
          url: "../dist/datatable/language/Spanish.json"
          },
      select: true,
      dom: 'Bfrip',
      buttons: {
        dom: {
          button: {
            className: 'btn btn-danger'
          }
        },
        buttons: [
          {
            // Ver más
            text: '<i class="fa fa-file" title="Imprimir constancia"></i> Generar Constancia',
            action: function() {
            
                if (!data) {
                  ToasSeleccionePrimero();
                  return;
                }

                location.assign('/pdf/acreditacion/' + data.id);
            }
          }
        ]
      }
    });
    /* }); */
      
  });