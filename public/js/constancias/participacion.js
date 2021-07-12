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
        url: '/evento',
        type: 'GET',
         dataSrc: ""
        },
      columns: [
        { data: 'nombre_disciplina' },
        { data: 'fecha' }
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
            text: '<i class="fa fa-file" title="Generar constancia"></i> Generar Constancia',
            action: function() {
            
                if (!data) {
                  ToasSeleccionePrimero();
                  return;
                }

                $('.seleccionar-atleta select').append('<option disabled selected>Cargando...</option>');

                // Abre la ventana modal de los estudiantes.
                $.get("/asistencia_evento/" + data.id).done(function(atletas){
                  $('.seleccionar-atleta select').empty().attr('disabled',false);
                  if(atletas.length > 0) {
                    $.each(atletas, function(name, value){ 
                      $('.seleccionar-atleta select').append('<option value="'+value.id+'">'+value.nombre+' '+value.apellido+' ('+value.cedula+')</option>');
                    });
                  } else {
                    $('.seleccionar-atleta select').append('<option disabled selected>No se encontraron registros.</option>').attr('disabled',true);
                    return;
                  }
                });
                $('.seleccionar-atleta').modal();
            }
          }
        ]
      }
    });
    /* }); */

  
  // Cuando cierro la modal de atletas.
  // Reinicia las opciones.
  $('.seleccionar-atleta').on('hidden.bs.modal', function () {
    $('.seleccionar-atleta select').empty();
  })

  $('.btn-print-file').click(function(){
    if(!$('select[name=atletas_id').val()) {
      ToasSeleccionePrimero();
      return;
    }
    var $atleta = $('select[name=atletas_id').val();
    var $evento = data.id;
    location.assign('/participacion/evento/'+$evento+'/atleta/'+$atleta);
  });
      
});