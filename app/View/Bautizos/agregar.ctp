<h2>Nuevo bautizo</h2>
<?php
echo $this->Form->create('Bautizo', array(
    'inputDefaults' => array(
        'between' => '<br>',
        'type' => 'text'
    )
));
?>
<table class="tform">
    <tr>
        <td colspan="2"><h3>Datos personales</h3></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('Persona.nombres'); ?></td>
        <td><?php echo $this->Form->input('Persona.apellidos'); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('Persona.cedula', array('label' => 'Cédula (Ej: V-12345678)')); ?></td>
        <td><?php echo $this->Form->input('Persona.fecha_nacimiento', array('type' => 'date', 'dateFormat' => 'DMY', 'minYear' => '1940', 'maxYear' => date('Y', time()), 'label' => 'Fecha de nacimiento', 'style' => 'width:30%;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('Persona.pais_nacimiento', array('label' => 'País de nacimiento', 'type' => 'select', 'options' => $paises, 'selected' => 'Venezuela')); ?></td>
        <td><?php echo $this->Form->input('Persona.estado_nacimiento', array('label' => 'Estado de nacimiento', 'type' => 'select', 'options' => $estados, 'selected' => $estado_selected)); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('Persona.ciudad_nacimiento', array('label' => 'Ciudad de nacimiento', 'type' => 'select', 'options' => $ciudades, 'selected' => $ciudad_selected)); ?></td>
        <td><?php echo $this->Form->input('Persona.direccion', array('label' => 'Direccón actual')); ?></td>
    </tr>
    <tr>
        <td>Ciudad</td>
        <td>Estado</td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('Persona.padre'); ?></td>
        <td><?php echo $this->Form->input('Persona.madre'); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Datos del bautizo</h3></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('libro'); ?></td>
        <td><?php echo $this->Form->input('folio'); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('numero', array('label' => 'Número')); ?></td>
        <td><?php echo $this->Form->input('fecha', array('type' => 'date', 'dateFormat' => 'DMY', 'label' => 'Fecha del bautizo', 'maxYear' => date('Y', time()), 'style' => 'width:30%')); ?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('padrino'); ?></td>
      <td><?php echo $this->Form->input('madrina'); ?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('ministro'); ?></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="2"><h3>Datos de la prefectura</h3></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('prefectura_municipio', array('label' => 'Municipio')); ?></td>
      <td><?php echo $this->Form->input('prefectura_fecha', array('label' => 'Fecha', 'type' => 'date', 'style' => 'width:30%', 'dateFormat' => 'DMY', 'maxYear' => date('Y', time()))); ?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('prefectura_numero', array('label' => 'Número')); ?></td>
      <td><?php echo $this->Form->input('prefectura_folio', array('label' => 'Folio')); ?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('prefectura_libro', array('label' => 'Libro')); ?></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="2"><h3>Nota marginal</h3></td>
    </tr>   
    <tr>
      <td colspan="2"><?php echo $this->Form->input('nota_marginal', array('type' => 'textarea', 'style' => 'width:100%')); ?></td>
    </tr>
</table><br>
    <center><input type="button" value="Cancelar" onclick="document.location='<?php echo Router::url('/bautizos'); ?>';"><input type="submit" value="Agregar"></center>
</form>