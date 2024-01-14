<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php

include '../../models/actor/actor.php';

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

function traerActores(){
    $mysqli = iniciarConexionDB();
    $listaActores = $mysqli->query("Select * from actores");
    $arregloActores = [];
    foreach($listaActores as $actor){
        $objeto = new Actor($actor['id'], $actor['nombre'], $actor['apellido'], $actor['fecha_nacimiento'], $actor['nacionalidad']);
        array_push($arregloActores, $objeto);
    }

    $mysqli->close();
    return  $arregloActores;

}

function traerActorPorId($pId){
    $mysqli = iniciarConexionDB();
    $query = "Select * from actores Where id =$pId";
    $listaActores = $mysqli->query($query);
    $arregloActores = [];
    foreach($listaActores as $actor){
        $objeto = new Actor($actor['id'], $actor['nombre'], $actor['apellido'], $actor['fecha_nacimiento'], $actor['nacionalidad']);
        array_push($arregloActores, $objeto);
    }
    $mysqli->close();
    return  $arregloActores[0];

}

function guardarActor($pNombre, $pApellido, $pFechaNacimiento, $pNacionalidad){
    echo gettype($pFechaNacimiento);
    $mysqli = iniciarConexionDB();
    $vBanderaGuardado = false;
    if($vResultado = $mysqli->query("Insert Into actores(nombre, apellido,
    fecha_nacimiento, nacionalidad) Values ('$pNombre', '$pApellido', '$pFechaNacimiento', '$pNacionalidad')")){
        $vBanderaGuardado = true;
    }
    echo 'vResultado';
    echo $vBanderaGuardado;
    $mysqli->close();
    return $vBanderaGuardado;
}

function editarActor($pId, $pNombre, $pApellido, $pFechaNacimiento, $pNacionalidad){
    $mysqli = iniciarConexionDB();
    $vBanderaEditado = false;
    if($vResultado = $mysqli->query("Update actores 
            Set nombre='$pNombre', apellido='$pApellido', fecha_nacimiento='$pFechaNacimiento', nacionalidad='$pNacionalidad' 
            Where id='$pId'")){
        $vBanderaEditado = true;
    }
    $mysqli->close();
    return $vBanderaEditado;
}

function eliminarActor($pId){
    $mysqli = iniciarConexionDB();
    $vBanderaEliminado = false;
    if($vResultado = $mysqli->query("Delete From actores Where id='$pId'")){
        $vBanderaEliminado = true;
        $mysqli->close();
        return $vBanderaEliminado;
    }else {
        return false;
    }
}

function gola(){
    echo 'hola';
}

?>

