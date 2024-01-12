
<?php
    include '../../models/plataforma/Plataforma.php';
    
    
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
    
    function traerPlataformas(){
        $mysqli = iniciarConexionDB();
        $listaPlataformas = $mysqli->query("Select * from plataformas");
        $arregloPlataformas = [];
        foreach($listaPlataformas as $plataforma){
            $objeto = new Plataforma($plataforma['id'], $plataforma['nombre'], $plataforma['slogan']);
            array_push($arregloPlataformas, $objeto);
        }

        $mysqli->close();
        return  $arregloPlataformas;

    }

    function traerPlataformaPorId($pId){
        $mysqli = iniciarConexionDB();
        $query = "Select * from plataformas Where id =$pId";
        $vPlataformaBD = $mysqli->query($query);
        $arregloPlataformas = [];
        foreach($vPlataformaBD as $plataforma){
            $objeto = new Plataforma($plataforma['id'], $plataforma['nombre'], $plataforma['slogan']);
            array_push($arregloPlataformas, $objeto);
        }
        $mysqli->close();
        return  $arregloPlataformas[0];

    }

    function existePlataforma($pNombre){
        
        $mysqli = iniciarConexionDB();
        
        $query = "Select * from plataformas Where nombre='$pNombre'";
        
        $listaPlataformas = $mysqli->query($query);
        
        $arregloPlataformas = [];
        foreach($listaPlataformas as $plataforma){
            $objeto = new Plataforma($plataforma['id'], $plataforma['nombre'], $plataforma['slogan']);
            array_push($arregloPlataformas, $objeto);
        }
        
        $mysqli->close();
        
        if(count($arregloPlataformas) > 0){
            return true;
        }else {
            return false;
        }
    }

    function guardarPlataforma($pNombre, $pSlogan){
        $vExistePlataforma = existePlataforma($pNombre);

        if(!$vExistePlataforma) {
            $mysqli = iniciarConexionDB();
            $vBanderaGuardado = false;
            if($vResultado = $mysqli->query("Insert Into plataformas(nombre, slogan) Values ('$pNombre', '$pSlogan')")){
                $vBanderaGuardado = true;
            }
            $mysqli->close();
            return $vBanderaGuardado;
        }else {

            return false;
        }

    }

    function editarPlataforma($pId, $pNombre, $pSlogan){
        $vExistePlataforma = existePlataforma($pNombre);

        if(!$vExistePlataforma) {
            $mysqli = iniciarConexionDB();
            $vBanderaEditado = false;
            if($vResultado = $mysqli->query("Update plataformas Set nombre='$pNombre', slogan='$pSlogan' Where id='$pId'")){
                $vBanderaEditado = true;
            }
            $mysqli->close();
            return $vBanderaEditado;
        }else {
            return false;
        }
    }

    function eliminarPlataforma($pId){
        echo 'Eliminado';
        $mysqli = iniciarConexionDB();
        $vBanderaEliminado = false;
        if($vResultado = $mysqli->query("Delete From plataformas Where id='$pId'")){
            echo 'Eliminado';
            $vBanderaEliminado = true;
            $mysqli->close();
            return $vBanderaEliminado;
        }else {
            return false;
        }
    }

    
?>