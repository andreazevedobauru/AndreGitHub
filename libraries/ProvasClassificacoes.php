<?php

/**
 *       Classe Desenvolvida para gerar as classificações das 
 *    Provas de um determinado evento.
 *       Motivos de ter criado essa Classe:
 *       Caso seja necessario uma alteração diferente para 
 *    cada classificação sera feito aqui.
 * 
 * @package     AndreAzevedo
 * @author      André Azevedo <andre.felipe.az@gmail.com> or andre@eprom.com.br
 * @basedon     
 */

class ProvasClassificacoes{

	/*--------------------------------------------
	*	Classificacao da Prova Azulão Canto Livre
	*---------------------------------------------*/
	public static function ACL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('AZ')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Azulão FIBRA
	*---------------------------------------------*/
	public static function AFibra($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('AZ')->whereProva('FIBRA')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------------------
	*	Classificacao da Prova Bicudo Alta Mogiana Classico
	*-------------------------------------------------------*/
	public static function BAMC($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('AMC')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Alta Mogiana Pardo
	*---------------------------------------------*/
	public static function BAMP($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('AMP')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Canto Especial
	*---------------------------------------------*/
	public static function BCE($id_evento, $orderby = array('sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('CE')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Canto Flauta
	*---------------------------------------------*/
	public static function BFL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('FL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Canto Flauta Pardo
	*---------------------------------------------*/
	public static function BFLP($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('FLP')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Canto Livre
	*---------------------------------------------*/
	public static function BCL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Fibra
	*---------------------------------------------*/
	public static function BFibra($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('FIBRA')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Fibra Pardo
	*---------------------------------------------*/
	public static function BFibraPD($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('FIBRAPD')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Goiano Classico
	*---------------------------------------------*/
	public static function BGOC($id_evento, $orderby = array( 'sequencia', 'ASC') ){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('GOC')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Bicudo Goiano Pardo
	*---------------------------------------------*/
	public static function BGOP($id_evento, $orderby = array( 'sequencia', 'ASC') ){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('B')->whereProva('GOP')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Canario Canto Amarelo Classico
	*---------------------------------------------*/
	public static function CACC($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CA')->whereProva('CC')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Canario Canto Amarelo Especial
	*---------------------------------------------*/
	public static function CACA($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CA')->whereProva('CA')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Canario Canto Livre
	*---------------------------------------------*/
	public static function CACL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CA')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Canario Canto Pardo
	*---------------------------------------------*/
	public static function CACP($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CA')->whereProva('CP')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Canario FIBRA
	*---------------------------------------------*/
	public static function CAFibra($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CA')->whereProva('FIBRA')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Coleira Canto Classico
	*---------------------------------------------*/
	public static function COCC($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CO')->whereProva('CC')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Coleira Canto Especial
	*---------------------------------------------*/
	public static function COCE($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CO')->whereProva('CE')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Coleira Canto Livre
	*---------------------------------------------*/
	public static function COCL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CO')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Coleira Fibra
	*---------------------------------------------*/
	public static function COFibra($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('CO')->whereProva('FIBRA')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Curio Canto Livre
	*---------------------------------------------*/
	public static function CCL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('C')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Curio Fibra
	*---------------------------------------------*/
	public static function CFibra($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('C')->whereProva('FIBRA')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Curio Fibra Pardo
	*---------------------------------------------*/
	public static function CFibraPD($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('C')->whereProva('FIBRAPD')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Curio Pardo
	*   Se não for setado a ordem de classificacao
	* o padrão será da menor(1) sequencia ao maior(999).
	*---------------------------------------------*/
	public static function CPD($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('C')->whereProva('PD')->orderBy($orderby[0], $orderby[1] )->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Curio Praia Classico
	*---------------------------------------------*/
	public static function CPC($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('C')->whereProva('PC')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Curio Praia Classico - Estaca 2
	*---------------------------------------------*/
	public static function CPC2($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('C')->whereProva('PC2')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Curio Praia Grande
	*---------------------------------------------*/
	public static function CPG($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('C')->whereProva('PG')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Pintassilgo Canto Livre
	*---------------------------------------------*/
	public static function PICL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('PI')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Pintassilgo Metalico Classico
	*---------------------------------------------*/
	public static function PICC($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('PI')->whereProva('CC')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Roda d'agua
	*---------------------------------------------*/
	public static function PIRD($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('PI')->whereProva('RD')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Sabiá Canto Livre
	*---------------------------------------------*/
	public static function SBCL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('SB')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Tico Tico Canto Livre
	*---------------------------------------------*/
	public static function TTCL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('TT')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Tico Tico Fibra
	*---------------------------------------------*/
	public static function TTFibra($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('TT')->whereProva('FIBRA')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Trinca Ferro Classico
	*---------------------------------------------*/
	public static function TRICC($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('TRI')->whereProva('CC')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Trinca Ferro Classico Bom dia seu chico
	*---------------------------------------------*/
	public static function TRICB($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('TRI')->whereProva('CB')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Trinca Ferro Especial
	*---------------------------------------------*/
	public static function TRICE($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('TRI')->whereProva('CE')->orderBy($orderby[0], $orderby[1])->get();
	}
	
	/*--------------------------------------------
	*	Classificacao da Prova Trinca Ferro Canto Livre
	*---------------------------------------------*/
	public static function TRICL($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('TRI')->whereProva('CL')->orderBy($orderby[0], $orderby[1])->get();
	}

	/*--------------------------------------------
	*	Classificacao da Prova Trinca Ferro Fibra
	*---------------------------------------------*/
	public static function TRIFibra($id_evento, $orderby = array( 'sequencia', 'ASC')){
		return EventoMapa::whereEvento($id_evento)->whereTipo_ave('TRI')->whereProva('FIBRA')->orderBy($orderby[0], $orderby[1])->get();
	}
}
