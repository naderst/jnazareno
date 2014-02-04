<h2>Matrimonios</h2>
<?php
if (!count($matrimonios)) {
    echo '<center>No hay matrimonios registrados.</center>';
} else {
    ?>
    Aquí se listan los matrimonios
<?php } ?>
<br>
<center>
    <input type="button" value="Nuevo matrimonio" onclick="javascript:document.location = '<?php echo Router::url('/matrimonios/agregar'); ?>';"><br><br>
</center>