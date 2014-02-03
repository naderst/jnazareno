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
		foreach($files as $f) {
	?>
	<tr>
		<td><?php echo '<a href="'.Router::url('/documents/'.$f).'">'.$f.'</a>'; ?></td>
		<?php
			if($rol == 'A') {
		?>
		<td><a href="javascript:void(0);" class="rename"><i class="fa fa-edit"></i> Cambiar nombre</a> / <a href="<?php echo Router::url('/documentos/eliminar/'.$f); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar el archivo <?php echo $f; ?>?');" alt="Eliminar"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
	</tr>
	<?php } ?>
</table>