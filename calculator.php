<?php
require('CalculatorClass.php');

$function_name = '';
$parameters = array();
foreach ($argv as $index => $arg) {
	if($index == 1){
		$function_name = $arg;		
	}
	if($index > 1){
		$parameters[] = $arg;
	}
}	


$cal = new CalculatorClass;
$cal->$function_name($parameters);