<?php
    require_once('../../controllers/actor/ActorControlador.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Biblioteca de series</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">ViuBlioteca</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/views/plataformas/lista.php">Plataformas </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Directores </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/views/actores/lista.php">Actores </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/views/idiomas/lista.php">Idiomas </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Series </a>
            </li>
            
          </ul>
        </div>
    </nav>
    <div class="container">
        <?php
            $id = $_GET['id'];
            $actor = traerActorPorId($id);

            $vEnviado = false;
            $vActorEliminado = false;

            if(isset($_POST['eliminarBtn'])){
                $vEnviado = true;
            }
            if($vEnviado){
                
                $vActorEliminado = eliminarActor($id);
                
            }

            if(!$vEnviado){
        ?>
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-md-center">
                    
                    <h3>Estas seguro que deseas eliminar a el actor <?php echo $actor->getNombre() ?> <?php echo $actor->getApellido() ?></h3>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <a class="btn btn-warning"  href="/views/actores/lista.php">Volver</a>
                <form name="eliminar_plataforma" action="" method="POST">
                    <input type="submit" value="Eliminar" class="btn btn-danger" name="eliminarBtn">
                </form>
            </div>
            
        </div>
        <?php
            }else{
                if($vActorEliminado){
        ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                Plataforma eliminada correctamente.
            </div>
        </div>
        <?php
                }else{

                
        ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Algo salio mal!
            </div>
        </div>
        <?php
                }
        ?>
        <div class="row justify-content-md-center">
                <a class="btn btn-warning"  href="/views/actores/lista.php">Volver</a>
            </div>
        <?php
            }
        ?>
    </div>
</body>

</html>