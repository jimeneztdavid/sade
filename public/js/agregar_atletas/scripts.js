$(document).ready(function(){
  
  /** 
  *** Tabla de PNF(s)
  **/

  var $evento = $('[id_evento]').attr('id_evento');
  
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
      url: '/asistencia_evento/' + $evento,
      type: 'GET',
       dataSrc: ""
      },
    columns: [
      { data: 'nombre' },
      { data: 'cedula' }
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
          // Registrar
          text: '<i class="fa fa-plus-circle" title="Registrar"></i> Nuevo Atleta',
          className: "",
          action: function(){

              $('#atletas_id').append('<option disabled selected>Cargando...</option>').attr('disabled', false);

              $.get("/atletas_no_registrados/evento/" + $evento).done(function(atletas){
                $('#atletas_id').empty();
                if(atletas.length > 0) {
                  $.each(atletas, function(name, value){ 
                    $('#atletas_id').append('<option value="'+value.id+'">'+value.nombre+' '+value.apellido+' ('+value.cedula+')</option>');
                  });
                } else {
                  $('#atletas_id').empty().append('<option disabled selected>No se encontraron registros.</option>').attr('disabled', true);
                }
                $('#atletas_id').selectpicker('refresh');
                $('#atletas_id').selectpicker('render');
              });
              $('.nuevo-atleta').modal();
          },
          init: function(api, node, config) {
             $(node).removeClass('btn-default');
          }
        },
        {
          text: '<i class="fa fa-trash-o" title="Eliminar"></i> Eliminar',
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $('.eliminar-atleta').modal();
              $('.eliminar-atleta [data-id]').attr('data-id', data.id);            
          }
        }
      ]
    }
  });
  
  // Cuando cierro la modal de atletas.
  // Reinicia las opciones.
  $('.nuevo-atleta').on('hidden.bs.modal', function () {
    $('#atletas_id').empty();
  })

  /** 
  *** Nuevo PNF
  **/
  $('#form-nuevo-atleta').submit(function(e){ e.preventDefault(); }).validate({
    
      // Cuando tod esté correcto.
      submitHandler: function(form) {
        
        // Empieza a validar el formulario
        var $btn = $("button[form=form-nuevo-atleta]");
        var $btnOT = $btn.html();
        // var $data = $(form).serialize();
        var $data = new FormData($(form)[0]);
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/asistencia_evento",
          processData: false,
          contentType: false,
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.nuevo-atleta').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); $(form).trigger('reset'); },
          error: function(data, textStatus, errorThrown) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            ToastErrorAlCargar();
          
          }
        });
        
      }

    });  
  
  /** 
  *** Eliminar PNF
  **/
  
  $('[data-action=eliminar]').on('click', function(){
    
    // Botones.
    var $btn = $(this);
    var $btnOT = $btn.html();
        
    $.ajax({
      method: "POST",
      dataType: "json",
      data: { atletas_id: $btn.attr('data-id'), eventos_id: $evento, _method: "DELETE" },
      url: "/excluir_atleta",
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.eliminar-atleta').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
    
});