
// VISTA PREVIA DE IMAGENES
function PreviewImage(input, selector_preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(selector_preview).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(document).ready(function () {

    /** 
    *** Tabla de Atleta(s)
    **/
    $('table').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
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
            url: "/dist/datatable/language/Spanish.json"
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
                    // Ver más
                    text: '<i class="fa fa-eye" title="Ver Más"></i> Ver más',
                    action: function () {

                        if (!data) {
                          ToasSeleccionePrimero();
                          return;
                        }
                        
                          $('.ver-atleta').modal();

                          var form3 = $('#form-ver-atleta');
                          form3.children("div").steps("setStep", 0);
                          form3.children("div").steps('reset');

                          $.each(data, function(name, value){ 
                            $('.ver-atleta [name=' + name + ']').val(value);                
                          });

                          $('#preview-ver-atleta').attr('src',data.foto_carnet);
                    }

                }
            ]
        }, initComplete: function (settings, json) {
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

    var form = $('#form-ver-atleta');
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        enableFinishButton: false,
        labels: {
            next: "Siguiente",
            previous: "Anterior"
        }
    });
    
    // Cuando se cierra la modal, se empeiza desde el inicio.
    $(".modal").on('hidden.bs.modal', function () {
        
        // Me aseguro de reestablecer los pasos hacia el inicio. Esto solo controlará las clases del 'wizard'.
        $('form .steps ul li').removeClass('error');
        $('form .steps ul li').removeClass('done');
        $('form .steps ul li:not(.first)').each(function(){
            $(this).addClass('disabled');
        });
    });

});