$(document).ready(function() {
    $('#buscador').submit(function(){
            document.location = baseDir + 'buscador/' + $('#buscar').val().replace(/\s/g, '-');
        return false;
    });

    $('.cancel').click(function() {
        if(confirm('¿Está seguro que desea cancelar la operación?')) {
            document.location = $(this).attr('data-location');
        }
    });
});