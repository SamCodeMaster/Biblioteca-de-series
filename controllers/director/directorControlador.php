<?php
    include '../../models/director/Director.php';
    
    
    function iniciarConexionDB(){
        $user = 'root';
        $password = 'root';
        $db = 'viublioteca';
        $host = 'localhost';
        $port = 3306;
        
        $mysqli = @new mysqli(
            $host,
            $user,
            $password,
            $db,
            $port

        );

        if($mysqli -> connect_error) {
            die('Error: ' .$mysqli->connect_error);
        }

        return $mysqli;
    }
    
    function traerDirectores(){
        $mysqli = iniciarConexionDB();
        $listaDirectores = $mysqli->query("Select * from directores");
        $arregloDirectores = [];
        foreach($listaDirectores as $director){
            $objeto = new Director($director['id'], $director['nombre'], $director['apellidos'], $director['dni'], $director['fecha_nac'], $director['nacionalidad']);
            array_push($arregloDirectores, $objeto);
        }

        $mysqli->close();
        return  $arregloDirectores;

    }

    function traerDirectorPorId($dId){
        $mysqli = iniciarConexionDB();
        $query = "Select * from directores Where id = $dId";
        $vDirectorBD = $mysqli->query($query);
        $arregloDirectores = [];
        foreach($vDirectorBD as $director){
            $objeto = new Director($director['id'], $director['nombre'], $director['apellidos'], $director['dni'], $director['fecha_nac'], $director['nacionalidad']);
            array_push($arregloDirectores, $objeto);
        }
        $mysqli->close();
        return  $arregloDirectores[0];

    }

    function existeDirector($dDni){
        
        $mysqli = iniciarConexionDB();
        
        $query = "Select * from directores Where dni = '$dDni'";
        
        $listaDirectores = $mysqli->query($query);
        
        $arregloDirectores = [];
        foreach($listaDirectores as $director){
            $objeto = new Director($director['id'], $director['nombre'], $director['apellidos'], $director['dni'], $director['fecha_nac'], $director['nacionalidad']);
            array_push($arregloDirectores, $objeto);
        }
        
        $mysqli->close();
        
        if(count($arregloDirectores) > 0){
            return true;
        }else {
            return false;
        }
    }

    function guardarDirector($dNombre, $dApellidos, $dDni, $dFecha_Nac, $dNacionalidad){
        $vExisteDirector = existeDirector($dDni);
      

        if(!$vExisteDirector) {
            $mysqli = iniciarConexionDB();
            $vBanderaGuardado = false;
            
            if($vResultado = $mysqli->query("Insert Into directores(nombre, apellidos, dni, fecha_nac, nacionalidad) Values ('$dNombre', '$dApellidos', '$dDni', '$dFecha_Nac', '$dNacionalidad')")){
                $vBanderaGuardado = true;
            }
            echo "fdssgsadg";
            $mysqli->close();
            return $vBanderaGuardado;
        }else {

            return false;
        }

    }

    function editarDirector($dId, $dNombre, $dApellidos, $dDni, $dFecha_Nac, $dNacionalidad){
        $vExisteDirector = existeDirector($dDni);

        if($vExisteDirector) {
            $mysqli = iniciarConexionDB();
            $vBanderaEditado = false;
            if($vResultado = $mysqli->query("Update directores Set nombre='$dNombre', apellidos='$dApellidos', nacionalidad='$dNacionalidad' Where id='$dId'")){
                $vBanderaEditado = true;
            }
            $mysqli->close();
            return $vBanderaEditado;
        }else {
            return false;
        }
    }

    function eliminarDirector($dId){
        echo 'Eliminado';
        $mysqli = iniciarConexionDB();
        $vBanderaEliminado = false;
        if($vResultado = $mysqli->query("Delete From directores Where id='$dId'")){
            echo 'Eliminado';
            $vBanderaEliminado = true;
            $mysqli->close();
            return $vBanderaEliminado;
        }else {
            return false;
        }
    }

    
?>