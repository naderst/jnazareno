<?php
class BautizosController extends AppController {
    function index() {
        $this->set('bautizos', $this->Bautizo->find('all'));
    }
    
    function agregar() {
    }
}
?>