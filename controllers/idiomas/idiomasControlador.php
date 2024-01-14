
<?php
    include '../../models/idiomas/idiomas.php';
    
    
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
    
    function traeridiomas(){
        $mysqli = iniciarConexionDB();
        $listaidiomas = $mysqli->query("Select * from idiomas");
        $arregloidiomas = [];
        foreach($listaidiomas as $idiomas){
            $objeto = new idiomas($idiomas['id'], $idiomas['nombre'], $idiomas['ISO_code']);
            array_push($arregloidiomas, $objeto);

        }

        $mysqli->close();
        return  $arregloidiomas;

    }

    function traeridiomaId($pId){
        $mysqli = iniciarConexionDB();
        $query = "Select * from idiomas Where id =$pId";
        $vidiomasBD = $mysqli->query($query);
        $arregloidiomas = [];
        foreach($vidiomasBD as $idiomas){
            $objeto = new idiomas($idiomas['id'], $idiomas['nombre'], $idiomas['ISO_code']);
            array_push($arregloidiomas, $objeto);
            
           
        }
        $mysqli->close();
        return  $arregloidiomas[0];

    }

    function existeidiomas($pNombre){
        $mysqli = iniciarConexionDB();
        
        $query = "Select * from idiomas Where nombre='$pNombre'";
        
        $listaidiomas = $mysqli->query($query);
        
        $arregloidiomas = [];
        foreach($listaidiomas as $idiomas){
            $objeto = new idiomas($idiomas['id'], $idiomas['nombre'], $idiomas['ISO_code']);
            array_push($arregloidiomas, $objeto);
        }
        
        $mysqli->close();

        
        if(count($arregloidiomas) > 0){
            return true;
        }else {
            return false;
        }
    }

    function guardaridiomas($pNombre, $pISO_code){
        $vExisteidiomas = existeidiomas($pNombre);
        

        if(!$vExisteidiomas) {
            $mysqli = iniciarConexionDB();
            $vBanderaGuardado = false;
            if($vResultado = $mysqli->query("Insert Into idiomas(nombre, ISO_code) Values ('$pNombre', '$pISO_code')")){
                $vBanderaGuardado = true;
            }
            $mysqli->close();
            return $vBanderaGuardado;
        }else {

            return false;
        }
        
    
    }

    function editarIdiomas($pId, $pNombre, $pISO_code){
        $vExisteidiomas = existeidiomas($pNombre);

        if(!$vExisteidiomas) {
            $mysqli = iniciarConexionDB();
            $vBanderaEditado = false;
            if($vResultado = $mysqli->query("Update idiomas Set nombre='$pNombre', ISO_code='$pISO_code' Where id='$pId'")){
                $vBanderaEditado = true;
            }
            $mysqli->close();
            return $vBanderaEditado;
        }else {
            return false;
        }
    }

    function eliminaridiomas($pId){
        $mysqli = iniciarConexionDB();
        $vBanderaEliminado = false;
        if($vResultado = $mysqli->query("Delete From idiomas Where id='$pId'")){
            $vBanderaEliminado = true;
            $mysqli->close();
            return $vBanderaEliminado;
        }else {
            return false;
        }
    }


?>