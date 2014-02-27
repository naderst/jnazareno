<?php
echo '<h2>Bautizos</h2>';
if(!count($bautizos)) {
    echo '<center>No hay bautizos registrados.</center>';
} else {
?>
<table class="tabla">
	<tr>
		<th>Fecha de bautizo</th>
		<th>Nombre</th>
		<th>Fecha de Nac.</th>
		<th>Lugar de Nac.</th>
		<th>Padre</th>
		<th>Madre</th>
		<th>Padrino</th>
		<th>Madrina</th>
		<th>Ministro celebrante</th>
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
		<td><?php echo $e['Bautizo']['fecha']; ?></td>
		<td><?php echo $e['Bautizo']['nombres']; ?> <?php echo $e['Bautizo']['apellidos']; ?></td>
		<td><?php echo $e['Bautizo']['fecha_nacimiento']; ?></td>
		<td><?php echo $e['Bautizo']['ciudad_nacimiento']; ?>, Edo. <?php echo $e['Bautizo']['estado_nacimiento']; ?>. <?php echo $e['Bautizo']['pais_nacimiento']; ?></td>
		<td><?php echo $e['Bautizo']['padre']; ?></td>
		<td><?php echo $e['Bautizo']['madre']; ?></td>
		<td><?php echo $e['Bautizo']['padrino']; ?></td>
		<td><?php echo $e['Bautizo']['madrina']; ?></td>
		<td><?php echo $e['Bautizo']['ministro']; ?></td>
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
<center>
<?php
if(count($bautizos)) {
	echo '<b>'.$this->Paginator->counter(array(
	    'format' => 'Página {:page} de {:pages}, mostrando {:current} bautizo(s) de
	             {:count} totales'
	)).'</b><br><br>';
	echo $this->Paginator->first('<input type="button" value="<<">', array('escape' => false));
	echo $this->Paginator->prev('<input type="button" value="< Anterior">', array('escape' => false), ' ',array()).' ';
	echo $this->Paginator->next('<input type="button" value="Siguiente >">', array('escape' => false), ' ',array());
	echo $this->Paginator->last('<input type="button" value=">>">', array('escape' => false));
}
?>
    <input type="button" value="Nuevo bautizo" onclick="javascript:document.location='<?php echo Router::url('/bautizos/agregar'); ?>';"><br><br>
<?php
echo $this->Paginator->numbers(array('before' => '<b>Ir a la página:</b> '));
?>
</center>