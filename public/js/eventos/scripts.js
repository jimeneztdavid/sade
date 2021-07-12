// const { data } = require("jquery");

$(document).ready(function(){
  
  /** 
  *** Tabla de Evento(s)
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
          // Ver
          text: '<i class="fa fa-eye" title="Registrar"></i> Ver Evento',
          className: "",
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $.each(data, function(name, value){ 
                // cambios los valroes de los input.
                $('.ver-evento [name=' + name + ']') .val(value) .closest('.form-group') .addClass('bmd-form-group is-filled'); 
              });
              $('.ver-evento').modal();
              
          },
          init: function(api, node, config) {
             $(node).removeClass('btn-default');
          }
        },
        {
          // Registrar
          text: '<i class="fa fa-plus-circle" title="Registrar"></i> Nuevo Evento',
          className: "",
          action: function(){
              $('.nuevo-evento').modal();
          },
          init: function(api, node, config) {
             $(node).removeClass('btn-default');
          }
        },
        {
          // Actualizar
          text: '<i class="fa fa-pencil-square" title="Actualizar"></i> Actualizar Evento',
          className: "",
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $('.actualizar-evento option[selected]').removeAttr('selected');
            
              $.each(data, function(name, value){ 
                
                // cambios los valroes de los input.
                $('.actualizar-evento [name=' + name + ']') .val(value) .closest('.form-group') .addClass('bmd-form-group is-filled'); 
                
              });
            
              $('.actualizar-evento').modal();
            
              console.log(data);
          }
        },
        {
          text: '<i class="fa fa-plus" title="Agregar Atletas al Evento"></i> Agregar Atletas al Evento',
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
              
              location.assign('/agregar-atletas/'+ data.id);
            
          }
        },
        {
          text: '<i class="fa fa-trash-o" title="Eliminar"></i> Eliminar',
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $('.eliminar-evento').modal();
              $('.eliminar-evento [data-id]').attr('data-id', data.id);
            
              console.log(data);
            
          }
        }
      ]
    }, initComplete: function( settings, json ) {
        $('[name=fecha]').datepicker({
            format: 'yyyy-mm-dd', 
            language: 'es-ES'
        });
    }
  });
  
  /** 
  *** Nueva Evento
  **/
  
  $('#form-nuevo-evento').submit(function(e){ e.preventDefault(); }).validate({
    
      // Establezco las reglas del formulario.
      rules: {
        descripcion: {
          required: true
        }
      },
    
      // Establezco los mensajes
      messages: {
        descripcion: {
          required: "• Porfavor, rellene este campo antes de cotinuar."
        }
      },
        
      // Cuando tod esté correcto.
      submitHandler: function(form) {
        
        // Empieza a validar el formulario
        var $btn = $("button[form=form-nuevo-evento]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/evento",
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.nuevo-evento').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); $(form).trigger('reset'); },
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
  *** Actualizar Evento
  **/
  
  $('#form-actualizar-evento').submit(function(e){ e.preventDefault(); }).validate({
    
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
        var $btn = $("button[form=form-actualizar-evento]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/evento/" + data.id,
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.actualizar-evento').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); },
          error: function(data) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            ToastErrorAlCargar();
            
          }
        });
        
      }

    });
  
  /** 
  *** Eliminar Evento
  **/
  
  $('[data-action=eliminar]').on('click', function(){
    
    // Botones.
    var $btn = $(this);
    var $btnOT = $btn.html();
        
    $.ajax({
      method: "POST",
      dataType: "json",
      data: { id: $btn.attr('data-id'), _method: "DELETE" },
      url: "/evento/" + $btn.attr('data-id'),
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.eliminar-evento').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
    
});