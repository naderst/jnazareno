$('#BautizoEstadoNacimiento').change(function(){
	$.ajax({
		url: './ciudades/' + $(this).val(),
		beforeSend: function() {
			$('#BautizoCiudadNacimiento').parent().append('<div id="loading">Cargando ciudades...</div>');
		},
		success: function(html) {
			$('#BautizoCiudadNacimiento').html(html);

			if($('#BautizoEstadoNacimiento').val() == 'Bolívar')
				$('#BautizoCiudadNacimiento').val('Ciudad Guayana');
		},
		error: function() {
			alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
		},
		complete: function() {
			$("#loading").remove();
		}
	});
});