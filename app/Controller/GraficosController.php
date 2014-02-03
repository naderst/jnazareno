<?php
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_pie');

class GraficosController extends AppController {
	public $uses = array();

	function bautizosEdades() {
		$this->autoRender = false;

		$data = array(40,60,21,33);
		$legends = array('1-7 años (%.2f%%)','May (%d)','June (%d)', 'July (%d)'); 
		 
		$graph = new PieGraph(400,300);
		$graph->SetShadow();
		$graph->title->Set('Cantidad de bautizos por edades');
		 
		$p1 = new PiePlot($data);
		

		$p1->SetLegends($legends); 
		$p1->SetLabels(array());
		$graph->Add($p1);
		$graph->Stroke();
	}

	function bautizosSexo() {
		$this->loadModel('Bautizo');

		$cantidad_m = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'M')));
		$cantidad_f = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'F')));

		$this->autoRender = false;
		$data = array($cantidad_m, $cantidad_f);
		$legends = array('Masculino ('.$cantidad_m.')', 'Femenino ('.$cantidad_f.')'); 
		 
		$graph = new PieGraph(400,300);
		$graph->SetShadow();
		$graph->title->Set('Cantidad de bautizos por sexo');
		 
		$p1 = new PiePlot($data);

		$p1->SetLegends($legends); 
		$p1->SetLabels(array());
		$graph->Add($p1);
		$graph->Stroke();
	}
}
?>