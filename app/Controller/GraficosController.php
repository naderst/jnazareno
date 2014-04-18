<?php
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_pie');

class GraficosController extends AppController {
	public $uses = array();

	function bautizosEdades() {
        Configure::write('debug',0);
        
        $this->autoRender = false;
        $this->response->type('image/png');
        
        $this->loadModel('Bautizo');
        
        $fechas = $this->Bautizo->find('all');
        $hoy = time();
        $unanyo = 31536000;
        $sieteanyos = 220752000;
        
        $hasta = $entre = $mayor = 0;
        
        foreach($fechas as $e) {
            $timestamp = strtotime(str_replace('/', '-', $e['Bautizo']['fecha_nacimiento']));
            $edad = $hoy - $timestamp;
            
            if($edad < $unanyo)
                ++$hasta;
            elseif($edad >= $unanyo && $edad <= $sieteanyos)
                ++$entre;
            elseif($edad > $sieteanyos)
                ++$mayor;
        }

		$data = array($hasta,$entre,$mayor);
		$legends = array('Hasta 1 año (' . $hasta . ')','De 1 a 7 años (' . $entre . ')','Mayores de 7 años (' . $mayor . ')'); 
		 
		$graph = new PieGraph(480,300);
		$graph->SetShadow();
		$graph->title->Set('Cantidad de bautizos por edades');
		 
		$p1 = new PiePlot($data);
		

		$p1->SetLegends($legends); 
		$p1->SetLabels(array());
		$graph->Add($p1);
        $p1->SetSliceColors(array('#3498db', '#9b59b6', '#2ecc71'));
        $p1->value->SetColor('white');
		$graph->Stroke();
	}

	function bautizosGenero() {
        Configure::write('debug',0);
        
        $this->autoRender = false;
        $this->response->type('image/png');
        
		$this->loadModel('Bautizo');

		$cantidad_m = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'M')));
		$cantidad_f = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'F')));
        
		$data = array($cantidad_m, $cantidad_f);
		$legends = array('Masculino ('.$cantidad_m.')', 'Femenino ('.$cantidad_f.')'); 
		 
		$graph = new PieGraph(400,300);
		$graph->SetShadow();
		$graph->title->Set('Cantidad de bautizos por género');
		 
		$p1 = new PiePlot($data);

		$p1->SetLegends($legends); 
		$p1->SetLabels(array());
		$graph->Add($p1);
        $p1->SetSliceColors(array('#3498db', '#9b59b6'));
        $p1->value->SetColor('white');
		$graph->Stroke();
	}
}
?>