<?php

namespace App\Core;
class Controller
{
    public function view($view, $data = [])
    {
        if(file_exists('../App/Views/note/'.$view.'.php')){
            require_once '../App/Views/note/'.$view.'.php';
        }
        else{
            die($view . " does not exist");    
        }
    }
}