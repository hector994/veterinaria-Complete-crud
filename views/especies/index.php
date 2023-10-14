<?php
require '../../controllers/EspeciesController.php';
require '../../constantes.php';
$data = obtenerEspecies();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_especie_eliminar'])) {
    borrarEspecie($_POST['id_especie_eliminar']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_especie'])) {
    header('Location: editar.php?id_especie=' . $_POST['id_especie']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especies</title>
    <?= CDN_BS_CSS ?>
    <?= CDN_ICONOS ?>
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
                    <a class="nav-link" href="index.php">Especies</a>
                </li>
                <li class="nav-item text-white">
                    <a class="nav-link " href="../razas/index.php">Razas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pacientes/index.php">Pacientes</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row p-4">
        <div class="col-md-11">
            <h1>Listado de especies</h1>
        </div>
        <div class="col-md-1 text-right">
            <a href="insert.php" class=" btn btn-primary text-center">Crear &nbsp; <i class="fas fa-plus"></i></a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Listado de especies</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-stripped">
                        <thead class="thead-dark text-center">
                            <th>Nombre: </th>
                            <th>Estado: </th>
                            <th>Fecha creacion: </th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $especie) {
                            ?>
                                <tr>
                                    <td><?= $especie->nombre ?></td>
                                    <td class="text-white text-center">
                                        <span class="p-2 badge bg-<?= $especie->estado == 1 ? "success" : "danger"; ?>">
                                            <?= $especie->estado == 1 ? "Activo" : "Inactivo"; ?>
                                        </span>
                                    </td>
                                    <td><?= $especie->fecha ?></td>
                                    <td>
                                        <div class="col-md-12 d-flex justify-content-around">
                                            <form action="index.php" method="post" id="form-borrar-especie-<?= $especie->id_especie ?>">
                                                <input type="hidden" name="id_especie_eliminar" value="<?= $especie->id_especie ?>">
                                                <button class="btn btn-danger" id="borrar-especie" data-id="<?= $especie->id_especie ?>"><i class="fas fa-trash"></i></button>
                                            </form>
                                            <form action="index.php" method="post">
                                                <input type="hidden" name="id_especie" value="<?= $especie->id_especie ?>">
                                                <button class="btn btn-warning"><i class="fas fa-pencil"></i></button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<?= CDN_BS_JS ?>
<?= CDN_SWEETALERT ?>
<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error-message'];
    unset($_SESSION['error']);
    unset($_SESSION['error-message']);
}
?>
<script>
    let botonesBorrar = document.querySelectorAll('#borrar-especie');
    let botonesActualizar = document.querySelectorAll('#actualizar-especie');

    botonesBorrar.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault()
            Swal.fire({
                title: 'Estas seguro de eliminar este registro?',
                showCancelButton: true,
                icon: 'error',
                confirmButtonText: 'Continuar',
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById(`form-borrar-especie-${item.dataset.id}`)
                    form.submit();
                }
            })
        })
    })
</script>

</html>