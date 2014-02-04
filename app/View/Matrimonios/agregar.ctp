<h2>Nuevo matrimonio</h2>
<?php
echo $this->Form->create('Matrimonio', array(
    'inputDefaults' => array(
        'between' => '<br>',
        'type' => 'text'
    )
));
?>

<table class="tform">
    <tr>
        <td colspan="2"><h3>Datos del novio</h3></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('nombres_novio', array('label' => 'Nombres')); ?></td>
        <td><?php echo $this->Form->input('apellidos_novio', array('label' => 'Apellidos')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('cedula_novio', array('label' => 'Cédula')); ?></td>
        <td><?php echo $this->Form->input('fecha_nacimiento_novio', array('label' => 'Fecha de nacimiento', 'type' => 'text', 'id' => 'datetimepicker')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('estado_civil_novio', array('label' => 'Estado civil', 'type' => 'select', 'options' => array(1,2,3))); ?></td>
        <td>EMPTY</td>
    </tr>
</table>

<?php
if ($this->action == 'modificar') {
    $submit = 'Guardar';
} else {
    $submit = 'Agregar';
}
?>
<center><input type="button" value="Cancelar" onclick="document.location='<?php echo Router::url('/matrimonios'); ?>';"><input type="submit" value="<?php echo $submit; ?>"></center>
</form>