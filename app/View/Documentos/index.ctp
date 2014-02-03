<h2>Documentos</h2>

<table>
	<tr>
		<th>Documento</th>
		<?php
			if($rol == 'A') {
		?>
		<th>Acción</th>
		<?php } ?>
	</tr>
	<?php
		$i = 1;
		foreach($files as $f) {
	?>
	<tr>
		<td>
			<?php echo '<a href="'.Router::url('/documents/'.$f).'" id="ad-'.$i.'">'.$f.'</a>'; ?>
			<?php echo '<input type="text" class="dname" id="id-'.$i.'" value="'.$f.'">'; ?>
			<span class="loading">Cargando...</span>
		</td>
		<?php
			if($rol == 'A') {
		?>
		<td><a href="javascript:void(0);" class="rename" data-id="<?php echo $i; ?>"><i class="fa fa-edit"></i> Cambiar nombre</a> / <a href="javascript:void(0);" alt="Eliminar" class="delete"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
	</tr>
	<?php ++$i; } ?>
</table>