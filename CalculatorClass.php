<?php

class CalculatorClass{
	public function sum($parameters){
		$sum = 0;
		if(!empty($parameters[0])){
			$sum += $parameters[0]; 				
		}
		if(!empty($parameters[1])){
			$sum += $parameters[1]; 				
		}
		echo $sum;
	}

	public function add($parameters){
		$sum = 0;
		if(!empty($parameters[0])){
			$params = explode(',', $parameters[0]);
			if(!empty($params)){
				foreach ($params as $param) {
					if($param != ''){
						$sum += $param;					
					}
				}
			}	
		}			
		echo $sum;
	}
	
}