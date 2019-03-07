<?php

namespace Troop;

use Troop\TroopNonStatic;

class Troop {

	public $number;

	public function __construct() {
		$this->number = json_decode(file_get_contents(__DIR__ . "/number.json"), true);
	}

	public static function fromDec(int $dec) {
		$number = (new self)->number;
		// return strval($dec);
		do {
			$mod_temp = (isset($div_temp)? $div_temp: $dec)%62;
			$div_temp = floor((isset($div_temp)? $div_temp: $dec)/62);
			$temp = $number[$mod_temp] . (isset($temp)? $temp: '');
		} while($div_temp > 0);
		return $temp;
	}

	public static function toDec(String $tro) {
		$number = (new self)->number;
		$number_flip = array_flip($number);
		for($i=0; $i<strlen($tro); $i++) {
			$j = (isset($j)? $j: strlen($tro)) - 1;
			$dec = (isset($dec)? $dec: 0) + ($number_flip[$tro[$i]] * pow(62, strlen($tro)-1-$i));
		}
		return $dec;
	}
}