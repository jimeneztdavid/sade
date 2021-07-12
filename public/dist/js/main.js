      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // Mostrar el toast de éxito.
      function ToastExitoAlCargar () {
             $.toast({
                  heading: 'Enhorabuena!'
                  , text: 'Su solicitud se ha procesado de manera exitosa.'
                  , position: 'top-right'
                  , loaderBg: '#ff6849'
                  , icon: 'success'
                  , hideAfter: 3500
                  , stack: 6
              });
      }
      // Mostrar el toast de fallido.
      function ToastErrorAlCargar () {
             $.toast({
                  heading: 'Ha ocurrido un error!'
                  , text: 'No se ha podido procesar su solicitud de manera exitosa.'
                  , position: 'top-right'
                  , loaderBg: '#ff6849'
                  , icon: 'error'
                  , hideAfter: 3500
                  , stack: 6
              });
      }
      // Mostrar el toast de seleccionar uno primero.
      function ToasSeleccionePrimero () {
             $.toast({
                  heading: 'Ha ocurrido un error!'
                  , text: 'Debe seleccionar un registro primero.'
                  , position: 'top-right'
                  , loaderBg: '#ff6849'
                  , icon: 'info'
                  , hideAfter: 3500
                  , stack: 6
              });
      }
      var data = null;

      // Metodos propios de jQuery Validation
      $.validator.addMethod("contrasena", function(value, element) {
        return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@$!()%*?&.,\/\[\]\{\]\=}])([A-Za-z\d#$@$!()%*?&.,\/\[\]\{\]\=]|[^ ]){8,15}$/.test(value);
      }, "• No cumple con los requisitos de la contraseña.");


      $(".modal").on('hidden.bs.modal', function () {
        $('form').trigger('reset');
        $('form label.error').remove();
        $('form input.error').removeClass('error');
      });

$.ajaxSetup({
  error: function( jqXHR, textStatus, errorThrown ) {

          console.log(jqXHR + " // " + textStatus + " // " + errorThrown); 
          
          if (jqXHR.status === 0) {

             $.toast({
                  heading: 'Ha ocurrido un error!'
                  , text: 'No se ha podido conectar al servidor, revise su conexión a internet o al servidor..'
                  , position: 'top-left'
                  , loaderBg: '#ff6849'
                  , icon: 'info'
                  , hideAfter: 3500
                  , stack: 6
              });

          } else if (jqXHR.status == 404) {

            $.toast({
              heading: 'Ha ocurrido un error!'
              , text: 'No se ha encontrado el registroque se solictó..'
              , position: 'top-left'
              , loaderBg: '#ff6849'
              , icon: 'info'
              , hideAfter: 3500
              , stack: 6
          });

          } else if (jqXHR.status == 422) {

            /* $.toast({
              heading: 'Ha ocurrido un error!'
              , text: 'Error: ' + jqXHR.message
              , position: 'top-left'
              , loaderBg: '#ff6849'
              , icon: 'info'
              , hideAfter: 3500
              , stack: 6
          }); */

          alert('Error 422');

          } else if (jqXHR.status == 500) {

            $.toast({
              heading: 'Ha ocurrido un error!'
              , text: 'Ha ocurrido un eror interno del servidor..'
              , position: 'top-left'
              , loaderBg: '#ff6849'
              , icon: 'info'
              , hideAfter: 3500
              , stack: 6
          });

          } else if (textStatus === 'parsererror') {

            $.toast({
              heading: 'Ha ocurrido un error!'
              , text: 'Ha ocurrido un error interno al solicitar los datos JSON..'
              , position: 'top-left'
              , loaderBg: '#ff6849'
              , icon: 'info'
              , hideAfter: 3500
              , stack: 6
          });

          } else if (textStatus === 'timeout') {

            $.toast({
              heading: 'Ha ocurrido un error!'
              , text: 'Ha caducado el tiempo de solicitud presione F5 y vuelva a intentarlo..'
              , position: 'top-left'
              , loaderBg: '#ff6849'
              , icon: 'info'
              , hideAfter: 3500
              , stack: 6
          });

          } else if (textStatus === 'abort') {

            $.toast({
              heading: 'Ha ocurrido un error!'
              , text: 'Solicitud abortada..'
              , position: 'top-left'
              , loaderBg: '#ff6849'
              , icon: 'info'
              , hideAfter: 3500
              , stack: 6
          });

          } else {

            $.toast({
              heading: 'Ha ocurrido un error!'
              , text: jqXHR.responseText + 'Ha ocurrido un error interno al solicitar los datos JSON..'
              , position: 'top-left'
              , loaderBg: '#ff6849'
              , icon: 'info'
              , hideAfter: 3500
              , stack: 6
          });

          console.log(jqXHR.responseText);

          }

        }
});