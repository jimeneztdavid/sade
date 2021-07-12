$(document).ready(function(){
  
  /** 
  *** Tabla de Usuario(s)
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
      url: '/usuario',
      type: 'GET',
       dataSrc: ""
      },
    columns: [
      { data: 'nombre' },
      { data: 'apellido' },
      { data: 'cedula' },
      { data: 'email' },
      { data: 'role_name' }
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
          text: '<i class="fa fa-plus-circle" title="Registrar"></i> Nuevo Usuario',
          className: "",
          action: function(){
              $('.nuevo-usuario').modal();
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
            
              $('.actualizar-usuario').modal();
              $('.actualizar-usuario [name=nombre]').val(data.nombre);
              $('.actualizar-usuario [name=apellido]').val(data.apellido);
              $('.actualizar-usuario [name=cedula]').val(data.cedula);
              $('.actualizar-usuario [name=email]').val(data.email);
              $('.actualizar-usuario [name=role_id]').val(data.role_id);
              $('.actualizar-usuario [name=id]').val(data.id);
          }
        },
        {
          text: '<i class="fa fa-trash-o" title="Eliminar"></i> Eliminar',
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $('.eliminar-usuario').modal();
              $('.eliminar-usuario [data-id]').attr('data-id', data.id);
            
          }
        },
        {
          text: 'Activar/Desactivar',
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }


              console.log(data);
              if(data.active == 1) {
                $('.act-des-usuario').find('#new-status').text('desactivar');
                $('.act-des-usuario [data-new-status]').attr('data-new-status', 0);
              } else {
                $('.act-des-usuario').find('#new-status').text('activar');
                $('.act-des-usuario [data-new-status]').attr('data-new-status', 1);
              }
            
              $('.act-des-usuario').modal();
              $('.act-des-usuario [data-id]').attr('data-id', data.id);
            
          }
        }
      ]
    }
  });
  
  /** 
  *** Nuevo Usuario
  **/
  
  $('#form-nuevo-usuario').submit(function(e){ e.preventDefault(); }).validate({
    
      // Establezco las reglas del formulario.
      rules: {
        nombre: {
          required: true,
          maxlength: 40,
          charsonly: true
        },
        apellido: {
          required: true,
          maxlength: 40,
          charsonly: true
        },
        cedula: {
          required: true,
          maxlength: 10,
          minlength: 6,
          number: true
        },
        email: {
          required: true,
          maxlength: 60,
          email: true
        },
        clave: {
          required: true,
          minlength: 8,
          maxlength: 20,
          contrasena: true,
        },
        conf_clave: {
          equalTo: '#form-nuevo-usuario #clave'
        }
      },
    
      // Establezco los mensajes
      messages: {
        nombre: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 40 caracteres."
        },
        apellido: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 40 caracteres."
        },
        cedula: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 10 caracteres.",
          minlength: "• No debe ser menor a 6 caracteres.",
          number: "• Solo números."
        },
        email: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 60 caracteres.",
          email: "• Este no es un correo electrónico valido."
        },
        clave: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          minlength: "• No debe ser menor de 8 caracteres.",
          maxlength: "• No debe ser mayor a 20 caracteres.",
          contrasena: "• No cumple con los requisitos de la contraseña.",
        },
        conf_clave: {
          equalTo: '• No coinciden las contraseñas.'
        }
      },
        
      // Cuando tod esté correcto.
      submitHandler: function(form) {
        
        // Empieza a validar el formulario
        var $btn = $("button[form=form-nuevo-usuario]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/usuario",
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.nuevo-usuario').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); $(form).trigger('reset'); },
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
  *** Actualizar Usuario
  **/
  
  $('#form-actualizar-usuario').submit(function(e){ e.preventDefault(); }).validate({
    
      // Establezco las reglas del formulario.
      rules: {
        nombre: {
          required: true,
          maxlength: 40
        },
        apellido: {
          required: true,
          maxlength: 40
        },
        cedula: {
          required: true,
          maxlength: 10,
          minlength: 6,
          number: true
        },
        email: {
          required: true,
          maxlength: 60,
          email: true
        },
        clave: {
          minlength: 8,
          maxlength: 20,
          contrasena: true
        },
        conf_clave: {
          equalTo: '#form-actualizar-usuario #clave'
        }
      },
    
      // Establezco los mensajes
      messages: {
        nombre: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 40 caracteres."
        },
        apellido: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 40 caracteres."
        },
        cedula: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 10 caracteres.",
          minlength: "• No debe ser menor a 6 caracteres.",
          number: "• Solo números."
        },
        email: {
          required: "• Porfavor, rellene este campo antes de cotinuar.",
          maxlength: "• No debe ser mayor de 60 caracteres.",
          email: "• Este no es un correo electrónico valido."
        },
        clave: {
          minlength: "• No debe ser menor de 8 caracteres.",
          maxlength: "• No debe ser mayor a 20 caracteres.",
          contrasena: "• No cumple con los requisitos de la contraseña."
        },
        conf_clave: {
          equalTo: '• Las contraseñas no coinciden.'
        }
      },
    
      // Cuando tod esté correcto.
      submitHandler: function(form) {
        
        // Empieza a validar el formulario
        var $btn = $("button[form=form-actualizar-usuario]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/usuario/" + data.id,
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { $('.actualizar-usuario').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); },
          error: function(data) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            ToastErrorAlCargar();
            
          }
        });
        
      }

    });
  
  /** 
  *** Eliminar Usuario
  **/
  
  $('[data-action=eliminar]').on('click', function(){
    
    // Botones.
    var $btn = $(this);
    var $btnOT = $btn.html();
        
    $.ajax({
      method: "POST",
      dataType: "json",
      data: { id: $btn.attr('data-id'), _method: "DELETE" },
      url: "/usuario/" + $btn.attr('data-id'),
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.eliminar-usuario').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
  
  $('[data-action=activar-desactivar]').on('click', function(){
    
    // Botones.
    var $btn = $(this);
    var $btnOT = $btn.html();
        
    $.ajax({
      method: "POST",
      dataType: "json",
      data: { user_id: $btn.attr('data-id'), status: $btn.attr('data-new-status') },
      url: "/usuario-status/",
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.act-des-usuario').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
       
    /* CHEQUEAR LA CONTRASEÑA */
    $('input[name=clave]').focus(function(){
        
        var $thisFormVd = $(this).closest('form').validate();
        var $thisElement = $(this);        
        var $passwordMatcher = $(this).siblings('.password-matcher');
        
        if($thisFormVd.element($thisElement)) { 
        $passwordMatcher.slideUp(); } else {
        $passwordMatcher.slideDown(); 
        }
        
    }).blur(function(){
        
        var $passwordMatcher = $(this).siblings('.password-matcher');
        $passwordMatcher.slideUp();
        
    }).on('keyup', function(){
        
        
        var $thisFormVd = $(this).closest('form').validate();
        var $thisElement = $(this);        
        var $passwordMatcher = $(this).siblings('.password-matcher');
        var $valPM = $(this).val();
        
        // Chequeo si es minimo 8 caracteres. (#req-1)
        if ($valPM.search(/.{8,}/) != "-1") {
          $passwordMatcher.find('#req-1').addClass('complete');
        } else {
          $passwordMatcher.find('#req-1').removeClass('complete');
        }
        // Chequeo si no es mayor a 15. (#req-2)
        if ($valPM.length < 15) { 
          $passwordMatcher.find('#req-2').addClass('complete');
        } else {
          $passwordMatcher.find('#req-2').removeClass('complete');
        }
        // Chequeo si tiene mayusculas. (#req-3)
        if ($valPM.search(/([A-Z])/) != "-1") { 
          $passwordMatcher.find('#req-3').addClass('complete');
        } else {
          $passwordMatcher.find('#req-3').removeClass('complete');
        }
        // Chequeo si tiene minusculas. (#req-4)
        if ($valPM.search(/([a-z])/) != "-1") { 
          $passwordMatcher.find('#req-4').addClass('complete');
        } else {
          $passwordMatcher.find('#req-4').removeClass('complete');
        }
        // Chequeo si tiene algún digito númerico. (#req-5)
        if ($valPM.search(/([\d])/) != "-1") { 
          $passwordMatcher.find('#req-5').addClass('complete');
        } else {
          $passwordMatcher.find('#req-5').removeClass('complete');
        }
        // Chequeo si tiene algún espacio en blanco. (#req-6)
        if ($valPM.search(/([^ ])/) != "-1") { 
          $passwordMatcher.find('#req-6').addClass('complete');
        } else {
          $passwordMatcher.find('#req-6').removeClass('complete');
        }
        // Chequeo si tiene algún caracter especial. (#req-7)
        if ($valPM.search(/([$@$!%*?&.,#])/) != "-1") { 
          $passwordMatcher.find('#req-7').addClass('complete');
        } else {
          $passwordMatcher.find('#req-7').removeClass('complete');
        }
        
        if($thisFormVd.element($thisElement)) { 
        $passwordMatcher.slideUp(); } else {
        $passwordMatcher.slideDown();
        }
        
    });
    
    
});