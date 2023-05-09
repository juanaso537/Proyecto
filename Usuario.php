<?php

class Usuario
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

    function registrarUsuario($nombre, $apellido, $usuariop, $password)
    {

        $link = mysqli_connect($this->servidor, $this->usuario, "", $this->basedato);

        mysqli_select_db($link, $this->basedato);

        $grabar_cliente = "INSERT INTO usuarios(nomUsu,apeUsu,nickUSu,pasUsu) VALUES('$nombre','$apellido','$usuariop',md5('$password'))"; //guardo los datos
        echo "$nombre $apellido $usuariop $password";
        $guardar_usuario = mysqli_query($link, $grabar_cliente) or die('El registro de datos fall&oacute;: ' . mysqli_connect_error()); //valido si guardo

        mysqli_close($link);
    }






    function consultarIngreso($usuariop, $password)
    {

        $link = mysqli_connect($this->servidor, $this->usuario, "", $this->basedato);


        $passwordCif = md5($password);
        echo " $passwordCif ";
        // Preparar la consulta SQL con sentencias preparadas
        $consulta = "SELECT nickUsu, pasUsu FROM usuarios WHERE nickUSu = ? AND pasUsu = ?";
        $stmt = mysqli_prepare($link, $consulta);
        mysqli_stmt_bind_param($stmt, "ss", $usuariop, $passwordCif);

        // Ejecutar la consulta y verificar si hubo resultados
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_resultados = mysqli_stmt_num_rows($stmt);

        // Cerrar la conexión a la base de datos
        mysqli_stmt_close($stmt);
        mysqli_close($link);

        // Devolver verdadero si hubo al menos un resultado, falso en caso contrario
        if ($num_resultados > 0) {
           /*  header("Location: Plataforma.html"); */
            $link2 = mysqli_connect($this->servidor, $this->usuario, "", $this->basedato);

            mysqli_select_db($link2, $this->basedato);

            $fechaIngreso = date("Y-m-d");
            $horaIngreso = date("H:i:s");


            $consultaId = "SELECT idUsuarios FROM usuarios WHERE nickUsu = ?";
            $stmt2 = mysqli_prepare($link2, $consultaId);
            mysqli_stmt_bind_param($stmt2, "s" , $usuariop);

            mysqli_stmt_execute($stmt2);

            $resultado2 = mysqli_stmt_get_result($stmt2);

            $num_resultados2 = mysqli_num_rows($resultado2);

            mysqli_stmt_close($stmt2);


            if ($num_resultados2 > 0){
                $fila = mysqli_fetch_assoc($resultado2);
                $idUsuario = $fila['idUsuarios'];
            }

            
            echo " $fechaIngreso , $horaIngreso , $idUsuario ";

            $grabar_bitacora = "INSERT INTO bitacora(fechaIngreso,horaIngreso,idUsuario) VALUES( '$fechaIngreso', '$horaIngreso' , $idUsuario)"; //guardo los datos


            $guardar_bitacora = mysqli_query($link2, $grabar_bitacora) or die('El registro de datos fall&oacute;: ' . mysqli_connect_error());

            
            mysqli_close($link2);
            exit;
        } else {
            echo "ingreso fallido";
        }
    }

    // function consultarIngreso($usuariop, $password)
    // {

    //     $link = mysqli_connect($this->servidor, $this->usuario, "", $this->basedato);

    //     mysqli_select_db($link, $this->basedato);

    //     $consultaUsu = "SELECT usuario,pasUsu FROM usuarios Where usuario='$usuariop'and pasUsu='$password'";
    //     // $consultaPass = "SELECT pasUsu FROM usuarios Where ";

    //     $result = mysqli_query($link, $consultaUsu) or die('La consulta de datos fall&oacute;: ' . mysqli_connect_error()); 
    //     if($result==true){
    //         echo "<a href=\"index.html\"> Retornar </a>";
    //     }

    //     mysqli_close($link);
    // }





    // function listarCliente() {

    // $link=mysqli_connect($this->servidor,$this->usuario ,"",$this->basedato);

    // mysqli_select_db($link,$this->basedato);

    // $consulta = "SELECT codcli,nomcli,emailcli,telcli FROM Clientes" ;

    // $result =    ;

    // if ($row = mysqli_fetch_array($result)) {

    // echo "<table border='1'>";

    // echo "<tr>";

    // // recorre el vector e imprime los campos definidos en la clase

    // do {

    // echo "<tr><td>".$row["codcli"]."</td><td>".$row["nomcli"]."</td><td>".$row["emailcli"]."</td><td>".$row["telcli"]."</td><td>".$row["emailcli"]."</td></tr> \n";

    // } while ($row = mysqli_fetch_array($result));

    // echo "</tr>";

    // } else {

    // echo "¡ No se ha encontrado ningún registro !";

    // }

    // mysqli_close($link);

    // //$this->free_result($resultado); // libera de memoria la tabla de resultados

    // } // fin de la consulta

}
