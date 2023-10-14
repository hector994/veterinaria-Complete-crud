<?php
include $_SERVER['DOCUMENT_ROOT'] . '/veterinaria-php-puro/db/db.php';

function obtenerEspecies()
{
    $query = "SELECT * FROM tbl_especies";
    $ejecutar = conectarDb()->prepare($query);
    $ejecutar->execute();
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function crearRegistroEspecie($post)
{
    $query = "INSERT INTO tbl_especies 
    (
        nombre, estado, creado_por, actualizado_por, fecha, fecha_creacion, fecha_actualizacion
    ) VALUES
    (
        :nombre, :estado, :creado_por, :actualizado_por, :fecha_creacion, :fecha_actualizacion, :fecha)";

    $data = [
        ':nombre' => $post['nombre'], ':estado' => 1, ':creado_por' => 1, ':actualizado_por' => 1,
        ':fecha_creacion' => date('Y-m-d H:i:s'), ':fecha_actualizacion' => date('Y-m-d H:i:s'), ':fecha' => date('Y-m-d')
    ];
    $stmt = conectarDb()->prepare($query);
    $stmt->execute($data);
    header('Location: index.php');
}

function borrarEspecie($id)
{
    try {
        $query = "DELETE FROM tbl_especies WHERE id_especie = :id_especie";
        $stmt = conectarDb()->prepare($query);
        $data = [':id_especie' => $id];
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

function obtenerEspeciePorId($id)
{
    $query = "SELECT * FROM tbl_especies WHERE id_especie = :id_especie";
    $ejecutar = conectarDb()->prepare($query);
    $data = [':id_especie' => $id];
    $ejecutar->execute($data);
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function editarEspecie($post)
{
    $query = "UPDATE tbl_especies SET nombre = :nombre, estado = :estado, creado_por = :creado_por,
    actualizado_por = :actualizado_por, fecha_actualizacion = :fecha_actualizacion
    WHERE id_especie = :id_especie";

    $data = [
        ':nombre' => $post['nombre'], ':estado' => $post['estado'], ':creado_por' => 1, ':actualizado_por' => 1,
        ':fecha_actualizacion' => date('Y-m-d H:i:s'), ':id_especie' => $post['id_especie']
    ];
    $stmt = conectarDb()->prepare($query);
    $stmt->execute($data);
    header('Location: index.php');
}

?>