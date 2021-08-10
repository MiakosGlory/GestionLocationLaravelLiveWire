<?php

use Illuminate\Support\Str;


define("PAGE_LIST", "liste");
define("PAGE_EDIT", "edit");
define("PAGE_AJOUT", "ajout");
define("DEFAULT_PWD", "password1");


    function usefullName()
    {
        return auth()->user()->nom ." ".auth()->user()->prenom;
    }


    /*function setMenuOpen($route, $class)
    {
        if(contains(request()->route()->getName, $route))
        {
            return $class;
        }
        return "";
    }

    function contains($container, $contenu)
    {
        return Str::contains($container, $contenu);
    }*/