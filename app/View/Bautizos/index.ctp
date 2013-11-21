<?php
echo '<h2>Bautizos</h2>';
if(!count($bautizos)) {
    echo '<center>No hay bautizos registrados.</center>';
} else {
?>
<table>
	<tr>
		<th>Nombre</th>
		<th>Fecha de Nac.</th>
		<th>Ciudad de Nac.</th>
		<th>Padre</th>
		<th>Madre</th>
		<th>Padrino</th>
		<th>Madrina</th>
		<th>Libro</th>
		<th>Folio</th>
		<th>Número</th>
		<?php
		if ($rol == 'A') {
		?>
		<th width="180">Acción</th>
		<?php } ?>
	</tr>
<?php
foreach($bautizos as $e) {
?>
	<tr>
		<td><?php echo $e['Bautizo']['nombres']; ?> <?php echo $e['Bautizo']['apellidos']; ?></td>
		<td><?php echo date('d/m/Y', strtotime($e['Bautizo']['fecha_nacimiento'])); ?></td>
		<td><?php echo $e['Bautizo']['ciudad_nacimiento']; ?></td>
		<td><?php echo $e['Bautizo']['padre']; ?></td>
		<td><?php echo $e['Bautizo']['madre']; ?></td>
		<td><?php echo $e['Bautizo']['padrino']; ?></td>
		<td><?php echo $e['Bautizo']['madrina']; ?></td>
		<td><?php echo $e['Bautizo']['libro']; ?></td>
		<td><?php echo $e['Bautizo']['folio']; ?></td>
		<td><?php echo $e['Bautizo']['numero']; ?></td>
		<?php
		if($rol == 'A') {
		?>
		<td><a href="<?php echo Router::url(array('action' => 'modificar', $e['Bautizo']['id'])); ?>"><i class="fa fa-edit"></i> Modificar</a> / <a href="<?php echo Router::url(array('action' => 'eliminar', $e['Bautizo']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar el bautizo de <?php echo $e['Bautizo']['nombres'].' '.$e['Bautizo']['apellidos'];?>?');" alt="Eliminar"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
	</tr>
<?php } ?>
</table>
<?php } ?>
<br>
<center><input type="button" value="Nuevo bautizo" onclick="javascript:document.location='<?php echo Router::url('/bautizos/agregar'); ?>';"></center>