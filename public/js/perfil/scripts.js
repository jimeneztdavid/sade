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
    
  /** 
  *** Actualizar Perfil
  **/
  
  $('#form-actualizar-perfil').submit(function(e){ e.preventDefault(); }).validate({
    
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
          equalTo: '#clave'
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
        var $btn = $("button[form=form-actualizar-perfil]");
        var $btnOT = $btn.html();
        var $data = $(form).serialize();
        
        $.ajax({
          method: "POST",
          dataType: "json",
          data: $data,
          url: "/profile/update",
          beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
          complete: function() { $btn.html($btnOT).attr('disabled', false); },
          success: function() { ToastExitoAlCargar(); },
          error: function(data) { 
            
            $(form).validate().showErrors(data.responseJSON.errors);
            ToastErrorAlCargar();
            
          }
        });
        
      }

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