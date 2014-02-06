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

            if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novio'] = $this->request->data['Matrimonio']['estado_nacimiento_novio_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novio'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'];
            }
            
            if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novio'] = $this->request->data['Matrimonio']['estado_actual_novio_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novio'] = $this->request->data['Matrimonio']['ciudad_actual_novio_2'];
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
        }
    }
}
?>