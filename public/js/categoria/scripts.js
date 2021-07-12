$(document).ready(function(){
  
  /** 
  *** Tabla de Categoria(s)
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
      url: '/categoria',
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
          text: '<i class="fa fa-plus-circle" title="Registrar"></i> Nueva Categoria',
          className: "",
          action: function(){
              $('.nueva-categoria').modal();
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
            
              $('.actualizar-categoria').modal();
              $('.actualizar-categoria [name=nombre]').val(data.nombre);
              $('.actualizar-categoria [name=id]').val(data.id);
            
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
            
              $('.eliminar-categoria').modal();
              $('.eliminar-categoria [data-id]').attr('data-id', data.id);
            
              console.log(data);
            
          }
        }
      ]
    }
  });
  
  /** 
  *** Nueva Categoria
  **/
  
  $('#form-nueva-categoria').submit(function(e){ e.preventDefault(); }).validate({
    
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
        var $btn = $("button[form=form-nueva-categoria]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/categoria",
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.nueva-categoria').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); $(form).trigger('reset'); },
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
  *** Actualizar Categoria
  **/
  
  $('#form-actualizar-categoria').submit(function(e){ e.preventDefault(); }).validate({
    
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
        var $btn = $("button[form=form-actualizar-categoria]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/categoria/" + data.id,
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.actualizar-categoria').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); },
          error: function(data) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            ToastErrorAlCargar();
            
          }
        });
        
      }

    });
  
  /** 
  *** Eliminar Categoria
  **/
  
  $('[data-action=eliminar]').on('click', function(){
    
    // Botones.
    var $btn = $(this);
    var $btnOT = $btn.html();
        
    $.ajax({
      method: "POST",
      dataType: "json",
      data: { id: $btn.attr('data-id'), _method: "DELETE" },
      url: "/categoria/" + $btn.attr('data-id'),
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.eliminar-categoria').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
    
});