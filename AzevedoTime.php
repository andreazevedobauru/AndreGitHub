<?php

/**
 * Bundle conversor de data no formato pt_BR para o padrão usado no Mysql
 * 
 * @package     AndreAzevedo
 * @author      André Azevedo <andre.felipe.az@gmail.com>
 * @basedon     
 */

class AzevedoTime{

	protected static $formatos = array(
		'datetime' => 'd/m/Y H:i:s',
		'date'     => 'd/m/Y',
	);

	public static function secondToHour($value){

		$value = str_replace(",", ".", $value);

		$minutos = floor($value / 60);
		$segundos = floor((($value / 60) - $minutos) * 60);
		$milesimos = ((((($value / 60) - $minutos) * 60) - $segundos) * 1000);

		$minutos = $minutos < 10 ? '0'.$minutos : $minutos;
		$segundos = $segundos < 10 ? '0'.$segundos : $segundos;
		$milesimos = $milesimos < 100 && $milesimos >= 10 ? '0'.$milesimos : ($milesimos < 10 ? '00'.$milesimos : $milesimos);

		$milesimos = strpos($milesimos, ".") ? substr($milesimos, 0, strpos($milesimos, ".")) : $milesimos;

		return $minutos.':'.$segundos.':'.$milesimos;
	}

	public static function timeToSecond($value){
		$pedacos = explode(':', $value);

		$minutos = $pedacos[0];
		$segundos = $pedacos[1];
		$milesimos = $pedacos[2];

		$total = ($minutos * 60) + $segundos + ($milesimos / 1000);

		return $total;
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

	
}
