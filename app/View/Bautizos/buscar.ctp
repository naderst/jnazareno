<h2>Bautizos</h2>

<b>Resultado de búsqueda para: </b><?php echo $q; ?><br><br>
<?php
if(!count($bautizos)) {
    echo '<center>No se encontraron bautizos.</center>';
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
		<th width="115">Acción</th>
		<?php } ?>
		<th width="100">Certificado</th>
	</tr>
<?php
foreach($bautizos as $e) {
	foreach($keywords as $k) {
		$k = str_replace('/', '\/', $k);
		preg_match('/' . $k . '/i', $e['Bautizo']['nombres'], $matches);
		$nombres = preg_replace('/' . $k . '/i', '<span style="background-color:yellow">' . @$matches[0] . '</span>', $e['Bautizo']['nombres']);
		preg_match('/' . $k . '/i', $e['Bautizo']['apellidos'], $matches);
		$apellidos = preg_replace('/' . $k . '/i', '<span style="background-color:yellow">' . @$matches[0] . '</span>', $e['Bautizo']['apellidos']);
		preg_match('/' . $k . '/i', $e['Bautizo']['fecha_nacimiento'], $matches);
		$fecha_nacimiento = preg_replace('/' . $k . '/i', '<span style="background-color:yellow">' . @$matches[0] . '</span>', $e['Bautizo']['fecha_nacimiento']);
	}
?>
	<tr>
		<td><?php echo $e['Bautizo']['fecha']; ?></td>
		<td><?php echo $nombres; ?> <?php echo $apellidos; ?></td>
		<td><?php echo $fecha_nacimiento; ?></td>
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
		<td><a href="<?php echo Router::url('/bautizos/certificado/' . $e['Bautizo']['id']); ?>" target="_blank">Generar certificado</a></td>
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
<?php
echo $this->Paginator->numbers(array('before' => '<b>Ir a la página:</b> '));
?>
</center>