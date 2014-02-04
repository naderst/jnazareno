<?php
	if($rol == 'A') { 
?>
<h2>Subir documento</h2>
<form name="uploadDocument" id="uploadDocument" enctype="multipart/form-data" action="<?php echo Router::url('/documentos/subir'); ?>" method="POST">
	<input type="file" name="documento" id="fdocumento">
	<input type="submit" value="Subir documento">
</form>
<?php } ?>
<h2>Documentos</h2>

<?php
	if(!count($files)) {
?>
<center>No hay ningún archivo</center>
<?php } else { ?>
Para descargar los documentos debe hacer click en el nombre del mismo.<br><br>
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
			<?php echo '<a href="'.Router::url('/documents/'.$f).'" id="ad-'.$i.'" target="_blank">'.$f.'</a>'; ?>
			<?php echo '<input type="text" class="dname" id="id-'.$i.'" value="'.$f.'">'; ?>
			<span class="loading">Cargando...</span>
		</td>
		<?php
			if($rol == 'A') {
		?>
		<td width="240"><a href="javascript:void(0);" class="rename" data-id="<?php echo $i; ?>"><i class="fa fa-edit"></i> Cambiar nombre</a> / <a href="javascript:void(0);" alt="Eliminar" class="delete"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
	</tr>
	<?php ++$i; } ?>
</table>

<?php } ?>