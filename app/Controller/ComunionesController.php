<?php
class ComunionesController extends AppController {
  public $uses = 'Comunion';
  public $components = array('Paginator');
  public $helpers = array('Paginator');
  public $paginate = array(
    'limit' => 5,
    'order' => 'Comunion.numero ASC'
  );
  
  function index() {
    $this->Paginator->settings = $this->paginate;
    $this->set('comuniones', $this->Paginator->paginate('Comunion'));
  }
}
?>