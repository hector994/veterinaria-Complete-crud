<?php
require '../../controllers/EspeciesController.php';
require  '../../constantes.php';
$css = CDN_BS_CSS;
$js = CDN_BS_JS;
$icons = CDN_ICONOS;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    editarEspecie($_POST);
}

$data = obtenerEspeciePorId($_GET['id_especie']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar especie</title>
    <?= $css ?>
    <?= $icons ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFC0CB;">
        <a class="navbar-brand" href="../../index.php"> <img src="../../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">Veterinaria UNIVO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-white">
                    <a class="nav-link" href="../especies/index.php">Especies</a>
                </li>
                <li class="nav-item text-white">
                    <a class="nav-link " href="../razas/index.php">Razas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Pacientes</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row p-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Editar especie</h3>
                </div>
                <div class="card-body">
                    <form action="editar.php" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="nombre"><b>Escriba el nombre de la especie:</b></label>
                                <input value="<?= $data[0]->id_especie ?>" hidden class="form-control" type="text" name="id_especie" id="id_especie">
                                <input value="<?= $data[0]->nombre ?>" class="form-control" type="text" name="nombre" id="nombre">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="nombre"><b>Estado de la especie:</b></label>
                                <br>
                                <div class="form-check form-check-inline mt-2">
                                    <input value="1" <?= $data[0]->estado ==  1 ? 'checked': '' ?> class="form-check-input" type="radio" name="estado" id="estado">
                                    <label class="form-check-label" for="nombre"><b>Activo</b></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input value="0" <?= $data[0]->estado ==  0 ? 'checked': '' ?> class="form-check-input" type="radio" name="estado" id="estado">
                                    <label class="form-check-label" for="nombre"><b>Inactivo</b></label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $js ?>
</body>

</html>