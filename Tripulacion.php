<?php

class Tripulacion
{

    private $servidor;

    private $usuario;

    private $clave;

    private $basedato;

    function __construct()
    {

        $this->servidor = "127.0.0.1";

        $this->usuario = "root";

        $this->clave = "";

        $this->basedato = "proyecto";
    }
}