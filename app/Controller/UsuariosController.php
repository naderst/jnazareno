<?php
class UsuariosController extends AppController {
    function login() {
        $this->layout = 'login';
        
        if($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash('Usuario o contraseña incorrecta', 'default', array(), 'auth');
            }
        }
    }
    
    function logout() {
        return $this->redirect($this->Auth->logout());
    }
}
?>