<?php
require '../../controllers/PacientesController.php';
require  '../../constantes.php';
$css = CDN_BS_CSS;
$js = CDN_BS_JS;
$icons = CDN_ICONOS;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    editarPaciente($_POST, $_FILES);
}
$data = obtenerPacientes();
$obtenerrazas = obtenerRazas();
$obtener = obtener();
$dataPaciente = obtenerPacientePorId($_GET['id_paciente']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear paciente</title>
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
                    <h3 class="text-white">editar paciente</h3>
                </div>
                <div class="card-body">
                    <form action="editar.php" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="nombre"><b>Escriba el nombre del paciente:</b></label>
                                <input value="<?= $dataPaciente[0]->id_paciente ?>" hidden class="form-control" type="text" name="id_paciente" id="id_paciente">
                                <input value="<?= $dataPaciente[0]->nombre ?>" class="form-control" type="text" name="nombre" id="nombre">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="enfermedades"><b>Seleccione las enfermedades:</b></label><br>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->enfermedades,'Sarna') ? 'checked' : '' ?> class="form-check-input" value="Sarna" type="checkbox" name="enfermedades[]" id="enfermedades">
                                    <label class="form-check-label" for="enfermedades">Sarna</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->enfermedades,'Rabia') ? 'checked' : '' ?> class="form-check-input" value="Rabia" type="checkbox" name="enfermedades[]" id="enfermedades">
                                    <label class="form-check-label" for="enfermedades">Rabia</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->enfermedades,'Gripe') ? 'checked' : '' ?> class="form-check-input" value="Gripe" type="checkbox" name="enfermedades[]" id="enfermedades">
                                    <label class="form-check-label" for="enfermedades">Gripe</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->enfermedades,'Jiote') ? 'checked' : '' ?> class="form-check-input" value="Jiote" type="checkbox" name="enfermedades[]" id="enfermedades">
                                    <label class="form-check-label" for="enfermedades">Jiote</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->enfermedades,'Ninguna') ? 'checked' : '' ?> class="form-check-input" value="Ninguna" type="checkbox" name="enfermedades[]" id="enfermedades">
                                    <label class="form-check-label" for="enfermedades">Ninguna</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="vacunas"><b>Seleccione las vacunas:</b></label><br>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->vacunas,'Sarna') ? 'checked' : '' ?> class="form-check-input" value="Sarna" type="checkbox" name="vacunas[]" id="vacunas">
                                    <label class="form-check-label" for="vacunas">Sarna</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->vacunas,'Rabia') ? 'checked' : '' ?> class="form-check-input" value="Rabia" type="checkbox" name="vacunas[]" id="vacunas">
                                    <label class="form-check-label" for="vacunas">Rabia</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->vacunas,'Gripe') ? 'checked' : '' ?> class="form-check-input" value="Gripe" type="checkbox" name="vacunas[]" id="vacunas">
                                    <label class="form-check-label" for="vacunas">Gripe</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->vacunas,'Jiote') ? 'checked' : '' ?> class="form-check-input" value="Jiote" type="checkbox" name="vacunas[]" id="vacunas">
                                    <label class="form-check-label" for="vacunas">Jiote</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input <?=str_contains($dataPaciente[0]->vacunas,'Ninguna') ? 'checked' : '' ?> class="form-check-input" value="Ninguna" type="checkbox" name="vacunas[]" id="vacunas">
                                    <label class="form-check-label" for="vacunas">Ninguna</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="nombre"><b>Seleccione la raza:</b></label>
                                <select  name="id_raza"  class="form-control">
                                    <option value="" disabled selected>-- Seleccione la raza --</option>
                                    <?php foreach ($obtener as $raza) { 
                                        if ($dataPaciente[0]->id_raza == $raza->id_raza) {
                                            echo '<option selected value="' . $raza->id_raza . '">' . $raza->nombre . '</option>';
                                            continue;
                                        }
                                    ?>
                                        <option value="<?= $raza->id_raza ?>"><?= $raza->nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="imagenes"><b>Seleccionar imagen</b></label>
                                <input value="<?=$data[0]->imagen?>" class="form-control" type="file" name="imagenes" id="imagenes">
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