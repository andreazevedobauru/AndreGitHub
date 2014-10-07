<?php

/**
 * Bundle Gerador de resultados finais de cada prova
 * Os resultados são gerados de acordo com o tipo de prova se ela é por:
 * 		N = Nota
 *		T = Tempo
 *		Q = Quantidade de Canto 
 * No caso de Nota o valor tem uma verificação antes do calculo
 * Se a quantidade de Juizes na prova for >= 7 a primeira e ultima nota são retiradas
 *
 * @package     AndreAzevedo
 * @author      André Azevedo <andre.felipe.az@gmail.com>
 * @basedon     
 */

class ResultadosFinais{

	protected static $array = array();

	public static function calculaNota($query){

		$resultadoFinal = 0;
		$i 				= 0;
		foreach ($query as $evr) {
			$resultadoFinal = $evr->resultado + $resultadoFinal;
			++$i;
		}
		/*echo $resultadoFinal/$i;
		exit();
*/
		return $resultadoFinal/$i;
	}
	
	public static function calculaTempo($value, $formato){
		/*--------------------------------------------------------
		#   Essa função retorna:
		# 		- Uma data menos 518400 timestamp (6 Dias); 
		---------------------------------------------------------*/



		return date($formato, strtotime($value)-604800);
	}

}
