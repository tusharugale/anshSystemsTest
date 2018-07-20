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

if($function_name == ''){
	echo "Please provide function name";exit;
}
$cal = new CalculatorClass;
$cal->$function_name($parameters);