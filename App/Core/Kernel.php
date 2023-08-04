<?php

namespace app\Core;

use App\Controllers\NoteController;

class Kernel
{
    protected $currentController = 'Note';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
       $url = $this->getURL();
    

       if(file_exists('../App/controllers/'.ucwords($url[0]).'Controller.php')){
            
            $this->currentController = ucwords($url[0]).'Controller';

            unset($url[0]);
            
            if('NoteController' == $this->currentController){
                $this->currentController = new NoteController;
            }

            // Does method exist in the controller
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            $this->params = $url ? array_values($url) : [];
        
            //pass params to methods
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

       }
    }

    public function getURL()
    {
        if(isset($_SERVER['REQUEST_URI'])) {
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = ltrim($url , $url[0]);
            $url = explode('/', $url);
            return $url;
        }
    }
}