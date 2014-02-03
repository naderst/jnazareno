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

	function rename() {
		if(!parent::isAdmin()) {
			return;
		}

		$this->layout = 'ajax';
		$old = $this->request->data('old');
		$new = $this->request->data('new');

		if(rename('../webroot/documents/'.$old, '../webroot/documents/'.$new))
			$this->set('name', $new);
		else
			$this->set('name', $old);
	}

	function subir() {
		if(!parent::isAdmin()) {
			return;
		}

		$MAX_SIZE = 5; // Tamaño en megabytes (MB)
		$valid_ext = 'doc|docx|pdf|jpg|png|gif|bmp|txt'; // Extensiones aceptadas
		$nombre = $_FILES['documento']['name'];
		$src = $_FILES['documento']['tmp_name'];
		$dst = '../webroot/documents/'.$nombre;
		$size = $_FILES['documento']['size'];

		if($size > ($MAX_SIZE*1048576)) {
			$this->Session->setFlash('El tamaño del archivo debe ser menor o igual a '.$MAX_SIZE.' MB', 'default', array(), 'bad');
		} elseif (!preg_match('/\.('.$valid_ext.')$/i', $nombre)) {
			$this->Session->setFlash('Formato inválido', 'default', array(), 'bad');
		} elseif(file_exists($dst)) {
			$this->Session->setFlash('El archivo ya existe', 'default', array(), 'bad');
		} else {
			move_uploaded_file($src, $dst);
			$this->Session->setFlash('Se ha subido el archivo con éxito', 'default', array(), 'good');
		}

		$this->redirect('/documentos');
	}
}
?>