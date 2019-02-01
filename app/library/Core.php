<?php 

// Mapea la url ingresada en el navegador
// 1-controlador
// 2-metodo
// 3-parametro
// ejemplo :/articulos/actualzar/4

class Core
{
    protected $controllerCurrent = 'pages';
    protected $methodCurrent = 'index';
    protected $parameters = [];

    public function __construct()
    {
        // Prueba para ver los parametros en una array
        // print_r($this -> getUrl());
        $url = $this -> getUrl();

        if(file_exists('../app/controllers/' . ucwords($url[0]).'.php' )){
            $this->controllerCurrent = ucwords($url[0]);

            unset($url[0]);
        }

        require_once '../app/controllers/'.ucwords($this->controllerCurrent).'.php';
        $this->controllerCurrent = new $this->controllerCurrent;
        ////

        if (isset($url[1])) {
            if(method_exists($this->controllerCurrent, $url[1])){
                $this->methodCurrent = $url[1];
                unset($url[1]);
            }
        }

        $this->parameters = $url ? array_values($url) : [];

        call_user_func_array([$this->controllerCurrent, $this->methodCurrent], $this->parameters);

    }

    public function getUrl()
    {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/' , $url);
            return $url;
        }
    }
}