<?php
class BautizosController extends AppController {
    function index() {
        $this->set('bautizos', $this->Bautizo->find('all'));
    }
    
    function agregar() {
    	$this->set('paises', parent::getPaises());
    	$this->set('estados', parent::getEstados());

    	if($this->request->is('post')) {
    		$this->loadModel('Persona');
    		$this->set('ciudades', parent::getCiudades($this->request->data('Persona.estado_nacimiento')));
	    	$this->set('estado_selected', $this->request->data('Persona.estado_nacimiento'));
	    	$this->set('ciudad_selected', $this->request->data('Persona.ciudad_nacimiento'));

    		if($this->Persona->save($this->request->data)) {
    			// Persona guardada, ahora se procede a guardar el bautizo
    			// asociado a dicha persona.
    			/*if($this->Bautizo->save($this->request->data)) {

    			}*/
    		}
    		//print_r($this->request->data);
    	} else {
    		$this->set('ciudades', parent::getCiudades('Bolívar'));
    		$this->set('estado_selected', 'Bolívar');
    		$this->set('ciudad_selected', 'Ciudad Guayana');
    	}
    }
}
?>