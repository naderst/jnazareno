$(document).ready(function() {
    $('#datetimepicker').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#MatrimonioEstadoNacimientoNovio').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading').show();
                    },
                    success: function(html) {
                            $('#MatrimonioCiudadNacimientoNovio').html(html);

                            if($('#MatrimonioEstadoNacimientoNovio').val() == 'Bolívar')
                                    $('#MatrimonioCiudadNacimientoNovio').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading").hide();
                    }
            });
    });
    
    $('#MatrimonioEstadoActualNovio').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading_actual').show();
                    },
                    success: function(html) {
                            $('#MatrimonioCiudadActualNovio').html(html);

                            if($('#MatrimonioEstadoActualNovio').val() == 'Bolívar')
                                    $('#MatrimonioCiudadActualNovio').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading_actual").hide();
                    }
            });
    });

    $('#MatrimonioPaisNacimientoNovio').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#MatrimonioEstadoNacimientoNovio2').parent().hide();
                    $('#MatrimonioCiudadNacimientoNovio2').parent().hide();
                    $('#MatrimonioEstadoNacimientoNovio').parent().show();
                    $('#MatrimonioCiudadNacimientoNovio').parent().show();
            } else {
                    $('#MatrimonioEstadoNacimientoNovio2').parent().show();
                    $('#MatrimonioCiudadNacimientoNovio2').parent().show();
                    $('#MatrimonioEstadoNacimientoNovio').parent().hide();
                    $('#MatrimonioCiudadNacimientoNovio').parent().hide();
            }
    });    
    
    $('#MatrimonioPaisActualNovio').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#MatrimonioEstadoActualNovio2').parent().hide();
                    $('#MatrimonioCiudadActualNovio2').parent().hide();
                    $('#MatrimonioEstadoActualNovio').parent().show();
                    $('#MatrimonioCiudadActualNovio').parent().show();
            } else {
                    $('#MatrimonioEstadoActualNovio2').parent().show();
                    $('#MatrimonioCiudadActualNovio2').parent().show();
                    $('#MatrimonioEstadoActualNovio').parent().hide();
                    $('#MatrimonioCiudadActualNovio').parent().hide();
            }
    });    

    $('#loading').hide();
    $('#MatrimonioEstadoNacimientoNovio2').parent().hide();
    $('#MatrimonioCiudadNacimientoNovio2').parent().hide();
    
    $('#loading_actual').hide();
    $('#MatrimonioEstadoActualNovio2').parent().hide();
    $('#MatrimonioCiudadActualNovio2').parent().hide();

    if($('#MatrimonioPaisNacimientoNovio').val() != 'Venezuela')
            $('#MatrimonioPaisNacimientoNovio').trigger('change');
        
    if($('#MatrimonioPaisActualNovio').val() != 'Venezuela')
            $('#MatrimonioPaisActualNovio').trigger('change');
});