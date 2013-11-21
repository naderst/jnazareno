<?php
class BautizosController extends AppController {
    function index() {
        $this->set('bautizos', $this->Bautizo->find('all'));
    }
    
    function agregar() {
    	if(parent::isAdmin()) {
    		$this->Bautizo->validator()
    		->remove('prefectura_municipio')
    		->remove('prefectura_libro')
    		->remove('prefectura_folio')
    		->remove('prefectura_numero');
    	}

    	$this->set('paises', parent::getPaises());
    	$this->set('estados', parent::getEstados());

    	if($this->request->is('post')) {
    		$this->set('ciudades', parent::getCiudades($this->request->data('Bautizo.estado_nacimiento')));
	    	$this->set('estado_selected', $this->request->data('Bautizo.estado_nacimiento'));
	    	$this->set('ciudad_selected', $this->request->data('Bautizo.ciudad_nacimiento'));
	    	$this->set('sexo_selected', $this->request->data('Bautizo.sexo'));

	    	if($this->Bautizo->save($this->request->data)) {
	    		$this->Session->setFlash('Bautizo agregado con éxito', 'default', array(), 'good');
	    		$this->redirect(array('action' => 'index'));
	    	} else {
	    		$this->Session->setFlash('Ha ocurrido un error agregando el bautizo', 'default', array(), 'bad');
	    	}
    
    	} else {
    		$this->set('ciudades', parent::getCiudades('Bolívar'));
    		$this->set('estado_selected', 'Bolívar');
    		$this->set('ciudad_selected', 'Ciudad Guayana');
    		$this->set('sexo_selected', 'M');
    	}
    }

    function modificar($id = null) {
        if(parent::isAdmin()) {
            $this->Bautizo->validator()
            ->remove('prefectura_municipio')
            ->remove('prefectura_libro')
            ->remove('prefectura_folio')
            ->remove('prefectura_numero');
        } else {
            throw new NotFoundException('La página no existe');
        }

        $this->Bautizo->id = $id;

    	if($this->request->is('put')) {
            if($this->Bautizo->save($this->request->data)) {
                $this->Session->setFlash('Se ha modificado el bautizo con éxito', 'default', array(), 'good');
            } else {
                $this->Session->setFlash('Ha ocurrido un error modificando el bautizo', 'default', array(), 'bad');
            }
    	}

    	$this->request->data = $this->Bautizo->read();
        $this->set('paises', parent::getPaises());
        $this->set('estados', parent::getEstados());
        $this->set('ciudades', parent::getCiudades($this->request->data('Bautizo.estado_nacimiento')));
        $this->set('estado_selected', $this->request->data('Bautizo.estado_nacimiento'));
        $this->set('ciudad_selected', $this->request->data('Bautizo.ciudad_nacimiento'));
        $this->set('sexo_selected', $this->request->data('Bautizo.sexo'));

    	$this->render('agregar');
    }

    function eliminar($id = null) {
    	if(parent::isAdmin() && $id != null) {
    		$this->Bautizo->delete($id);
	        $this->Session->setFlash('Bautizo eliminado con éxito', 'default', array(), 'good');
	        $this->redirect(array('action' => 'index'));
    	} else {
    		throw new NotFoundException('La página no existe');
    	}
    }

    function ciudades($estado) {
        $this->layout = 'ajax';

        $ciudades = parent::getRawEstados();
        $this->set('ciudades', $ciudades[$estado]);
    }
}
?>