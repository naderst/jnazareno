<?php
App::import('Vendor', 'MPDF57/mpdf');

class MatrimoniosController extends AppController {
    public $components = array('Paginator');
    public $helpers = array('Paginator');
    public $paginate = array(
        'limit' => 5,
        'order' => array('Matrimonio.id' => 'DESC')
    );

    function index() {
        $this->Paginator->settings = $this->paginate;
        $this->set('matrimonios', $this->Paginator->paginate('Matrimonio'));
    }

    function agregar() {
        $this->set('paises', parent::getPaises());
        $this->set('estados', parent::getEstados());

        if($this->request->is('post')) {
            $this->set('ciudades', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novio')));
            $this->set('estado_selected', $this->request->data('Matrimonio.estado_nacimiento_novio'));
            $this->set('ciudad_selected', $this->request->data('Matrimonio.ciudad_nacimiento_novio'));
            $this->set('pais_selected', $this->request->data('Matrimonio.pais_nacimiento_novio'));
            $this->set('ciudades_actual', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novio')));
            $this->set('estado_actual_selected', $this->request->data('Matrimonio.estado_actual_novio'));
            $this->set('ciudad_actual_selected', $this->request->data('Matrimonio.ciudad_actual_novio'));
            $this->set('pais_actual_selected', $this->request->data('Matrimonio.pais_actual_novio'));

            $this->set('ciudades_novia', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novia')));
            $this->set('estado_selected_novia', $this->request->data('Matrimonio.estado_nacimiento_novia'));
            $this->set('ciudad_selected_novia', $this->request->data('Matrimonio.ciudad_nacimiento_novia'));
            $this->set('pais_selected_novia', $this->request->data('Matrimonio.pais_nacimiento_novia'));
            $this->set('ciudades_actual_novia', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novia')));
            $this->set('estado_actual_selected_novia', $this->request->data('Matrimonio.estado_actual_novia'));
            $this->set('ciudad_actual_selected_novia', $this->request->data('Matrimonio.ciudad_actual_novia'));
            $this->set('pais_actual_selected_novia', $this->request->data('Matrimonio.pais_actual_novia'));


            if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novio'] = $this->request->data['Matrimonio']['estado_nacimiento_novio_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novio'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'];
            }

             if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novio'] = $this->request->data['Matrimonio']['estado_actual_novio_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novio'] = $this->request->data['Matrimonio']['ciudad_actual_novio_2'];
            }
            
            if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novia'] = $this->request->data['Matrimonio']['estado_nacimiento_novia_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novia'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'];
            }
            
            if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novia'] = $this->request->data['Matrimonio']['estado_actual_novia_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novia'] = $this->request->data['Matrimonio']['ciudad_actual_novia_2'];
            }

            if($this->Matrimonio->save($this->request->data)) {
	    		$this->Session->setFlash('Matrimonio agregado con éxito', 'default', array(), 'good');
	    		$this->redirect(array('action' => 'index'));
	    	} else {
	    		$this->Session->setFlash('Ha ocurrido un error agregando el matrimonio', 'default', array(), 'bad');
	    	}


        } else {
                $this->set('ciudades', parent::getCiudades());
                $this->set('estado_selected', parent::getEstado());
                $this->set('ciudad_selected', parent::getCiudad());
                $this->set('pais_selected', 'Venezuela');
                $this->set('ciudades_actual', parent::getCiudades());
                $this->set('estado_actual_selected', parent::getEstado());
                $this->set('ciudad_actual_selected', parent::getCiudad());
                $this->set('pais_actual_selected', 'Venezuela');
                
                $this->set('ciudades_novia', parent::getCiudades());
                $this->set('estado_selected_novia', parent::getEstado());
                $this->set('ciudad_selected_novia', parent::getCiudad());
                $this->set('pais_selected_novia', 'Venezuela');
                $this->set('ciudades_actual_novia', parent::getCiudades());
                $this->set('estado_actual_selected_novia', parent::getEstado());
                $this->set('ciudad_actual_selected_novia', parent::getCiudad());
                $this->set('pais_actual_selected_novia', 'Venezuela');
        }
    }
    
    function eliminar($id) {
    	if(parent::isAdmin()) {
    		$this->Matrimonio->delete($id);
	        $this->Session->setFlash('Matrimonio eliminado con éxito', 'default', array(), 'good');
	        $this->redirect(array('action' => 'index'));
    	} else {
    		throw new NotFoundException('La página no existe');
    	}
    }

    function modificar($id) {
        if(!parent::isAdmin())
            throw new NotFoundException('La página no existe');

        $this->Matrimonio->id = $id;

    	if($this->request->is('put')) {
            if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novio'] = $this->request->data['Matrimonio']['estado_nacimiento_novio_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novio'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'];
            }

             if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novio'] = $this->request->data['Matrimonio']['estado_actual_novio_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novio'] = $this->request->data['Matrimonio']['ciudad_actual_novio_2'];
            }
            
            if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_nacimiento_novia'] = $this->request->data['Matrimonio']['estado_nacimiento_novia_2'];
                $this->request->data['Matrimonio']['ciudad_nacimiento_novia'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'];
            }
            
            if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
                $this->request->data['Matrimonio']['estado_actual_novia'] = $this->request->data['Matrimonio']['estado_actual_novia_2'];
                $this->request->data['Matrimonio']['ciudad_actual_novia'] = $this->request->data['Matrimonio']['ciudad_actual_novia_2'];
            }

            if($this->Matrimonio->save($this->request->data)) {
                $this->Session->setFlash('Se ha modificado el matrimonio con éxito', 'default', array(), 'good');
            } else {
                $this->Session->setFlash('Ha ocurrido un error modificando el matrimonio', 'default', array(), 'bad');
            }
    	}

    	$this->request->data = $this->Matrimonio->read();
        $this->set('paises', parent::getPaises());
        $this->set('estados', parent::getEstados());

        if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_nacimiento_novio_2'] = $this->request->data['Matrimonio']['estado_nacimiento_novio'];
            $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio'];
            $this->set('ciudades', parent::getCiudades());
            $this->set('estado_selected', parent::getEstado());
            $this->set('ciudad_selected', parent::getCiudad());
        } else {
            $this->set('ciudades', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novio')));
            $this->set('estado_selected', $this->request->data('Matrimonio.estado_nacimiento_novio'));
            $this->set('ciudad_selected', $this->request->data('Matrimonio.ciudad_nacimiento_novio'));
        }
        
        if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_actual_novio_2'] = $this->request->data['Matrimonio']['estado_actual_novio'];
            $this->request->data['Matrimonio']['ciudad_actual_novio_2'] = $this->request->data['Matrimonio']['ciudad_actual_novio'];
            $this->set('ciudades_actual', parent::getCiudades());
            $this->set('estado_actual_selected', parent::getEstado());
            $this->set('ciudad_actual_selected', parent::getCiudad());
        } else {
            $this->set('ciudades_actual', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novio')));
            $this->set('estado_actual_selected', $this->request->data('Matrimonio.estado_actual_novio'));
            $this->set('ciudad_actual_selected', $this->request->data('Matrimonio.ciudad_actual_novio'));
        }
        
        // NOVIA

        if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_nacimiento_novia_2'] = $this->request->data['Matrimonio']['estado_nacimiento_novia'];
            $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia'];
            $this->set('ciudades_novia', parent::getCiudades());
            $this->set('estado_selected_novia', parent::getEstado());
            $this->set('ciudad_selected_novia', parent::getCiudad());
        } else {
            $this->set('ciudades_novia', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novia')));
            $this->set('estado_selected_novia', $this->request->data('Matrimonio.estado_nacimiento_novia'));
            $this->set('ciudad_selected_novia', $this->request->data('Matrimonio.ciudad_nacimiento_novia'));
        }
        
        if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
            $this->request->data['Matrimonio']['estado_actual_novia_2'] = $this->request->data['Matrimonio']['estado_actual_novia'];
            $this->request->data['Matrimonio']['ciudad_actual_novia_2'] = $this->request->data['Matrimonio']['ciudad_actual_novia'];
            $this->set('ciudades_actual_novia', parent::getCiudades());
            $this->set('estado_actual_selected_novia', parent::getEstado());
            $this->set('ciudad_actual_selected_novia', parent::getCiudad());
        } else {
            $this->set('ciudades_actual_novia', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novia')));
            $this->set('estado_actual_selected_novia', $this->request->data('Matrimonio.estado_actual_novia'));
            $this->set('ciudad_actual_selected_novia', $this->request->data('Matrimonio.ciudad_actual_novia'));
        }


        $this->set('pais_selected', $this->request->data('Matrimonio.pais_nacimiento_novio'));
        $this->set('pais_actual_selected', $this->request->data('Matrimonio.pais_actual_novio'));
        $this->set('pais_selected_novia', $this->request->data('Matrimonio.pais_nacimiento_novia'));
        $this->set('pais_actual_selected_novia', $this->request->data('Matrimonio.pais_actual_novia'));

    	$this->render('agregar');
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
                $like .= 'LOWER(nombres_novio) LIKE \'%' . $v . '%\' OR LOWER(apellidos_novio) LIKE \'%' . $v . '%\' OR LOWER(cedula_novio) LIKE \'%' . $v . '%\' OR LOWER(nombres_novia) LIKE \'%' . $v . '%\' OR LOWER(apellidos_novia) LIKE \'%' . $v . '%\' OR LOWER(cedula_novia) LIKE \'%' . $v . '%\' OR fecha LIKE \'%' . $v . '%\' OR ';
        }

        $like = substr($like, 0, strlen($like)-3);

        $this->paginate['conditions'] = ' ' . $like;
        $this->Paginator->settings = $this->paginate;

        $this->set('matrimonios', $this->Paginator->paginate('Matrimonio'));
        $this->set('q', $q);
    }

	function certificado($id) {
        Configure::write('debug',0);

        $this->autoRender = false;
        $this->response->type('application/pdf');
        $this->loadModel('Configuracion');

        $config = $this->Configuracion->find('all');
        $this->Matrimonio->id = $id;
        $matrimonio = $this->Matrimonio->read();

        $presbitero = '';

        foreach($config as $e)
            if($e['Configuracion']['parametro'] == 'presbitero') {
                $presbitero = $e['Configuracion']['valor'];
                break;
            }

		$novio = $matrimonio['Matrimonio']['nombres_novio'] . ' ' . $matrimonio['Matrimonio']['apellidos_novio'];
		$novia = $matrimonio['Matrimonio']['nombres_novia'] . ' ' . $matrimonio['Matrimonio']['apellidos_novia'];
		$fecha = preg_split('/\//', $matrimonio['Matrimonio']['fecha']);

        $fecha_dia = $fecha[0];
        $fecha_mes = $fecha[1];
        $fecha_ano = $fecha[2];
        $fecha_mes = ucwords(parent::month2string($fecha_mes));
        $time = time();
        $hoy = parent::strtoupper_utf8(date('d', $time) . ' DE ' . parent::month2string(date('m',$time)) . ' DEL AÑO ' . date('Y', $time));

        $columna1 = '<table>';
        $columna1 .= '<tr><td><b>Libro:</b></td><td>'.$matrimonio['Matrimonio']['libro'] . '</td></tr>';
        $columna1 .= '<tr><td><b>Folio:</b></td><td>'.$matrimonio['Matrimonio']['folio'] . '</td></tr>';
        $columna1 .= '<tr><td><b>Número:</b></td><td>'.$matrimonio['Matrimonio']['numero'] . '</td></tr>';
        $columna1 .= '<tr><td colspan="2"><b>Nota marginal:</b></td></tr>';
        $columna1 .= '<tr><td colspan="2" style="height: 200px;text-align:justify;font-size:11px" valign="top">' . (empty($matrimonio['Matrimonio']['observaciones'])?'<img width="100%" height="200" src="' . Router::url('/img/diagonal.png') . '">':$matrimonio['Matrimonio']['observaciones']) . '</td></tr>';
        $columna1 .= '</table>';

        $columna2 = 'El presbitero <b>' . parent::strtoupper_utf8($presbitero) . '</b>,';
        $columna2 .= ' párroco encargado de esta Parroquia, certifica que según consta del acta reseñada al margen correspondiente al libro de Matrimonio: ';
        $columna2 .= '<br><br><br><div class="titulo">' . parent::strtoupper_utf8($novio) . '<br>y<br>' . parent::strtoupper_utf8($novia) . '</div><br><br>';
        $columna2 .= 'Recibieron Sacramento de Matrimonio Eclesiástico, en la Parroquia Jesús Nazareno, en Puerto Ordaz, Estado Bolívar, el ' . $fecha_dia . ' de ' . $fecha_mes . ' de ' . $fecha_ano . '.';
		$columna2 .= '<br><br><table>';
        $columna2 .= '<tr><td><b>Desposado hijo de: </b></td><td>ijasidjasidas</td></tr>';
        $columna2 .= '<tr><td><b>Desposada hija de: </b></td><td>ijasidjasidas</td></tr>';
		$columna2 .= '<tr><td><b>Testigos Eclesiásticos: </b></td><td>ijasidjasidas</td></tr>';
		$columna2 .= '<tr><td><b>Ministro celebrante: </b></td><td>ijasidjasidas</td></tr>';
		$columna2 .= '<tr><td><b>Se pide este certificado para fines: </b></td><td>ijasidjasidas</td></tr>';
        $columna2 .= '</table>';

        $html = '<div class="titulo">CERTIFICADO DE MATRIMONIO</div><br><br>';
        $html .= '<div style="float:left;width:25%;line-height:1.5;border-right:1px solid #666;">' . $columna1 . '<br><br><br><br><br><br></div><div style="float:right;width:70%;text-align:justify;line-height:1.5">' . $columna2 . '</div><div style="clear:both"></div>';
        $html.= '<br><br>PUERTO ORDAZ, ' . $hoy . '<br>';
        $html .= 'Doy Fe.<br><br><div style="text-align:center;"><b>PRESBITERO ' . parent::strtoupper_utf8($presbitero) . '</b><br><br><br><br><br><b>PÁRROCO</b></div>';
        $html .= '<br><br><div style="text-align:center">Si este certificado va a ser usado fuera de la Diócesis debe ser autenticado en la Curia Diocesana</div>';

        $mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
        $mpdf->writeHTML('td { width:50%; padding:5px; } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; }', 1);
        $mpdf->setHTMLHeader('<div id="logo"><img src="' . Router::url('/img/logo.png') . '"></div>');
        $mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output('Certificado de Matrimonio de '.ucwords($novio) . ' y ' . ucwords($novia), 'I');
	}

	function expediente($id) {
		/*
        TODO:
		Configure::write('debug',0);
		$this->autoRender = false;
		$this->response->type('application/pdf');

		$this->Matrimonio->id = $id;
        $matrimonio = $this->Matrimonio->read();

		$novio = $matrimonio['Matrimonio']['nombres_novio'] . ' ' . $matrimonio['Matrimonio']['apellidos_novio'];
		$novia = $matrimonio['Matrimonio']['nombres_novia'] . ' ' . $matrimonio['Matrimonio']['apellidos_novia'];
		$titulo = 'EXPEDIENTE MATRIMONIAL';

		$html = '<div class="titulo">' . $titulo . '</div><br><br>';
		$html .= '<u><b>DOCUMENTOS QUE PERTENECEN A ESTE EXPEDIENTE</b></u><br><br>';
		$html .= '<table class="documentos">';
		$html .= '<tr><td>Partida de Bautismo de <b>' . $novio . '</b> y de <b>' . $novia . '</b></td></tr>';
		$html .= '<tr><td>Certificado de Proclamas de la Parroquia Jesús Nazareno</td></tr>';
		$html .= '<tr><td>Constancia del Curso Prematrimonial X de fecha Y</td></tr>';
		$html .= '<tr><td>Documentos de la curia</td></tr>';
		$html .= '</table>';

		$mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
		$mpdf->writeHTML('.documentos td { padding: 8px; border-bottom: #ccc 1px solid } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; }', 1);
		$mpdf->setHTMLHeader('<div id="logo"><img src="' . Router::url('/img/logo.png') . '"></div>');
		$mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
		$mpdf->WriteHTML($html, 2);
		$mpdf->Output('Expediente Matrimonial de ' . $novio . ' y ' . $novia, 'I'); */
	}
}
?>