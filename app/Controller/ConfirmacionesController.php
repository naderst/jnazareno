<?php
class ConfirmacionesController extends AppController {
  public $uses = 'Confirmacion';
  public $components = array('Paginator');
  public $helpers = array('Paginator');
  public $paginate = array(
    'limit' => 5,
    'order' => 'Confirmacion.numero ASC'
  );

  function index() {
    $this->Paginator->settings = $this->paginate;
    $this->set('confirmaciones', $this->Paginator->paginate('Confirmacion'));
  }
}
?>