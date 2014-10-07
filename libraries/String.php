<?php

namespace Eprom;

class String
{
    public static function slugify($str)
    {
        $str = htmlentities($str);
        $str = strtolower($str);

        $str = preg_replace('/(&Aacute;|&aacute;|&Acirc;|&acirc;|&Agrave;|&agrave;|&Aring;|&aring;|&Atilde;|&atilde;|&Auml;|&auml;|&AElig;|&aelig;)/', 'a', $str);
        $str = preg_replace('/(&Eacute;|&eacute;|&Ecirc;|&ecirc;|&Egrave;|&egrave;|&Euml;|&euml;|&ETH;|&eth;)/', 'e', $str);
        $str = preg_replace('/(&Iacute;|&iacute;|&Icirc;|&icirc;|&Igrave;|&igrave;|&Iuml;|&iuml;)/', 'i', $str);
        $str = preg_replace('/(&Oacute;|&oacute;|&Ocirc;|&ocirc;|&Ograve;|&ograve;|&Oslash;|&oslash;|&Otilde;|&otilde;|&Ouml;|&ouml;)/', 'o', $str);
        $str = preg_replace('/(&Uacute;|&uacute;|&Ucirc;|&ucirc;|&Ugrave;|&ugrave;|&Uuml;|&uuml;)/', 'u', $str);
        $str = preg_replace('/(&Ccedil;|&ccedil;)/', 'c', $str);
        $str = preg_replace('/\s+/', '-', $str);
        $str = preg_replace('/[^a-z0-9-]/', '', $str);

        return $str;
    }

    public static function if_criador($usuario){
        if(strlen($usuario->documento) == 11){
            return Redirect::to('/criador/home');
        }
    }

    //Se for entidade redireciona para a home da entidade
    public static function if_entidade($usuario ){
        if(strlen($usuario->documento) == 14){
            return Redirect::to('/entidade/home');
        }
    }
}