<?php
    require_once('../../controllers/director/directorControlador.php');
    
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
            <li class="nav-item active">
                <a class="nav-link" href="/views/directores/lista.php">Directores </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/views/actores/lista.php">Actores </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/views/idiomas/lista.php">Idiomas </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/views/series/lista.php">Series </a>
            </li>
            
          </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h2 class="text-center">Crear Directores</h2>
        </div>
    </div>
    <div class="container">
        <?php
            $vEnviado = false;
            $vDirectorCreado = false;
            if(isset($_POST['crearBtn'])){
                $vEnviado = true;
            }
            if($vEnviado){
                if(isset($_POST['dniDirector'])){
                    $vDirectorCreado = guardarDirector($_POST['nombreDirector'], $_POST['apellidosDirector'], $_POST['dniDirector'], $_POST['fechaNacDirector'], $_POST['nacionalidadDirector']);
                }
            }

            if(!$vEnviado){
        ?>
        <form name="crear_director" action="" method="POST">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="dniDirector" class="form-label">DNI Director</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="dniDirector" id="dniDirector" type="text"
                            placeholder="Introduce el dni" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="nombreDirector" class="form-label">Nombre Director</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="nombreDirector" id="nombreDirector" type="text"
                            placeholder="Introduce el nombre" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="apellidosDirector" class="form-label">Apellidos Director</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="apellidosDirector" id="apellidosDirector" type="text"
                            placeholder="Introduce el apellido" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="nacionalidadDirector" class="form-label">Nacionalidad Director</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="nacionalidadDirector" id="nacionalidadDirector" type="text"
                            placeholder="Introduce la nacionalidad" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <label for="fechaNacDirector" class="form-label">Fecha Nacimiento</label>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <input name="fechaNacDirector" id="fechaNacDirector" type="date"
                            placeholder="Introduce la fecha de nacimiento" class="form-control" required>
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
                if($vDirectorCreado){
        ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                Director creado correctamente.
            </div>
        </div>
        <?php
                }else{

                
        ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Algo salio mal! Verifique que el dni del director no este repetido.
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
                <a href="/views/directores/lista.php"><button class="btn btn-danger">Volver</button></a>
            <!-- </div> -->
        </div>
    </div>
    
</body>
</html>