<?php

class CalculatorClass{
	private $negative_numbers = array();

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
						if($special_case == 'DELIMITER'){
							$sum += $this->getDelimiterSum($param);
						}
					}else{
						if($this->checkForError($param)){
							$sum += $param;
						}
					}				
					
				}
			}	
		}	
		if(!empty($this->negative_numbers)){
			$neg_numbers = implode(',', $this->negative_numbers);
			echo "Negative numbers (".$neg_numbers.") not allowed";
			exit;
		}		
		echo $sum;
	}

	public function checkForSpecialChars($string){
		if (strpos($string, '\n') !== false) {
			return 'SLASHN';
		}
		if(preg_match("/\\\\\\\\(.*)\\\\\\\\/", $string, $matches)){
			return 'DELIMITER';
		}
		return false;
	}

	public function getSlashNSum($string){
		$sum = 0;
		$parts = explode('\n', $string);
		foreach ($parts as $part) {
			if($this->checkForError($part)){
				$sum += $part;		
			}			
		}
		return $sum;
	}

	public function getDelimiterSum($string){
		$sum = 0;
		preg_match("/\\\\\\\\(.*)\\\\\\\\/", $string, $parts);
		$whole_delimiter = $parts[0];
		$delimiter = $parts[1];
		$parts1 = explode($whole_delimiter, $string);
		$parts2 = explode($delimiter, $parts1[1]);

		foreach ($parts2 as $part) {
			if($this->checkForError($part)){
				$sum += $part;		
			}
		}
		return $sum;
	}
	
	public function checkForError($number){
		if($number == ''){
			echo "Please enter number, empty value wont be accepted";exit;
		}
		if(!is_numeric($number)){
			echo "Please enter proper number";exit;
		}
		if($number < 0){
			$this->negative_numbers[] = $number;
		}
		return true;
	}
}