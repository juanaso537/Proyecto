<?php

include("Usuario.php");

class Control
{

    private $obj;

    function __construct()
    {

        $obj = new Usuario();
    }

    function seleccionarOpcion()
    {

        if (isset($_POST['registrar'])) {

            $this->registrarDatos(1);
        }

        if (isset($_POST['ingresar'])) {

            $this->ingresarPlataforma();
        }

        // if (isset($_POST['listar'])) {

        //     $this->registrarDatos(3);
        // }
    }

    public function registrarDatos($oper)
    {

        $nombre = $_POST['nombre'];

        $apellido = $_POST['apellido'];

        $usuariop = $_POST['usuario'];

        $password = $_POST['password'];

        $passwordConfirm = $_POST['passwordConfirm'];
        $obj = new Usuario();

        switch ($oper) {

            case 1:
                if ($password == $passwordConfirm) {

                    $obj->registrarUsuario($nombre, $apellido, $usuariop, $password);


                    break;
                }else{
                    echo "las contraseñas no coinciden ";
                    
                }
        }

        echo "<a href=\"Registro.html\"> Retornar </a>";
    }
    public function ingresarPlataforma()
    {

        $usuariop = $_POST['usuarioIng'];

        $password = $_POST['passwordIng'];
        $obj = new Usuario();

        $obj->consultarIngreso($usuariop, $password);
    }
}

$obj1 = new Control();

$obj1->seleccionarOpcion();

//echo "<a href="index.html"> Formulario </a>";
