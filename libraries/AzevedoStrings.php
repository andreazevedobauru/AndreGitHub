<?php

/**
 * Bundle conversor de Strings 
 * 
 * @package     AndreAzevedo
 * @author      André Azevedo <andre.felipe.az@gmail.com>
 * @basedon
 */

class AzevedoStrings{

	public static function retiraCaracter($value){
		$caracteres = array('.' => '', '/' =>'', '\'' => '', '-' => '', '|' => '', '(' => '', ')' => '', ' '=>'');
		return strtr($value, $caracteres);
	}

}
