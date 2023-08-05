<?php

namespace app\Core;

class Router
{
    protected $controller = 'Note';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getURL();
        if (file_exists('../App/controllers/' . ucwords($url[1]) . 'Controller.php')) {
            $this->controller = !empty($url[1]) ? ucwords($url[1]) . 'Controller' : 'NoteController';
            unset($url[1]);
        } else {
            $this->controller = 'NoteController';
        }
        //Controller call
        $newContr = '\App\Controllers\\' . $this->controller;
        $this->controller = new $newContr;

        //Method call
        $this->method = !empty($url[2]) ? $url[2] : 'index';
        unset($url[2]);

        if (empty($url[0])) {
            unset($url[0]);
        }
        if ($_SERVER['QUERY_STRING']) {
            parse_str($_SERVER['QUERY_STRING'], $this->params);
        } else {
            $this->params = $url ? array_values($url) : [];
        }
        //pass params to methods
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function getURL()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = explode('/', $_SERVER['REQUEST_URI']);
            return $url;
        }
    }
}
