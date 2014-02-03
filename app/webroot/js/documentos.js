$(document).ready(function() {
	$('input.dname').hide();
	$('span.loading').hide();

	$('.delete').click(function() {
		var f = $(this).siblings()[0];

		f = $('#ad-' + $(f).attr('data-id')).html();

		if(confirm('¿Está seguro que desea borrar el archivo "' + f + '"?')) {
			document.location = baseDir + '/documentos/eliminar/' + f;
		}
	});

	$('.rename').click(function() {
		var input = '#id-' + $(this).attr('data-id');
		var a = '#ad-' + $(this).attr('data-id');

		$(a).hide();
		$(input).show();
		$(input).focus();
	});

	$('input.dname').blur(function() {
		var input = this;
		var a = $(this).siblings()[0];
		var span = $(this).siblings()[1];

		if($(input).val() != $(a).html()) {
			$.ajax({
				url: baseDir + '/documentos/rename',
				type: 'POST',
				data: { old: $(a).html(), new: $(input).val() },
				beforeSend: function() {
					$(input).hide();
					$(span).show();
				},
				success: function(html) {
					$(a).html(html);
					$(a).attr('href', baseDir + 'documents/' + html);
				},
				error: function() {
					alert('Ocurrió un error inesperado renombrando el archivo, por favor vuelva a intentarlo');
				},
				complete: function() {
					$(input).hide();
					$(span).hide();
					$(a).show();
				}
			});
		} else {
			$(input).hide();
			$(a).show();
		}
	});

	$('input.dname').keydown(function(event) {
		if(event.which == 13)
			$(this).trigger('blur');
	});
});