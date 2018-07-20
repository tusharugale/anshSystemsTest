<?php

class CalculatorClass{
	private $negative_numbers = array();
	private $number_limit = 1000;
	private $operator = '+';	

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
		$sum = $this->getInitialSum();

		if(!empty($parameters[0])){
			$params = explode(',', $parameters[0]);
			if(!empty($params)){
				foreach ($params as $param) {
					$special_case = $this->checkForSpecialChars($param);
					if($special_case){
						if($special_case == 'SLASHN'){
							$sum = $this->getCal($this->getSlashNSum($param), $sum);
						}
						if($special_case == 'DELIMITER'){
							$sum = $this->getCal($this->getDelimiterSum($param),$sum);
						}
					}else{
						if($this->checkForError($param)){
							$sum = $this->getCal($param,$sum);
						}
					}				
					
				}
			}	
		}	
		if(!empty($this->negative_numbers)){
			if(count($this->negative_numbers) > 1){
				$neg_numbers = implode(',', $this->negative_numbers);
				echo "Negative numbers (".$neg_numbers.") not allowed";	
			}else{
				echo "Negative numbers not allowed";
			}
			
			exit;
		}		
		echo $sum;
	}

	public function multiply($parameters){
		$this->operator = '*';
		$this->add($parameters);
	}

	public function getInitialSum(){
		if($this->operator == "+"){
			return 0;
		}else{
			return 1;
		}
	}

	public function getCal($a, $b){
		if($this->operator == "+"){
			return $a + $b;
		}
		if($this->operator == "*"){
			return $a * $b;
		}
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
		$sum = $this->getInitialSum();
		$parts = explode('\n', $string);
		foreach ($parts as $part) {
			if($this->checkForError($part)){
				$sum = $this->getCal($part,$sum);		
			}			
		}
		return $sum;
	}

	public function getDelimiterSum($string){
		$sum = $this->getInitialSum();
		preg_match("/\\\\\\\\(.*)\\\\\\\\/", $string, $parts);
		$whole_delimiter = $parts[0];
		$delimiter = $parts[1];
		$parts1 = explode($whole_delimiter, $string);
		$parts2 = explode($delimiter, $parts1[1]);

		foreach ($parts2 as $part) {
			if($this->checkForError($part)){
				$sum = $this->getCal($part,$sum);		
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
		if($number > $this->number_limit){
			return false;
		}
		return true;
	}
}