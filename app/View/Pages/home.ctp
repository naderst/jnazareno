<h2>Estadísticas de bautizos</h2>
<b>Cantidad total de bautizos en el sistema: </b><?php echo $bautizos; ?><br><br>
<center>
	<img src="<?php echo Router::url('/graficos/bautizosedades'); ?>">
	<img src="<?php echo Router::url('/graficos/bautizossexo'); ?>">
</center>