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
  
  function agregar() {
    if($this->request->is('post')) {

      $existeComunion = $this->Comunion->find('first', array(
        'conditions' => array(
          'Comunion.libro' => $this->request->data('Comunion.libro'),
          'Comunion.folio' => $this->request->data('Comunion.folio'),
          'Comunion.numero' => $this->request->data('Comunion.numero')
        )
      ));

      if($existeComunion) {
        $this->Session->setFlash('Ya existe una comunión con el mismo libro, folio y número', 'default', array(), 'bad');
      } elseif($this->Comunion->save($this->request->data)) {
        $this->Session->setFlash('Comunión agregada con éxito', 'default', array(), 'good');
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash('Ha ocurrido un error agregando la comunión', 'default', array(), 'bad');
      }

    } 
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
        $like .= 'LOWER(nombres) LIKE \'%' . $v . '%\' OR LOWER(apellidos) LIKE \'%' . $v . '%\' OR ';
    }

    $like = substr($like, 0, strlen($like)-3);

    $this->paginate['conditions'] = ' ' . $like;
    $this->Paginator->settings = $this->paginate;

    $this->set('comuniones', $this->Paginator->paginate('Comunion'));
    $this->set('q', $q);
  }
}
?>