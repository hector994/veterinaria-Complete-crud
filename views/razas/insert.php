<?php
require '../../controllers/RazasController.php';
require  '../../constantes.php';
$css = CDN_BS_CSS;
$js = CDN_BS_JS;
$icons = CDN_ICONOS;

$data = obtenerEspecies();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    crearRegistroRaza($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear raza</title>
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
                    <h3 class="text-white">Crear raza</h3>
                </div>
                <div class="card-body">
                    <form action="insert.php" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="nombre"><b>Escriba el nombre de la raza:</b></label>
                                <input required class="form-control" type="text" name="nombre" id="nombre">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="nombre"><b>Seleccione la especie:</b></label>
                                <select name="id_especie" required class="form-control">
                                    <option value="" disabled selected>-- Seleccione la especie --</option>
                                    <?php foreach ($data as $especie) { ?>
                                        <option value="<?=$especie->id_especie?>"><?=$especie->nombre?></option>
                                    <?php } ?>
                                </select>
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