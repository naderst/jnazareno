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
        <td colspan="2"><h4>Información personal</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('nombres_novio', array('label' => 'Nombres')); ?></td>
        <td><?php echo $this->Form->input('apellidos_novio', array('label' => 'Apellidos')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('cedula_novio', array('label' => 'Cédula')); ?></td>
        <td><?php echo $this->Form->input('estado_civil_novio', array('label' => 'Estado civil', 'type' => 'select', 'options' => array('Soltero' => 'Soltero', 'Divorciado' => 'Divorciado', 'Viudo' => 'Viudo'))); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('padre_novio', array('label' => 'Nombre completo del padre')); ?></td>
        <td><?php echo $this->Form->input('madre_novio', array('label' => 'Nombre completo de la madre')); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de nacimiento</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('fecha_nacimiento_novio', array('label' => 'Fecha de nacimiento', 'type' => 'text', 'id' => 'datetimepicker')); ?></td>
        <td><?php echo $this->Form->input('pais_nacimiento_novio', array('label' => 'País de nacimiento', 'type' => 'select', 'options' => $paises, 'selected' => $pais_selected)); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('estado_nacimiento_novio', array('label' => 'Estado de nacimiento', 'type' => 'select', 'options' => $estados, 'selected' => $estado_selected)); ?><?php echo $this->Form->input('estado_nacimiento_novio_2', array('label' => 'Estado de nacimiento')); ?></td>
        <td><?php echo $this->Form->input('ciudad_nacimiento_novio', array('label' => 'Ciudad de nacimiento', 'type' => 'select', 'options' => $ciudades, 'selected' => $ciudad_selected)); ?><?php echo $this->Form->input('ciudad_nacimiento_novio_2', array('label' => 'Ciudad de nacimiento')); ?><div id="loading">Cargando ciudades...</div></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de ubicación actual</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('pais_actual_novio', array('label' => 'País actual', 'type' => 'select', 'options' => $paises, 'selected' => $pais_actual_selected)); ?></td>
        <td><?php echo $this->Form->input('estado_actual_novio', array('label' => 'Estado actual', 'type' => 'select', 'options' => $estados, 'selected' => $estado_actual_selected)); ?><?php echo $this->Form->input('estado_actual_novio_2', array('label' => 'Estado actual')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('ciudad_actual_novio', array('label' => 'Ciudad actual', 'type' => 'select', 'options' => $ciudades_actual, 'selected' => $ciudad_actual_selected)); ?><?php echo $this->Form->input('ciudad_actual_novio_2', array('label' => 'Ciudad actual')); ?><div id="loading_actual">Cargando ciudades...</div></td>
        <td><?php echo $this->Form->input('telefono_novio', array('label' => 'Teléfono')); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de testigo</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('cedula_testigo_novio', array('label' => 'Cédula')); ?></td>
        <td><?php echo $this->Form->input('nombre_testigo_novio', array('label' => 'Nombre')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('direccion_testigo_novio', array('label' => 'Dirección')); ?></td>
        <td></td>
    </tr>
</table>
<?php
if ($this->action == 'modificar') {
    $submit = 'Guardar';
} else {
    $submit = 'Agregar';
}
?>
<br>
<center><input type="button" value="Cancelar" onclick="document.location='<?php echo Router::url('/matrimonios'); ?>';"><input type="submit" value="<?php echo $submit; ?>"></center>
</form>