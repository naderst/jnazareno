<?php
class BuscadorController extends AppController {
	public $uses = array();

	function index($q) {
		$q = str_replace('-', ' ', $q);
		$this->set('q', $q);
	}
}
?>