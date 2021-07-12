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
      url: '/bitacora',
      type: 'GET',
       dataSrc: ""
      },
    columns: [
      { data: 'email' },
      { data: 'accion' },
      { data: 'modulo' },
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
          text: '<i class="fa fa-eye" title="Ver Registro"></i> Ver Registro',
          className: "",
          action: function(){
            
              if (!data) {
                ToasSeleccionePrimero();
                return;
              }
            
              $.each(data, function(name, value){ 
                // cambios los valroes de los input.
                $('.ver-bitacora [name=' + name + ']') .val(value) .closest('.form-group') .addClass('bmd-form-group is-filled'); 
              });
              $('.ver-bitacora').modal();
              
          },
          init: function(api, node, config) {
             $(node).removeClass('btn-default');
          }
        }
      ]
    }
  });
  
  /** 
  *** Ver Registro
  **/
    
});