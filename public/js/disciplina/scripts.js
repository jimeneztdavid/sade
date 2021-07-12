$(document).ready(function(){
  
  /** 
  *** Tabla de Disciplina(s)
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
      url: '/disciplina',
      type: 'GET',
       dataSrc: ""
      },
    columns: [
      { data: 'nombre' }
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
          text: '<i class="fa fa-plus-circle" title="Registrar"></i> Nueva Disciplina',
          className: "",
          action: function(){
              $('.nueva-disciplina').modal();
          },
          init: function(api, node, config) {
             $(node).removeClass('btn-default');
          }
        },
        {
          // Actualizar
          text: '<i class="fa fa-pencil-square" title="Actualizar"></i> Actualizar',
          className: "",
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $('.actualizar-disciplina option[selected]').removeAttr('selected');
              $('.actualizar-disciplina').modal();
              $('.actualizar-disciplina [name=nombre]').val(data.nombre);
              $('.actualizar-disciplina [name=id]').val(data.id);
              $('.actualizar-disciplina [name=user_id]').val(data.user_id);
            
              console.log(data);
          }
        },
        {
          text: '<i class="fa fa-trash-o" title="Eliminar"></i> Eliminar',
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $('.eliminar-disciplina').modal();
              $('.eliminar-disciplina [data-id]').attr('data-id', data.id);
            
              console.log(data);
            
          }
        }
      ]
    }
  });
  
  /** 
  *** Nueva Disciplina
  **/
  
  $('#form-nueva-disciplina').submit(function(e){ e.preventDefault(); }).validate({
    
      // Establezco las reglas del formulario.
      rules: {
        nombre: {
          required: true,
          maxlength: 40
        }
      },
    
      // Establezco los mensajes
      messages: {
        nombre: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 40 caracteres."
        }
      },
        
      // Cuando tod esté correcto.
      submitHandler: function(form) {
        
        // Empieza a validar el formulario
        var $btn = $("button[form=form-nueva-disciplina]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/disciplina",
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.nueva-disciplina').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); $(form).trigger('reset'); },
          error: function(data) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            $.toast({
              heading: 'Ha ocurrido un error!'
              , text: 'No se ha podido actualizar...'
              , position: 'top-right'
              , loaderBg: '#ff6849'
              , icon: 'error'
              , hideAfter: 3500
              , stack: 6
            })
          
          }
        });
        
      }

    });  
  
  /** 
  *** Actualizar Disciplina
  **/
  
  $('#form-actualizar-disciplina').submit(function(e){ e.preventDefault(); }).validate({
    
      // Establezco las reglas del formulario.
      rules: {
        nombre: {
          required: true,
          maxlength: 40
        }
      },
    
      // Establezco los mensajes
      messages: {
        nombre: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 40 caracteres."
        }
      },
        
      // Cuando tod esté correcto.
      submitHandler: function(form) {
        
        // Empieza a validar el formulario
        var $btn = $("button[form=form-actualizar-disciplina]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/disciplina/" + data.id,
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.actualizar-disciplina').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); },
          error: function(data) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            ToastErrorAlCargar();
            
          }
        });
        
      }

    });
  
  /** 
  *** Eliminar Disciplina
  **/
  
  $('[data-action=eliminar]').on('click', function(){
    
    // Botones.
    var $btn = $(this);
    var $btnOT = $btn.html();
        
    $.ajax({
      method: "POST",
      dataType: "json",
      data: { id: $btn.attr('data-id'), _method: "DELETE" },
      url: "/disciplina/" + $btn.attr('data-id'),
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.eliminar-disciplina').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
    
});