function cedula(e) {
    if($.trim(e.value) == '')
        e.value = 'V-';
}
    
function nocedula(e) {
    if($.trim(e.value) == 'V-')
            e.value = '';
}

$('#buscador').submit(function(){
    alert($('#buscar').val());
    return false;
});