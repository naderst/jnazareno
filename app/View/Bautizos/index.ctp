<?php
if(!count($bautizos)) {
    echo '<h2>Bautizos</h2>';
    echo '<center>No hay bautizos registrados.</center>';
} else {
    
}
?>
<br>
<center><input type="button" value="Nuevo bautizo" onclick="javascript:document.location='<?php echo Router::url('/bautizos/agregar'); ?>';"></center>