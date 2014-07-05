<?php
class MatrimoniosController extends AppController {
    public $components = array('Paginator');
    public $helpers = array('Paginator');
    public $paginate = array(
        'limit' => 5,
        'order' => array('Matrimonio.id' => 'DESC')
    );

    function index() {
        $this->Paginator->settings = $this->paginate;
        $this->set('matrimonios', $this->Paginator->paginate('Matrimonio'));
    }

    function agregar() {
        $this->set('paises', parent::getPaises());
        $this->set('estados', parent::getEstados());

        if($this->request->is('post')) {
            $this->set('ciudades', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novio')));
            $this->set('estado_selected', $this->request->data('Matrimonio.estado_nacimiento_novio'));
            $this->set('ciudad_selected', $this->request->data('Matrimonio.ciudad_nacimiento_novio'));
            $this->set('pais_selected', $this->request->data('Matrimonio.pais_nacimiento_novio'));
            $this->set('ciudades_actual', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novio')));
            $this->set('estado_actual_selected', $this->request->data('Matrimonio.estado_actual_novio'));
            $this->set('ciudad_actual_selected', $this->request->data('Matrimonio.ciudad_actual_novio'));
            $this->set('pais_actual_selected', $this->request->data('Matrimonio.pais_actual_novio'));
            
            $this->set('ciudades_novia', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novia')));
            $this->set('estado_selected_novia', $this->request->data('Matrimonio.estado_nacimiento_novia'));
            $this->set('ciudad_selected_novia', $this->request->data('Matrimonio.ciudad_nacimiento_novia'));
            $this->set('pais_selected_novia', $this->request->data('Matrimonio.pais_nacimiento_novia'));
            $this->set('ciudades_actual_novia', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novia')));
            $this->set('estado_actual_selected_novia', $this->request->data('Matrimonio.estado_actual_novia'));
            $this->set('ciudad_actual_selected_novia', $this->request->data('Matrimonio.ciudad_actual_novia'));
            $this->set('pais_actual_selected_novia', $this->request->data('Matrimonio.pais_actual_novia'));


            if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novio'] = $this->request->data['Matrimonio']['estado_nacimiento_novio_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novio'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'];
            }
            
             if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novio'] = $this->request->data['Matrimonio']['estado_actual_novio_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novio'] = $this->request->data['Matrimonio']['ciudad_actual_novio_2'];
            }
            
            if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novia'] = $this->request->data['Matrimonio']['estado_nacimiento_novia_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novia'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'];
            }
            
            if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novia'] = $this->request->data['Matrimonio']['estado_actual_novia_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novia'] = $this->request->data['Matrimonio']['ciudad_actual_novia_2'];
            }
            
            if($this->Matrimonio->save($this->request->data)) {
	    		$this->Session->setFlash('Matrimonio agregado con éxito', 'default', array(), 'good');
	    		$this->redirect(array('action' => 'index'));
	    	} else {
	    		$this->Session->setFlash('Ha ocurrido un error agregando el matrimonio', 'default', array(), 'bad');
	    	}


        } else {
                $this->set('ciudades', parent::getCiudades());
                $this->set('estado_selected', parent::getEstado());
                $this->set('ciudad_selected', parent::getCiudad());
                $this->set('pais_selected', 'Venezuela');
                $this->set('ciudades_actual', parent::getCiudades());
                $this->set('estado_actual_selected', parent::getEstado());
                $this->set('ciudad_actual_selected', parent::getCiudad());
                $this->set('pais_actual_selected', 'Venezuela');
                
                $this->set('ciudades_novia', parent::getCiudades());
                $this->set('estado_selected_novia', parent::getEstado());
                $this->set('ciudad_selected_novia', parent::getCiudad());
                $this->set('pais_selected_novia', 'Venezuela');
                $this->set('ciudades_actual_novia', parent::getCiudades());
                $this->set('estado_actual_selected_novia', parent::getEstado());
                $this->set('ciudad_actual_selected_novia', parent::getCiudad());
                $this->set('pais_actual_selected_novia', 'Venezuela');
        }
    }
    
    function eliminar($id) {
    	if(parent::isAdmin()) {
    		$this->Matrimonio->delete($id);
	        $this->Session->setFlash('Matrimonio eliminado con éxito', 'default', array(), 'good');
	        $this->redirect(array('action' => 'index'));
    	} else {
    		throw new NotFoundException('La página no existe');
    	}
    }
    
    function modificar($id) {
        if(!parent::isAdmin())
            throw new NotFoundException('La página no existe');
        
        $this->Matrimonio->id = $id;

    	if($this->request->is('put')) {
            if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novio'] = $this->request->data['Matrimonio']['estado_nacimiento_novio_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novio'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'];
            }
            
             if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novio'] = $this->request->data['Matrimonio']['estado_actual_novio_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novio'] = $this->request->data['Matrimonio']['ciudad_actual_novio_2'];
            }
            
            if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novia'] = $this->request->data['Matrimonio']['estado_nacimiento_novia_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novia'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'];
            }
            
            if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novia'] = $this->request->data['Matrimonio']['estado_actual_novia_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novia'] = $this->request->data['Matrimonio']['ciudad_actual_novia_2'];
            }
            
            if($this->Matrimonio->save($this->request->data)) {
                $this->Session->setFlash('Se ha modificado el matrimonio con éxito', 'default', array(), 'good');
            } else {
                $this->Session->setFlash('Ha ocurrido un error modificando el matrimonio', 'default', array(), 'bad');
            }
    	}

    	$this->request->data = $this->Matrimonio->read();
        $this->set('paises', parent::getPaises());
        $this->set('estados', parent::getEstados());

        if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_nacimiento_novio_2'] = $this->request->data['Matrimonio']['estado_nacimiento_novio'];
            $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio'];
            $this->set('ciudades', parent::getCiudades());
            $this->set('estado_selected', parent::getEstado());
            $this->set('ciudad_selected', parent::getCiudad());
        } else {
            $this->set('ciudades', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novio')));
            $this->set('estado_selected', $this->request->data('Matrimonio.estado_nacimiento_novio'));
            $this->set('ciudad_selected', $this->request->data('Matrimonio.ciudad_nacimiento_novio'));
        }
        
        if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_actual_novio_2'] = $this->request->data['Matrimonio']['estado_actual_novio'];
            $this->request->data['Matrimonio']['ciudad_actual_novio_2'] = $this->request->data['Matrimonio']['ciudad_actual_novio'];
            $this->set('ciudades_actual', parent::getCiudades());
            $this->set('estado_actual_selected', parent::getEstado());
            $this->set('ciudad_actual_selected', parent::getCiudad());
        } else {
            $this->set('ciudades_actual', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novio')));
            $this->set('estado_actual_selected', $this->request->data('Matrimonio.estado_actual_novio'));
            $this->set('ciudad_actual_selected', $this->request->data('Matrimonio.ciudad_actual_novio'));
        }
        
        // NOVIA
        
        if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_nacimiento_novia_2'] = $this->request->data['Matrimonio']['estado_nacimiento_novia'];
            $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia'];
            $this->set('ciudades_novia', parent::getCiudades());
            $this->set('estado_selected_novia', parent::getEstado());
            $this->set('ciudad_selected_novia', parent::getCiudad());
        } else {
            $this->set('ciudades_novia', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novia')));
            $this->set('estado_selected_novia', $this->request->data('Matrimonio.estado_nacimiento_novia'));
            $this->set('ciudad_selected_novia', $this->request->data('Matrimonio.ciudad_nacimiento_novia'));
        }
        
        if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_actual_novia_2'] = $this->request->data['Matrimonio']['estado_actual_novia'];
            $this->request->data['Matrimonio']['ciudad_actual_novia_2'] = $this->request->data['Matrimonio']['ciudad_actual_novia'];
            $this->set('ciudades_actual_novia', parent::getCiudades());
            $this->set('estado_actual_selected_novia', parent::getEstado());
            $this->set('ciudad_actual_selected_novia', parent::getCiudad());
        } else {
            $this->set('ciudades_actual_novia', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novia')));
            $this->set('estado_actual_selected_novia', $this->request->data('Matrimonio.estado_actual_novia'));
            $this->set('ciudad_actual_selected_novia', $this->request->data('Matrimonio.ciudad_actual_novia'));
        }


        $this->set('pais_selected', $this->request->data('Matrimonio.pais_nacimiento_novio'));
        $this->set('pais_actual_selected', $this->request->data('Matrimonio.pais_actual_novio'));
        $this->set('pais_selected_novia', $this->request->data('Matrimonio.pais_nacimiento_novia'));
        $this->set('pais_actual_selected_novia', $this->request->data('Matrimonio.pais_actual_novia'));

    	$this->render('agregar');
    }

    function buscar() {
        $q = $_GET['q'];

        if(empty($q))
            $keywords = array();
        else
            $keywords = preg_split('/ /', $q);

        $like = '';

        foreach($keywords as $k => $v) {
            $v = trim($v);

            if(!empty($v))
                $like .= 'LOWER(nombres_novio) LIKE \'%' . $v . '%\' OR LOWER(apellidos_novio) LIKE \'%' . $v . '%\' OR LOWER(cedula_novio) LIKE \'%' . $v . '%\' OR LOWER(nombres_novia) LIKE \'%' . $v . '%\' OR LOWER(apellidos_novia) LIKE \'%' . $v . '%\' OR LOWER(cedula_novia) LIKE \'%' . $v . '%\' OR fecha LIKE \'%' . $v . '%\' OR ';
        }

        $like = substr($like, 0, strlen($like)-3);

        $this->paginate['conditions'] = ' ' . $like;
        $this->Paginator->settings = $this->paginate;

        $this->set('matrimonios', $this->Paginator->paginate('Matrimonio'));
        $this->set('q', $q);
    }
}
?>