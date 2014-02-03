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

	}
}
?>