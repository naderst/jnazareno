<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
	public $name = 'Pages';
	public $uses = array();
    
    function beforeFilter() {
        if(!$this->Auth->loggedIn())
            $this->redirect('/usuarios/login');
    }
    
    // Mostrar estadísticas del sitio
	function display() {
		$this->render('home');
	}

	private function edad($fnac, $fact = null) {
		if(!$fact)
			$fact = time();

		$fnac = strtotime($fnac);
		$edad = date('Y', $fact) - date('Y', $fnac);

		if(date('m', $fact) < date('m', $fnac)) {
			--$edad;
		} elseif((date('m', $fact) == date('m', $fnac)) && (date('d', $fact) < date('d', $fnac))) {
			--$edad;
		}

		return $edad;
	}
}
