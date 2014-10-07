<?php

namespace Eprom;

class AutenticacaoCheck extends \BaseController
{
    public static function tabelaCategorias($categorias, $nivel = 0){

    }

    public function if_criador($usuario){
        if(strlen($usuario->documento) == 11){
            return Redirect::to('/criador/home');
        }
    }

    //Se for entidade redireciona para a home da entidade
    public function if_entidade($usuario ){
        if(strlen($usuario->documento) == 14){
            return Redirect::to('/entidade/home');
        }
    }
}