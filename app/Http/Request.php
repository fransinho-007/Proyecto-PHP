<?php

namespace App\Http;

class Request
{
    public $url = [];
    private $controller;
    public $method;

    function __construct()
    {
        $this->url = explode('/',$_SERVER['REQUEST_URI']);
        $this->setController();
        $this->setMethod();
    }

    function setController () {
        // preguntando si en la casilla 3 del array esta vacia
        if (empty($this->url[3])) {
            // establecer el controlador por defecto
            $this->controller = 'home';
        } else {
            // establecer el controlador solicitado
            $this->controller = $this->url[3];
        }
    }

    function getController () {
        $miController = strtolower($this->controller);
        $miController = ucfirst($this->controller);
        return "App\Http\Controllers\\{$miController}Controller";
    }

    function setMethod () {
        // preguntando si en la casilla 3 del array esta vacia
        if (empty($this->url[4])) {
            // establecer el Metodo por defecto
            $this->method = 'index';
        } else {
            // establecer el Metodo solicitado
            $this->method = $this->url[4];
        }
    }

    function getMethod () {
        return $this->method;
    }

    function send() {
        //var_dump();
        //echo "<p>en el controlador [$this->controller] llamar al metodo [$this->method]</p>";
        
        $miController = $this->getController();
        $miMethod = $this->getMethod();
        echo "<p>en el controlador [$miController] llamar al metodo [$miMethod]</p>";
        $response = call_user_func([
            new $miController,
            $miMethod
        ]);

        
    }

}