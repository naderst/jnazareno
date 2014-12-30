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
  
  function agregar() {
    if($this->request->is('post')) {

      $existeConfirmacion = $this->Confirmacion->find('first', array(
        'conditions' => array(
          'Confirmacion.lote' => $this->request->data('Confirmacion.lote'),
          'Confirmacion.numero' => $this->request->data('Confirmacion.numero')
        )
      ));

      if($existeConfirmacion) {
        $this->Session->setFlash('Ya existe una confirmación con el mismo lote y número', 'default', array(), 'bad');
      } elseif($this->Confirmacion->save($this->request->data)) {
        $this->Session->setFlash('Confirmación agregada con éxito', 'default', array(), 'good');
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash('Ha ocurrido un error agregando la confirmación', 'default', array(), 'bad');
      }

    } 
  }
  
  function modificar($id) {
    $this->Confirmacion->id = $id;
    
    if ($this->request->is('put')) {
      $existeConfirmacion = $this->Confirmacion->find('first', array(
        'conditions' => array(
          'Confirmacion.lote' => $this->request->data('Confirmacion.lote'),
          'Confirmacion.numero' => $this->request->data('Confirmacion.numero')
        )
      ));
      
      if ($existeConfirmacion && $existeConfirmacion['Confirmacion']['id'] != $id) {
         $this->Session->setFlash('Ya existe una confirmación con el mismo lote y número', 'default', array(), 'bad');
      } elseif ($this->Confirmacion->save($this->request->data)) {
        $this->Session->setFlash('Se ha modificado la confirmación con éxito', 'default', array(), 'good');
      } else {
        $this->Session->setFlash('Ha ocurrido un error modificando el bautizo', 'default', array(), 'bad');
      }
    }
    
    $this->request->data = $this->Confirmacion->read();
    $this->render('agregar');
  }

  function eliminar($id) {
    if(parent::isAdmin() && $id != null) {
      $this->Confirmacion->delete($id);
      $this->Session->setFlash('Confirmación eliminada con éxito', 'default', array(), 'good');
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

    $this->set('confirmaciones', $this->Paginator->paginate('Confirmacion'));
    $this->set('q', $q);
  }
}
?>