<?php
class Persona extends AppModel {
    public $validate = array(
    	'nombres' => array(
			'rule' => '/^[a-z]{2,50}$/i',
			'message' => 'Los nombres deben tener entre 2 y 50 caracteres'
    	),
    	'apellidos' => array(
			'rule' => '/^[a-z]{2,50}$/i',
			'message' => 'Los apellidos deben tener entre 2 y 50 caracteres'
    	),
    	'cedula' => array(
    		'formato' => array(
    			'rule' => '/^[V|E]-[0-9]{1,9}$/i',
    			'message' => 'La cédula debe tener el siguiente formato: V-1234578'
    		),
    		'existe' => array(
    			'rule' => 'ciExists',
    			'message' => 'Ésta cédula ya existe'
    		)
    	),
    	'fecha_nacimniento' => array(
    		'rule' => array('date', 'dmy')
    	),
    	'direccion' => array(
    		'rule' => array('between', 1, 100),
    		'message' => 'Debe completar este campo'
    	),
    	'padre' => array(
    		'rule' => '/^[a-z]{5,50}$/i',
    		'message' => 'El nombre completo del padre debe tener entre 5 y 50 caracteres'
    	),
    	'madre' => array(
    		'rule' => '/^[a-z]{5,50}$/i',
    		'message' => 'El nombre completo de la madre debe tener entre 5 y 50 caracteres'
    	),
    	"estado_nacimiento" => array(
    		'rule' => array('between', 2, 20),
    		'message' => 'Debe completar este campo'
    	)
    );

    function ciExists($cedula) {
    	return $this->find('count', array(
    		'conditions' => array('Persona.cedula' => $cedula)
    	)) == 0;
    }
}
?>