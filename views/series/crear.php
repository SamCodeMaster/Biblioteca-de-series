<?php
    include '../../controllers/serie/serieControlador.php';
    //require '../../controllers/plataforma/PlataformaControlador.php';
    //include '../../controllers/plataforma/PlataformaControlador.php';

   
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
                <a class="nav-link" href="/views/directores/lista.php">Directores </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/views/actores/lista.php">Actores </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/views/idiomas/lista.php">Idiomas </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/views/series/lista.php">Series </a>
            </li>
            
          </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h2 class="text-center">Crear Serie</h2>
        </div>
    </div>
    <div class="container">
        <?php
            
            $listaPlataformas = traerPlataformas();
            
            $listaActor = traerActores();
            
            $listaIdiom = traeridiomas();
            $listaDirectores = traerDirectores();
            
            $vEnviado = false;
            $vSerieCreada = false;
            if(isset($_POST['crearBtn'])){
                $vEnviado = true;
                
            }
            
            if($vEnviado){
                
                    $vSerieCreada = guardarSerie($_POST['nombreSerie'], $_POST['Plataforma'],
                            $_POST['Director'], $_POST['Actores'],
                            $_POST['Audio'], $_POST['Subtitulo']);
                
            }

            if(!$vEnviado){
        ?>
        <form name="crear_plataforma" action="" method="POST">
            <!-- nombre -->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="nombreSerie" class="form-label">Nombre Serie</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="nombreSerie" id="nombreSerie" type="text"
                            placeholder="Intrudice el nombre" class="form-control" required>
                    </div>
                </div>
            </div>
            <!-- Plataforma -->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="Plataforma" class="form-label">Plataform</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                            <select name="Plataforma" id="Plataforma" class="form-select" style="width: 100%" require>
                                <?php
                                    foreach($listaPlataformas as $dir){
                                        
                                ?>
                                <option value="<?php echo $dir->getId(); ?>"><?php echo $dir->getNombre(); ?></option>
                                <?php
                                    }
                                    
                                ?>
                            </select>
                    </div>
                </div>
            </div>
            <!-- Director -->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="Director" class="form-label">Director</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <select name="Director" id="Director" class="form-select" style="width: 100%" require >
                            <?php
                                foreach($listaDirectores as $dir){
                                    
                            ?>
                            <option value="<?php echo $dir->getId(); ?>"><?php echo $dir->getNombre()." ".$dir->getApellidos(); ?></option>
                            <?php
                                }
                                
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Actores -->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="Actores" class="form-label">Actores</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <select name="Actores[]" id="Actores[]" class="form-select" style="width: 100%" multiple >
                            <?php
                                foreach($listaActor as $actor){
                                    
                            ?>
                            <option value="<?php echo $actor->getId(); ?>"><?php echo $actor->getNombre()." ".$actor->getApellido(); ?></option>
                            <?php
                                }
                                
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Audio -->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="Audio" class="form-label">Audio</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <select name="Audio[]" id="Audio[]" class="form-select" style="width: 100%" multiple >
                            <?php
                                foreach($listaIdiom as $idioma){
                                    
                            ?>
                            <option value="<?php echo $idioma->getId(); ?>"><?php echo $idioma->getNombre()." ".$idioma->getISO_code(); ?></option>
                            <?php
                                }
                                
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Subtitulos -->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="Subtitulo" class="form-label">Subtitulo</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <select name="Subtitulo[]" id="Subtitulo[]"  class="form-select" style="width: 100%" multiple >
                            <?php
                                foreach($listaIdiom as $idioma){
                                    
                            ?>
                            <option value="<?php echo $idioma->getId(); ?>"><?php echo $idioma->getNombre()." ".$idioma->getISO_code(); ?></option>
                            <?php
                                }
                                
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            
            <div class="row justify-content-md-center m-3">
                <!-- <div class="col-2"> -->
                    <input type="submit" value="Crear" class="btn btn-primary" name="crearBtn">
                <!-- </div> -->
            </div>

            
        </form>
        <?php
            }else{
                if($vSerieCreada){
        ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                Serie creada correctamente.
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
        <?php
            }
        ?>
        <div class="row justify-content-md-center m-3">
            <!-- <div class="col-2"> -->
                <a href="/views/series/lista.php"><button class="btn btn-danger">Volver</button></a>
            <!-- </div> -->
                            </div>
    
</body>
</html>