<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/veterinaria-php-puro/db/db.php';

function obtenerPacientes()
{
    $query = "SELECT * from tbl_pacientes" ;
    $smt = conectarDb()->prepare($query);
    $smt->execute();
    $data = $smt->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function obtenerRazas()
{
    $query = "SELECT tbl_especies.nombre as especie, tbl_razas.id_raza, tbl_razas.nombre, tbl_razas.estado, tbl_razas.fecha 
    FROM tbl_razas INNER JOIN tbl_especies ON tbl_especies.id_especie = tbl_razas.id_especie";
    $ejecutar = conectarDb()->prepare($query);
    $ejecutar->execute();
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function obtener()
{
    $query = "SELECT * FROM tbl_razas";
    $ejecutar = conectarDb()->prepare($query);
    $ejecutar->execute();
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

function crearRegistroPaciente($post, $files)
{
    $enfermedadesString = '';
    $vacunasString = '';
    foreach ($post['enfermedades'] as $index => $enfermedad) {
        if ($index == (count($post['enfermedades'])  - 1)) {
            $enfermedadesString .= $enfermedad;
            continue;
        }
        $enfermedadesString .= $enfermedad . ", ";
    }

    foreach ($post['vacunas'] as $index => $vacuna) {
        if ($index == (count($post['vacunas'])  - 1)) {
            $vacunasString .= $vacuna;
            continue;
        }
        $vacunasString .= $vacuna . ", ";
    }
    $imagen = guardarImagen($files);

    $query = "INSERT INTO tbl_pacientes 
    (
        nombre, enfermedades, vacunas, id_raza, imagen, fecha_creacion, 
        fecha_actualizacion, creado_por, actualizado_por, fecha
    ) VALUES
    (
        :nombre, :enfermedades, :vacunas, :id_raza, :imagen, :fecha_creacion, 
        :fecha_actualizacion, :creado_por, :actualizado_por, :fecha)";

    $data = [
        ':nombre' => $post['nombre'], ':enfermedades' => $enfermedadesString, ':vacunas' => $vacunasString,
        ':id_raza' => $post['id_raza'], ':imagen' => $imagen, ':fecha_creacion' => date('Y-m-d H:i:s'),
        ':fecha_actualizacion' => date('Y-m-d H:i:s'), ':creado_por' => 1,
        ':actualizado_por' => 1, ':fecha' => date('Y-m-d')
    ];
    $stmt = conectarDb()->prepare($query);
    $stmt->execute($data);
    header('Location: index.php');
}

function guardarImagen($files)
{
    $carpeta = 'imagenes';

    $infoExtension = explode(".", $files["imagenes"]["name"]);
    $extension = $infoExtension[1];

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $aleatorio = substr(str_shuffle($permitted_chars), 0, 10);

    $imagen = $carpeta . "/" . $aleatorio . "." . $extension;
    $tmp = $files["imagenes"]["tmp_name"];

    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777);

        if (!move_uploaded_file($tmp, $imagen)) {
            header('Location: index.php');
        }
    } else {
        if (!move_uploaded_file($tmp, $imagen)) {
            header('Location: index.php');
        }
    }

    return $imagen;
}

function borrarImagen($rutaImagen) {
    // Verificar si la imagen existe
    
    if (file_exists($rutaImagen)) {
        // Intentar eliminar la imagen
        if (unlink($rutaImagen)) {
            echo "La imagen ha sido eliminada con éxito.";
        } else {
            echo "No se pudo eliminar la imagen.";
        }
    } else {
        echo "La imagen no existe en la ruta especificada.";
    }
}

function borrarPaciente($id)
{
    try {
        $query = "DELETE FROM tbl_pacientes WHERE id_paciente = :id_paciente";
        $stmt = conectarDb()->prepare($query);
        $data = [':id_paciente' => $id];
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

function obtenerPacientePorId($id)
{
    $query = "SELECT * FROM tbl_pacientes WHERE id_paciente = :id_paciente";
    $ejecutar = conectarDb()->prepare($query);
    $data = [':id_paciente' => $id];
    $ejecutar->execute($data);
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function obtenerImagen($id)
{
    $query = "SELECT imagen FROM tbl_pacientes WHERE id_paciente = :id_paciente";
    $ejecutar = conectarDb()->prepare($query);
    $data = [':id_paciente' => $id];
    $ejecutar->execute($data);
    $data = $ejecutar->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function editarPaciente($post,$files)
{
    $enfermedadesString = '';
    $vacunasString = '';
    foreach ($post['enfermedades'] as $index => $enfermedad) {
        if ($index == (count($post['enfermedades'])  - 1)) {
            $enfermedadesString .= $enfermedad;
            continue;
        }
        $enfermedadesString .= $enfermedad . ", ";
    }

    foreach ($post['vacunas'] as $index => $vacuna) {
        if ($index == (count($post['vacunas'])  - 1)) {
            $vacunasString .= $vacuna;
            continue;
        }
        $vacunasString .= $vacuna . ", ";
    }

    $imagen = guardarImagen($files);

    $query = "UPDATE tbl_pacientes SET nombre = :nombre, enfermedades = :enfermedades, 
    vacunas = :vacunas, id_raza = :id_raza, imagen = :imagen,
    fecha_actualizacion = :fecha_actualizacion, creado_por = :creado_por, 
    actualizado_por = :actualizado_por
    WHERE id_paciente = :id_paciente";

    $data = [
        ':nombre' => $post['nombre'], ':enfermedades' => $enfermedadesString,
        ':vacunas' => $vacunasString, 'id_raza' => $post['id_raza'], 'imagen' => $imagen,
        ':fecha_actualizacion' => date('Y-m-d H:i:s'), ':creado_por' => 1, ':actualizado_por' => 1, 
        ':id_paciente' => $post['id_paciente']
    ];
    $stmt = conectarDb()->prepare($query);
    $stmt->execute($data);
    header('Location: index.php');
}?>