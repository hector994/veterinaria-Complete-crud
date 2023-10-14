<?php
include $_SERVER['DOCUMENT_ROOT'] . '/veterinaria-php-puro/db/db.php';
function obtenerRazas()
{
    $query = "SELECT tbl_especies.nombre as especie, tbl_razas.id_raza, tbl_razas.nombre, tbl_razas.estado, tbl_razas.fecha 
    FROM tbl_razas INNER JOIN tbl_especies ON tbl_especies.id_especie = tbl_razas.id_especie";
    $ejecutar = conectarDb()->prepare($query);
    $ejecutar->execute();
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);

    return $data;
}


function obtenerEspecies()
{
    $query = "SELECT * FROM tbl_especies";
    $ejecutar = conectarDb()->prepare($query);
    $ejecutar->execute();
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function crearRegistroRaza($post)
{
    $query = "INSERT INTO tbl_razas 
    (
        nombre, estado, creado_por, actualizado_por, fecha, fecha_creacion, fecha_actualizacion, id_especie
    ) VALUES
    (
        :nombre, :estado, :creado_por, :actualizado_por, :fecha_creacion, :fecha_actualizacion, :fecha, :id_especie)";

    $data = [
        ':nombre' => $post['nombre'], ':estado' => 1, ':creado_por' => 1, ':actualizado_por' => 1,
        ':fecha_creacion' => date('Y-m-d H:i:s'), ':fecha_actualizacion' => date('Y-m-d H:i:s'), ':fecha' => date('Y-m-d'),
        ':id_especie' => $post['id_especie']
    ];
    $stmt = conectarDb()->prepare($query);
    $stmt->execute($data);
    header('Location: index.php');
}

function borrarRaza($id)
{

    try {
        $query = "DELETE FROM tbl_razas WHERE id_raza = :id_raza";
        $stmt = conectarDb()->prepare($query);
        $data = [':id_raza' => $id];
        $stmt->execute($data);
        header('Location: index.php');
    } catch (PDOException $e) {
        $_SESSION['error'] = "error";
        $_SESSION['error-message'] = "<script>
            Swal.fire({
                title: 'Error',
                text: '" . $e->getMessage() . "',
                showCancelButton: true,
                icon: 'error',
                confirmButtonText: 'Continuar',
                cancelButtonText: `Cancelar`,
            })
        </script>";
    }
}

function obtenerRazaPorId($id)
{
    $query = "SELECT * FROM tbl_razas WHERE id_raza = :id_raza";
    $ejecutar = conectarDb()->prepare($query);
    $data = [':id_raza' => $id];
    $ejecutar->execute($data);
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function editarRaza($post)
{
    $query = "UPDATE tbl_razas SET nombre = :nombre, estado = :estado, creado_por = :creado_por,
    actualizado_por = :actualizado_por, fecha_actualizacion = :fecha_actualizacion, id_especie = :id_especie
    WHERE id_raza = :id_raza";

    $data = [
        ':nombre' => $post['nombre'], ':estado' => $post['estado'], ':creado_por' => 1, ':actualizado_por' => 1,
        ':fecha_actualizacion' => date('Y-m-d H:i:s'), ':id_especie' => $post['id_especie'], ':id_raza' => $post['id_raza']
    ];
    $stmt = conectarDb()->prepare($query);
    $stmt->execute($data);
    header('Location: index.php');
}

?>