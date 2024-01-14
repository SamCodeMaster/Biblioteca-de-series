<?php
include '../../models/serie/serie.php';
include '../../models/serie/serieActor.php';
include '../../models/serie/serieAudio.php';
include '../../models/serie/serieSubtitulo.php';
include '../../models/plataforma/Plataforma.php';
include '../../models/actor/actor.php';
include '../../models/director/Director.php';
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

function traerSeries(){
    $mysqli = iniciarConexionDB();
    $listaSeries = $mysqli->query("Select * from series");
    $arregloSeries = [];
    foreach($listaSeries as $serie){
        $objeto = new Serie($serie['id'], $serie['nombre'], $serie['plataforma'], $serie['director']);
        array_push($arregloSeries, $objeto);
    }

    $mysqli->close();
    return  $arregloSeries;

}


function traerSeriesLista(){
    $mysqli = iniciarConexionDB();
    $listaSeries = $mysqli->query("Select s.id, s.nombre, p.nombre as plataforma, d.nombre as director from series AS s 
    INNER JOIN plataformas AS p ON p.id = s.plataforma
    INNER JOIN directores as d on d.id = s.director");
    $arregloSeries = [];
    foreach($listaSeries as $serie){
        $objeto = new Serie($serie['id'], $serie['nombre'], $serie['plataforma'], $serie['director']);
        array_push($arregloSeries, $objeto);
    }

    $mysqli->close();
    return  $arregloSeries;
}

function traerSeriePorId($pId){
    $mysqli = iniciarConexionDB();
    $listaSeries = $mysqli->query("Select * from series where id = '$pId'");
    $arregloSeries = [];
    foreach($listaSeries as $serie){
        $objeto = new Serie($serie['id'], $serie['nombre'], $serie['plataforma'], $serie['director']);
        array_push($arregloSeries, $objeto);
    }

    $mysqli->close();
    if(!empty($arregloSeries)){
        return  $arregloSeries[0];
    }else{
        return null;
    }
    

}

function traerDetallesSerie($pSerieId){
    $vSerie = traerSeriePorId($pSerieId);
    if(isset($vSerie)){
        $mysqli = iniciarConexionDB();
        $listaActores = $mysqli->query("Select a.id, a.nombre, a.apellido from  series AS s INNER JOIN rel_series_actores As sA on sA.serie = s.id
        INNER JOIN actores as a on a.id = sA.actor where s.id = '$pSerieId'");

        $listaAudios = $mysqli->query("select i.id, i.nombre, i.ISO_code from  series AS s INNER JOIN rel_series_audio As sI on sI.serie = s.id
        INNER JOIN idiomas as i on i.id = sI.audio where s.id = '$pSerieId'");

        $listaSubtitulos = $mysqli->query("select i.id, i.nombre, i.ISO_code from  series AS s INNER JOIN rel_series_subtitulos As sS on sS.serie = s.id
        INNER JOIN idiomas as i on i.id = sS.subtitulos where s.id = '$pSerieId'");
        

        
        $arregloActores = [];
        $arregloAudio = [];
        $arregloSub = [];
        foreach($listaActores as $actor){
            
            $info = [];
            $info['id'] = $actor['id'];
            $info['nombre'] = $actor['nombre']." ".$actor['apellido'];
            
            array_push( $arregloActores, $info);
            
           
        }

        foreach($listaAudios as $audio){
            $info = [];
            $info['id'] = $audio['id'];
            $info['nombre'] = $audio['nombre']."(".$actor['ISO_code'].")";
            array_push( $arregloAudio, $info);
           
        }

        foreach($listaSubtitulos as $sub){
            $info = [];
            $info['id'] = $sub['id'];
            $info['nombre'] = $sub['nombre']."(".$sub['ISO_code'].")";
            array_push( $arregloSub, $info);
           
        }

        $detallesSerie = array(
            $vSerie,
            $arregloActores,
            $arregloAudio,
            $arregloSub
        );

        $mysqli->close();

        return $detallesSerie;
    }else{
        return null;
    }
}


function guardarSerie($nombre, $plataforma, $director, $actores, $audio, $subtitulos){
    print_r($actores);
    $mysqli = iniciarConexionDB();
    $vBanderaGuardado = false;
    if($vResultado = $mysqli->query("Insert Into series(nombre, plataforma, director) Values ('$nombre', '$plataforma','$director')")){
        $vBanderaGuardado = true;
    }
    $id =  $mysqli->query("Select MAX(id) as id from series");
    $vId = [];
    foreach($id as $val){
        array_push( $vId, $val['id']);
    }
    $id = $vId[0];

    foreach($actores as $actor){
        if($vResultado = $mysqli->query("Insert Into rel_series_actores(serie, actor) Values ('$id', '$actor')")){
            $vBanderaGuardado = true;
        }
    }

    foreach($audio as $a){
        if($vResultado = $mysqli->query("Insert Into rel_series_audio(serie, audio) Values ('$id', '$a')")){
            $vBanderaGuardado = true;
        }
    }

    foreach($subtitulos as $s){
        if($vResultado = $mysqli->query("Insert Into rel_series_subtitulos(serie, subtitulos) Values ('$id', '$s')")){
            $vBanderaGuardado = true;
        }
    }

    
    

    $mysqli->close();
    return $vBanderaGuardado;
}

/* Plataforma */

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
    $mysqli = iniciarConexionDB();
    $vBanderaEliminado = false;
    if($vResultado = $mysqli->query("Delete From plataformas Where id='$pId'")){
        $vBanderaEliminado = true;
        $mysqli->close();
        return $vBanderaEliminado;
    }else {
        return false;
    }
}

/* Actores */

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
    $mysqli = iniciarConexionDB();
    $vBanderaGuardado = false;
    if($vResultado = $mysqli->query("Insert Into actores(nombre, apellido,
    fecha_nacimiento, nacionalidad) Values ('$pNombre', '$pApellido', '$pFechaNacimiento', '$pNacionalidad')")){
        $vBanderaGuardado = true;
    }
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

/* Directores */

function traerDirectores(){
    $mysqli = iniciarConexionDB();
    $listaDirectores = $mysqli->query("Select * from directores");
    $arregloDirectores = [];
    foreach($listaDirectores as $director){
        $objeto = new Director($director['id'], $director['nombre'], $director['apellido'], $director['dni'], $director['fecha_nac'], $director['nacionalidad']);
        array_push($arregloDirectores, $objeto);
    }

    $mysqli->close();
    return  $arregloDirectores;

}

function traerDirectoresPorId($dId){
    $mysqli = iniciarConexionDB();
    $query = "Select * from directores Where id = $dId";
    $vDirectorBD = $mysqli->query($query);
    $arregloDirectores = [];
    foreach($vDirectorBD as $director){
        $objeto = new Director($director['id'], $director['nombre'], $director['apellido'], $director['dni'], $director['fecha_nac'], $director['nacionalidad']);
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
        $objeto = new Director($director['id'], $director['nombre'], $director['apellido'], $director['dni'], $director['fecha_nac'], $director['nacionalidad']);
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
        
        if($vResultado = $mysqli->query("Insert Into directores(nombre, apellido, dni, fecha_nac, nacionalidad) Values ('$dNombre', '$dApellidos', '$dDni', '$dFecha_Nac', '$dNacionalidad')")){
            $vBanderaGuardado = true;
        }
        $mysqli->close();
        return $vBanderaGuardado;
    }else {

        return false;
    }

}

function editarDirector($dId, $dNombre, $dApellidos, $dDni, $dFecha_Nac, $dNacionalidad){
    $vExisteDirector = existeDirector($dDni);

    if(!$vExisteDirector) {
        $mysqli = iniciarConexionDB();
        $vBanderaEditado = false;
        if($vResultado = $mysqli->query("Update directores Set nombre='$dNombre', apellido='$dApellidos', nacionalidad='$dNacionalidad' Where id='$dId'")){
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

/** Idiomas */

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