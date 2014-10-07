<?php

/**
 * Bundle conversor de data no formato pt_BR para o padrão usado no Mysql
 * 
 * @package     AndreAzevedo
 * @author      André Azevedo <andre.felipe.az@gmail.com>
 * @basedon     
 */

class AzevedoDatas{

	protected static $formatos = array(
		'datetime' => 'd/m/Y H:i:s',
		'date'     => 'd/m/Y',
	);

	public static function toMysql($value){

		$dia     					= substr($value,0,2);
		$mes     					= substr($value,3,2);
		$ano     					= substr($value,6,4);
		$hora   				 	= substr($value,11,2);
		$minuto 				 	= substr($value,14,2);
		$segundo 					= substr($value,17,2);
		
		$data 				 		= date('Y/m/d H:i:s', mktime($hora, $minuto, $segundo, $mes, $dia, $ano));

		return $data;
	}
	
	public static function toViewInicio($value, $formato){
		/*--------------------------------------------------------
		#   Essa função retorna:
		# 		- Uma data menos 518400 timestamp (6 Dias); 
		---------------------------------------------------------*/

		return date($formato, strtotime($value)-604800);
	}

	public static function toViewFim($value, $formato){
		/*--------------------------------------------------------
		#   Essa função retorna:
		# 		- Uma data menos 518400 timestamp (1 Dias); 
		---------------------------------------------------------*/

		return date($formato, strtotime($value)-86400);
	}
	public static function toView($value, $formato = 'd/m/Y'){
		/*--------------------------------------------------------
		#   Essa função retorna:
		# 		- Uma data formatada; 
		---------------------------------------------------------*/

		return date($formato, strtotime($value));
	}

	public static function retiraCaracter($value){
		$caracteres = array('.' => '', '/' =>'', '\'' => '');
		return strtr($value, $caracteres);
	}
}
