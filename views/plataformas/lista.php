
<?php
    require_once('../../controllers/plataforma/PlataformaControlador.php');
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
            <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link" href="/views/series/lista.php">Series </a>
            </li>
            
          </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h2 class="text-center">Lista De Plataformas</h2>
        </div>
    </div>
    <div class="row m-3">
        <div class="col-12">
        <a href="/views/plataformas/crear.php">
            <button type="button" class="btn btn-success">Crear Plataforma</button>
        </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php
                $listaPlataformas = traerPlataformas();

                if(count($listaPlataformas) > 0){
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Slogan</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($listaPlataformas as $plat){
                    ?>
                    <tr>
                        <td><?php echo $plat->getId() ?></td>
                        <td><?php echo $plat->getNombre() ?></td>
                        <td><?php echo $plat->getSlogan() ?></td>
                        <td>
                            <a class="btn btn-warning" 
                                href="/views/plataformas/editar.php?id=
                                <?php echo $plat->getId(); ?>">Editar</a>
                            <a class="btn btn-danger"
                                href="/views/plataformas/eliminar.php?id=
                                <?php echo $plat->getId(); ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <?php
                }else{
            ?>
                <div class="alert alert-warning" role="alert">
                    Aún no existen plataformas
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>