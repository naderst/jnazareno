$('#buscador').submit(function(){
	document.location = baseDir + 'buscador/' + $('#buscar').val().replace(/\s/g, '-');
    return false;
});