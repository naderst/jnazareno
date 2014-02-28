<?php
App::import('Vendor', 'MPDF57/mpdf');
#require_once(APP . 'Vendor' . DS . 'MPDF57' . DS . 'mpdf.php');

class BautizosController extends AppController {
    public $components = array('Paginator');
    public $helpers = array('Paginator');
    public $paginate = array(
        'limit' => 5,
        'order' => array('Bautizo.id' => 'DESC')
    );

    function index() {
        $this->Paginator->settings = $this->paginate;
        $this->set('bautizos', $this->Paginator->paginate('Bautizo'));
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
            $this->set('pais_selected', $this->request->data('Bautizo.pais_nacimiento'));

            if($this->request->data('Bautizo.pais_nacimiento') != 'Venezuela') {
                $this->request->data['Bautizo']['estado_nacimiento'] = $this->request->data['Bautizo']['estado_nacimiento_2'];
                $this->request->data['Bautizo']['ciudad_nacimiento'] = $this->request->data['Bautizo']['ciudad_nacimiento_2'];
            }

            $existeBautizo = $this->Bautizo->find('first', array(
                'conditions' => array(
                    'Bautizo.libro' => $this->request->data('Bautizo.libro'),
                    'Bautizo.folio' => $this->request->data('Bautizo.folio'),
                    'Bautizo.numero' => $this->request->data('Bautizo.numero')
                )
            ));

            $this->request->data['Bautizo']['fecha'] = date('d/m/Y',strtotime($this->request->data('Bautizo.fecha')));

            if($existeBautizo) {
                $this->Session->setFlash('Ya existe un bautizo con el mismo Libro, Folio y número', 'default', array(), 'bad');
	    	} elseif($this->Bautizo->save($this->request->data)) {
	    		$this->Session->setFlash('Bautizo agregado con éxito', 'default', array(), 'good');
	    		$this->redirect(array('action' => 'index'));
	    	} else {
	    		$this->Session->setFlash('Ha ocurrido un error agregando el bautizo', 'default', array(), 'bad');
	    	}
    
    	} else {
    		$this->set('ciudades', parent::getCiudades());
    		$this->set('estado_selected', parent::getEstado());
    		$this->set('ciudad_selected', parent::getCiudad());
            $this->set('sexo_selected', 'M');
    		$this->set('pais_selected', 'Venezuela');
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
            if($this->request->data('Bautizo.pais_nacimiento') != 'Venezuela') {
                $this->request->data['Bautizo']['estado_nacimiento'] = $this->request->data['Bautizo']['estado_nacimiento_2'];
                $this->request->data['Bautizo']['ciudad_nacimiento'] = $this->request->data['Bautizo']['ciudad_nacimiento_2'];
            }

            $existeBautizo = $this->Bautizo->find('first', array(
                'conditions' => array(
                    'Bautizo.libro' => $this->request->data('Bautizo.libro'),
                    'Bautizo.folio' => $this->request->data('Bautizo.folio'),
                    'Bautizo.numero' => $this->request->data('Bautizo.numero')
                )
            ));

            if($existeBautizo && $existeBautizo['Bautizo']['id'] != $id)
                $this->Session->setFlash('Ya existe un bautizo con el mismo Libro, Folio y número', 'default', array(), 'bad');
            elseif($this->Bautizo->save($this->request->data)) {
                $this->Session->setFlash('Se ha modificado el bautizo con éxito', 'default', array(), 'good');
            } else {
                $this->Session->setFlash('Ha ocurrido un error modificando el bautizo', 'default', array(), 'bad');
            }
    	}

    	$this->request->data = $this->Bautizo->read();
        $this->set('paises', parent::getPaises());
        $this->set('estados', parent::getEstados());

        if($this->request->data('Bautizo.pais_nacimiento') != 'Venezuela') {
            $this->request->data['Bautizo']['estado_nacimiento_2'] = $this->request->data['Bautizo']['estado_nacimiento'];
            $this->request->data['Bautizo']['ciudad_nacimiento_2'] = $this->request->data['Bautizo']['ciudad_nacimiento'];
            $this->set('ciudades', parent::getCiudades());
            $this->set('estado_selected', parent::getEstado());
            $this->set('ciudad_selected', parent::getCiudad());
        } else {
            $this->set('ciudades', parent::getCiudades($this->request->data('Bautizo.estado_nacimiento')));
            $this->set('estado_selected', $this->request->data('Bautizo.estado_nacimiento'));
            $this->set('ciudad_selected', $this->request->data('Bautizo.ciudad_nacimiento'));
        }

        $this->set('pais_selected', $this->request->data('Bautizo.pais_nacimiento'));
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

    function certificado($id) {
        Configure::write('debug',0);
        $this->layout = 'pdf';
        $mpdf = new mPDF();
        $mpdf->WriteHTML('<p>Your first taste of creating PDF from HTML</p>', 2);
        $mpdf->Output();
    }
}
?>