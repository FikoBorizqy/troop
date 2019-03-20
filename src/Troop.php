<?php

/**
 * Troop Decimal
 * 
 * If you know Octa Decimal base on 8, hexa decimal base on 16,
 * Troop is a numeral base on 62. For example number of 35 will be
 * changed to z(lowecase).
 * 
 * 0-9: stay these number
 * 10-35: a-z (lowercase)
 * 36-61: A-Z (uppercase)
 * 
 * @package Troop Decimal
 * @author Fiko Borizqy <fiko@dr.com>
 * @license MIT
 * @license https://choosealicense.com/licenses/mit/
 * @see https://github.com/fikoborizqy/troop
 */

namespace Borizqy\Troop;

/**
 * Troop Decimal
 * 
 * If you know Octa Decimal base on 8, hexa decimal base on 16,
 * Troop is a numeral base on 62. For example number of 35 will be
 * changed to z(lowecase).
 * 
 * 0-9: stay these number
 * 10-35: a-z (lowercase)
 * 36-61: A-Z (uppercase)
 * 
 * @access public
 */
class Troop {

	/**
	 * Base Character
	 * 
	 * all characters saved here, from 0 - Z (capital)
	 * file is in ../inc/number.json
	 * 
	 * @see inc/number.json
	 */
	protected $number;



	/**
	 * Construction
	 * 
	 * prepare all prerequisites data that Troop needed
	 * - getting ../int/number.json => base character of 61
	 */
	public function __construct() {
		$this->number = json_decode(file_get_contents(__DIR__ . "/../inc/number.json"), true);
	}



	/**
	 * Decimal to Troop
	 * 
	 * converting data from decimal (integer) number to Troop
	 * decimal.
	 * 
	 * @param 	Integer		$dec		(required) decimal or integer number
	 * @return 	String					Troopdecimal result of converting from decimal
	 */
	public static function fromDec($dec) {
		// if $dec is not integer, then return false
		if(!is_int($dec)) return false;
		// getting troop number
		$number = (new self)->number;
		// return strval($dec);
		do {
			$mod_temp = (isset($div_temp)? $div_temp: $dec)%62;
			$div_temp = floor((isset($div_temp)? $div_temp: $dec)/62);
			$temp = $number[$mod_temp] . (isset($temp)? $temp: '');
		} while($div_temp > 0);
		return $temp;
	}



	/**
	 * Troop to Decimal
	 * 
	 * converting data from Troop decimal number to decimal
	 * number (integer).
	 * 
	 * @param 	String		$tro		(required) Troop decimal character
	 * @return 	Integer					Decimal result of Troop
	 */
	public static function toDec(String $tro) {
		// getting troop number
		$number = (new self)->number;
		$number_flip = array_flip($number);
		for($i=0; $i<strlen($tro); $i++) {
			if(!isset($number_flip[$tro[$i]])) return false;
			$j = (isset($j)? $j: strlen($tro)) - 1;
			$dec = (isset($dec)? $dec: 0) + ($number_flip[$tro[$i]] * pow(62, strlen($tro)-1-$i));
		}
		return isset($dec)? $dec: null;
	}



	/**
	 * Troop Character Mapping
	 * 
	 * - get troop character of number from 0-61.
	 * - get decimal character of troop from 0-Z
	 * 
	 * @param 	Integer|String		$num		(required) decimal from 0-9 or troop from 0-Z
	 * @param 	Boolean				$getDec		(default: false) false means getting troop character from decimal, vice versa.
	 * @return 	Integer|String					character result of decimal or troopdecimal
	 */
	public static function charMapping($num, $getDec = false) {
		if($getDec !== true) {
			return (new static)->number[$num];
		} else {
			return array_flip((new self)->number)[$num];
		}
	}
}