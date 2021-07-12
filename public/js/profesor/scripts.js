 // VISTA PREVIA DE IMAGENES
  function PreviewImage(input, selector_preview) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $(selector_preview).attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  
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
          // Registrar
          text: '<i class="fa fa-plus-circle" title="Registrar"></i> Nuevo Atleta',
          className: "",
          action: function(){
              $('.nuevo-atleta').modal();
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
            
              $('.actualizar-atleta').modal();
              $('.actualizar-atleta [name=nombre]').val(data.nombre);
              $('.actualizar-atleta [name=apellido]').val(data.apellido);
              $('.actualizar-atleta [name=cedula]').val(data.cedula);
              $('.actualizar-atleta [name=correo]').val(data.correo);
              $('.actualizar-atleta [name=pasaporte]').val(data.pasaporte);
              $('.actualizar-atleta [name=nacionalidad]').val(data.nacionalidad);
              $('.actualizar-atleta [name=telefono_movil]').val(data.telefono_movil);
              $('.actualizar-atleta [name=telefono_casa]').val(data.telefono_casa);
              $('.actualizar-atleta [name=twitter]').val(data.twitter);
              $('.actualizar-atleta [name=direccion]').val(data.direccion);
              $('.actualizar-atleta [name=municipio]').val(data.municipio);
              $('.actualizar-atleta [name=parroquia]').val(data.parroquia);
              $('.actualizar-atleta [name=pnf_id]').val(data.pnf_id);
              $('.actualizar-atleta [name=lapso_inscripcion]').val(data.lapso_inscripcion);
              $('.actualizar-atleta [name=disciplina_id]').val(data.disciplina_id);
              $('.actualizar-atleta [name=fecha_nacimiento]').val(data.fecha_nacimiento);
              $('.actualizar-atleta [name=lugar_nacimiento]').val(data.lugar_nacimiento);
              $('.actualizar-atleta [name=tipo_sangre]').val(data.tipo_sangre);
              $('.actualizar-atleta [name=estatura]').val(data.estatura);
              $('.actualizar-atleta [name=peso]').val(data.peso);
              $('.actualizar-atleta [name=talla_zapato]').val(data.talla_zapato);
              $('.actualizar-atleta [name=talla_franela]').val(data.talla_franela);
              $('.actualizar-atleta [name=talla_short]').val(data.talla_short);
              $('.actualizar-atleta [name=observaciones]').val(data.observaciones);
              $('.actualizar-atleta [name=id]').val(data.id);
              $('#preview-upd-atleta').attr('src',data.foto_carnet);
            
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
            
              $('.eliminar-atleta').modal();
              $('.eliminar-atleta [data-id]').attr('data-id', data.id);
            
              console.log(data);
            
          }
        }
      ]
    }, initComplete: function( settings, json ) {
        $('[name=fecha_nacimiento]').datepicker({
            format: 'yyyy-mm-dd', 
            language: 'es-ES',
            endDate: '+0d'
        });
        $('[name=lapso_inscripcion]').datepicker({
            format: 'yyyy-mm', 
            language: 'es-ES',
            defaultViewDate: ["year", "month"],
            endDate: '+0d'
        });
    }
  });
  /* }); */
  
  /** 
  *** Nuevo Atleta
  **/
  
  $("#form-nuevo-atleta [name=foto_carnet]").change(function() {
    PreviewImage(this, '#preview-new-atleta');
  });
  
   var form1 = $('#form-nuevo-atleta');
   form1.validate({
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
            maxlength: 9,
            minlength: 7,
            number: true
          },
          pasaporte: {
            maxlength: 9,
            minlength: 9,
            number: true
          },
          correo: {
            required: true,
            maxlength: 60,
            email: true
          },
          telefono_movil: {
            required: true,
            maxlength: 12,
            minlength: 11,
            number: true
          },
          telefono_casa: {
            required: true,
            maxlength: 12,
            minlength: 11,
            number: true
          },
          lapso_inscripcion: {
            required: true,
            maxlength: 7,
            minlength: 7
          },
          /* twitter: {
            required: true,
          }, */
          fecha_nacimiento: {
            required: true,
          },
          estatura: {
            required: true,
            maxlength: 5
          },
          peso: {
            required: true,
            maxlength: 4
          },
          talla_zapato: {
            required: true,
            maxlength: 2
          },
          talla_short: {
            required: true,
            maxlength: 2
          },
          talla_franela: {
            required: true,
            maxlength: 3
          }
        },
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
          pasaporte: {
            maxlength: "• No debe ser mayor de 9 caracteres.",
            minlength: "• No debe ser menor a 9 caracteres.",
            number: "• Solo números."
          },
          correo: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 60 caracteres.",
            email: "• Este no es un correo electrónico valido."
          },
          telefono_movil: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 11 caracteres.",
            minlength: "• No debe ser menor a 11 caracteres.",
            number: "• Solo números."
          },
          telefono_casa: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 11 caracteres.",
            minlength: "• No debe ser menor a 11 caracteres.",
            number: "• Solo números."
          },
          lapso_inscripcion: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 7 caracteres.",
            minlength: "• No debe ser menor a 7 caracteres.",
          },
          /* twitter: {
            required: "• Porfavor, rellene este campo antes de cotinuar."
          }, */
          fecha_nacimiento: {
            required: "• Porfavor, rellene este campo antes de cotinuar."
          },
          estatura: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 5 caracteres."
          },
          peso: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 4 caracteres."
          },
          talla_zapato: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 2 caracteres."
          },
          talla_short: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe tener más de 2 caracteres."
          },
          talla_franela: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 3 caracteres."
          }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });  
    form1.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        labels: {
          next: "Siguiente",
          previous: "Anterior",
          finish: "Registrar"
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form1.validate().settings.ignore = ":disabled,:hidden";
            return form1.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form1.validate().settings.ignore = ":disabled";
            return form1.valid();
        },
        onFinished: function (event, currentIndex)
        {
          
            // Empieza a validar el formulario
            var $btn = $("a[href='#finish']");
            var $btnOT = $btn.html();
            // var $data = new FormData($('#form-nuevo-atleta')[0]); // $(form1).serialize();

            $.ajax({
              method: "POST",
              dataType: "json",
              data: new FormData($('#form-nuevo-atleta')[0]),
              processData: false,                          // Using FormData, no need to process data.
              contentType:false,
              url: "/atleta",
              beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
              complete: function() { $btn.html($btnOT).attr('disabled', false); },
              success: function() { $('.nuevo-atleta').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); $(form1).trigger('reset'); },
              error: function(data) { 

                $(form1).validate().showErrors(data.responseJSON.errors);
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
  *** Actualizar Atleta
  **/
  
  
  $("#form-actualizar-atleta [name=foto_carnet]").change(function() {
    PreviewImage(this, '#preview-upd-atleta');
    alert('Hola');
  });
  
   var form2 = $('#form-actualizar-atleta');
   form2.validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
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
            maxlength: 9,
            minlength: 7,
            number: true
          },
          pasaporte: {
            maxlength: 9,
            minlength: 9,
            number: true
          },
          correo: {
            required: true,
            maxlength: 60,
            email: true
          },
          telefono_movil: {
            required: true,
            maxlength: 12,
            minlength: 11,
            number: true
          },
          telefono_casa: {
            required: true,
            maxlength: 12,
            minlength: 11,
            number: true
          },
          lapso_inscripcion: {
            required: true,
            maxlength: 7,
            minlength: 7
          },
          /* twitter: {
            required: true,
          }, */
          fecha_nacimiento: {
            required: true,
          },
          estatura: {
            required: true,
            maxlength: 5
          },
          peso: {
            required: true,
            maxlength: 4
          },
          talla_zapato: {
            required: true,
            maxlength: 2
          },
          talla_short: {
            required: true,
            maxlength: 2
          },
          talla_franela: {
            required: true,
            maxlength: 3
          }
        },
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
          pasaporte: {
            maxlength: "• No debe ser mayor de 9 caracteres.",
            minlength: "• No debe ser menor a 9 caracteres.",
            number: "• Solo números."
          },
          correo: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 60 caracteres.",
            email: "• Este no es un correo electrónico valido."
          },
          telefono_movil: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 11 caracteres.",
            minlength: "• No debe ser menor a 11 caracteres.",
            number: "• Solo números."
          },
          telefono_casa: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 11 caracteres.",
            minlength: "• No debe ser menor a 11 caracteres.",
            number: "• Solo números."
          },
          lapso_inscripcion: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 7 caracteres.",
            minlength: "• No debe ser menor a 7 caracteres.",
          },
          /* twitter: {
            required: "• Porfavor, rellene este campo antes de cotinuar."
          }, */
          fecha_nacimiento: {
            required: "• Porfavor, rellene este campo antes de cotinuar."
          },
          estatura: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 5 caracteres."
          },
          peso: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 4 caracteres."
          },
          talla_zapato: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 2 caracteres."
          },
          talla_short: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe tener más de 2 caracteres."
          },
          talla_franela: {
            required: "• Porfavor, rellene este campo antes de cotinuar.",
            maxlength: "• No debe ser mayor de 3 caracteres."
          }
        }
    });  
    form2.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        labels: {
          next: "Siguiente",
          previous: "Anterior",
          finish: "Actualizar"
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form2.validate().settings.ignore = ":disabled,:hidden";
            return form2.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form2.validate().settings.ignore = ":disabled";
            return form2.valid();
        },
        onFinished: function (event, currentIndex)
        {
          
            // Empieza a validar el formulario
            var $btn = $("a[href='#finish']");
            var $btnOT = $btn.html();
            // var $data = $(form2).serialize();

            $.ajax({
              method: "POST",
              dataType: "json",
              data: new FormData($('#form-actualizar-atleta')[0]),
              processData: false,                          // Using FormData, no need to process data.
              contentType:false,
              url: "/atleta/" + data.id,
              beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
              complete: function() { $btn.html($btnOT).attr('disabled', false); },
              success: function() { $('.actualizar-atleta').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); },
              error: function(data) { 

                $(form).validate().showErrors(data.responseJSON.errors);
                ToastErrorAlCargar();

              }
            });
          
        }
    });
  
  /** 
  *** Eliminar Atleta
  **/
  
  $('[data-action=eliminar]').on('click', function(){
    
    // Botones.
    var $btn = $(this);
    var $btnOT = $btn.html();
        
    $.ajax({
      method: "POST",
      dataType: "json",
      data: { id: $btn.attr('data-id'), _method: "DELETE" },
      url: "/atleta/" + $btn.attr('data-id'),
      beforeSend: function() { $btn.html('<span class="fa fa-cog fa-spin"></span>').attr('disabled', true); },
      complete: function() { $btn.html($btnOT).attr('disabled', false); },
      success: function() { $('.eliminar-atleta').modal('hide'); ToastExitoAlCargar(); table.ajax.reload(); data = null; },
      error: function() { ToastErrorAlCargar(); }
    });
    
  });
    
});