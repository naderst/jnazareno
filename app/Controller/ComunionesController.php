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
  
  function eliminar($id) {
    if(parent::isAdmin() && $id != null) {
      $this->Comunion->delete($id);
      $this->Session->setFlash('Comunión eliminada con éxito', 'default', array(), 'good');
      $this->redirect(array('action' => 'index'));
    } else {
      throw new NotFoundException('La página no existe');
    }
  }
}
?>