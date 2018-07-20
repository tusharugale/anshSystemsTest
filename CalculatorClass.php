<?php

class CalculatorClass{
	public function sum($params){
		$sum = 0;
		foreach ($params as $param) {
			$sum += $param;
		}
		echo $sum;
	}
}