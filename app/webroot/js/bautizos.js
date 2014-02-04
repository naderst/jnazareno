$(document).ready(function(){
    $('#datetimepicker1').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#datetimepicker2').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#datetimepicker3').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#BautizoEstadoNacimiento').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading').show();
                    },
                    success: function(html) {
                            $('#BautizoCiudadNacimiento').html(html);

                            if($('#BautizoEstadoNacimiento').val() == 'Bolívar')
                                    $('#BautizoCiudadNacimiento').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading").remove();
                    }
            });
    });

    $('#BautizoPaisNacimiento').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#BautizoEstadoNacimiento2').parent().hide();
                    $('#BautizoCiudadNacimiento2').parent().hide();
                    $('#BautizoEstadoNacimiento').parent().show();
                    $('#BautizoCiudadNacimiento').parent().show();
            } else {
                    $('#BautizoEstadoNacimiento2').parent().show();
                    $('#BautizoCiudadNacimiento2').parent().show();
                    $('#BautizoEstadoNacimiento').parent().hide();
                    $('#BautizoCiudadNacimiento').parent().hide();
            }
    });    

    $('#loading').hide();
    $('#BautizoEstadoNacimiento2').parent().hide();
    $('#BautizoCiudadNacimiento2').parent().hide();

    if($('#BautizoPaisNacimiento').val() != 'Venezuela')
            $('#BautizoPaisNacimiento').trigger('change');
}); 