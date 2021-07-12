$(document).ready(function(){
  
  /** 
  *** Tabla de PNF(s)
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
      url: '/pnf',
      type: 'GET',
       dataSrc: ""
      },
    columns: [
      {data: 'nombre' }
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
          text: '<i class="fa fa-plus-circle" title="Registrar"></i> Nuevo PNF',
          className: "",
          action: function(){
              $('.nuevo-pnf').modal();
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
            
              $('.actualizar-pnf').modal();
              $('.actualizar-pnf [name=nombre]').val(data.nombre);
              $('.actualizar-pnf [name=id]').val(data.id);
            
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
            
              $('.eliminar-pnf').modal();
              $('.eliminar-pnf [data-id]').attr('data-id', data.id);
            
              console.log(data);
            
          }
        }
      ]
    }
  });
  
  /** 
  *** Nuevo PNF
  **/
  
  $('#form-nuevo-pnf').submit(function(e){ e.preventDefault(); }).validate({
    
      /* // Establezco las reglas del formulario.
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
      }, */
    
      // Cuando tod esté correcto.
      submitHandler: function(form) {
        
        // Empieza a validar el formulario
        var $btn = $("button[form=form-nuevo-pnf]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/pnf",
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.nuevo-pnf').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); $(form).trigger('reset'); },
          error: function(data, textStatus, errorThrown) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            ToastErrorAlCargar();
          
          }
        });
        
      }

    });  
  
  /** 
  *** Actualizar PNF
  **/
  
  $('#form-actualizar-pnf').submit(function(e){ e.preventDefault(); }).validate({
    
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
        var $btn = $("button[form=form-actualizar-pnf]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/pnf/" + data.id,
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.actualizar-pnf').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); },
          error: function(data) {
            
            // Muestro el toast.
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
      data: { id: $btn.attr('data-id'), _method: "DELETE" },
      url: "/pnf/" + $btn.attr('data-id'),
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.eliminar-pnf').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
    
});