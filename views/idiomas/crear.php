<?php
    require_once('../../controllers/idiomas/idiomasControlador.php');
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
            <li class="nav-item">
                <a class="nav-link" href="/views/actores/lista.php">Actores </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/views/idiomas/lista.php">Idiomas </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Series </a>
            </li>
            
          </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h2 class="text-center">Crear idiomas</h2>
        </div>
    </div>
    <div class="container">
        <?php
            $vEnviado = false;
            $vIdiomaCreado = false;
            if(isset($_POST['crearBtn'])){
                $vEnviado = true;
            }
            if($vEnviado){
                if(isset($_POST['nombreidiomas'])){
                    $vIdiomaCreado = guardaridiomas($_POST['nombreidiomas'], $_POST['ISO_code']);
                }
            }

            if(!$vEnviado){
        ?>
        <form name="crear_idiomas" action="" method="POST">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="nombreidiomas" class="form-label">Nombre idioma</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="nombreidiomas" id="nombreidiomas" type="text"
                            placeholder="Intrudice el nombre" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="iSO_codeidiomas" class="form-label">Codigo ISO</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="ISO_code" id="ISO_codeidiomas" type="text"
                            placeholder="Intrudice el ISO_code" class="form-control" required>
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
                if($vIdiomaCreado){
        ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                idiomas creada correctamente.
            </div>
        </div>
        <?php
                }else{

                
        ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Algo salio mal! Verifique que el nombre del idioma no este repetido.
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
                <a href="/views/idiomas/lista.php"><button class="btn btn-danger">Volver</button></a>
            <!-- </div> -->
        </div>
    </div>
    
</body>
</html>