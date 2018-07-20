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
					$special_case = $this->checkForSpecialChars($param);
					if($special_case){
						if($special_case == 'SLASHN'){
							$sum += $this->getSlashNSum($param);
						}
					}else{
						if($param != ''){
							$sum += $param;					
						}
					}				
					
				}
			}	
		}			
		echo $sum;
	}

	public function checkForSpecialChars($string){
		if (strpos($string, '\n') !== false) {
			return 'SLASHN';
		}
		return false;
	}

	public function getSlashNSum($string){
		$sum = 0;
		$parts = explode('\n', $string);
		foreach ($parts as $part) {
			$sum += $part;
		}
		return $sum;
	}
	
}