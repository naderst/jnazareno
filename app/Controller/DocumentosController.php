<?php
class DocumentosController extends AppController {
	public $uses = array();

	function index() {
		$dr = opendir('../webroot/documents');
		$files = array();

		if($dr !== FALSE) {
			while(($file = readdir($dr)) !== FALSE) {
				if($file != '.' && $file != '..')
					$files[] = $file;
			}

			closedir($dr);
		}

		$this->set('files', $files);
	}

	function eliminar($f) {
		if(!parent::isAdmin()) {
			throw new NotFoundException('La página no existe');
		}

		
		if(unlink('../webroot/documents/'.$f))
			$this->Session->setFlash('Se ha eliminado el documento con éxito', 'default', array(), 'good');
		else
			$this->Session->setFlash('Ocurrió un error eliminando el documento', 'default', array(), 'bad');
		
		$this->redirect('/documentos');
	}
}
?>