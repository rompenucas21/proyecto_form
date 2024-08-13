<?php 
include 'coneccion_bd.php';

// Función para sanitizar y escapar datos
function sanitize_input($data) {
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($data)));
}

// Consultar alumnos
$sql_alumnos = "SELECT * FROM alumnos";
$result_alumnos = $conn->query($sql_alumnos);
if (!$result_alumnos) {
    die("Error en la consulta de alumnos: " . $conn->error);
}

// Consultar profesores
$sql_profesores = "SELECT * FROM profesores";
$result_profesores = $conn->query($sql_profesores);
if (!$result_profesores) {
    die("Error en la consulta de profesores: " . $conn->error);
}

// Consultar materias
$sql_materias = "SELECT * FROM materias";
$result_materias = $conn->query($sql_materias);
if (!$result_materias) {
    die("Error en la consulta de materias: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Registros</title>
    <link rel="stylesheet" href="e.css">
</head>
<body>
    <div class="grande">
        <h1>Registro de Alumnos</h1>
        <table border="1">
            <tr>
                <th>Universidad</th>
                <th>ID</th>
                <th>Dirección</th>
                <th>Carrera</th>
                <th>Teléfono</th>
                <th>Cuatrimestre</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Foto</th>
            </tr>
            <?php if ($result_alumnos->num_rows > 0): ?>
                <?php while ($row = $result_alumnos->fetch_assoc()): ?>
                    <tr>
                    <td><?php echo sanitize_input($row['universidad']); ?></td>
                        <td><?php echo sanitize_input($row['id']); ?></td>
                        <td><?php echo sanitize_input($row['direccion']); ?></td>
                        <td><?php echo sanitize_input($row['carrera']); ?></td>
                        <td><?php echo sanitize_input($row['telefono']); ?></td>
                        <td><?php echo sanitize_input($row['cuatrimestre']); ?></td>
                        <td><?php echo sanitize_input($row['nombre']); ?></td>
                        <td><?php echo sanitize_input($row['apellido_paterno']); ?></td>
                        <td><?php echo sanitize_input($row['apellido_materno']); ?></td>
                        <td>
                            <?php if ($row['foto']): ?>
                                <img src="uploads/<?php echo sanitize_input($row['foto']); ?>" alt="Foto Alumno" width="100">
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="10">No se encontraron registros.</td></tr>
            <?php endif; ?>
        </table>

        <h1>Registro de Profesores</h1>
        <table border="1">
            <tr>
            <th>Universidad</th>
                <th>ID Docente</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Formación Académica</th>
                <th>Experiencia</th>
                <th>Foto</th>
            </tr>
            <?php if ($result_profesores->num_rows > 0): ?>
                <?php while ($row = $result_profesores->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo sanitize_input($row['universidad']); ?></td>
                        <td><?php echo sanitize_input($row['id_docente']); ?></td>
                        <td><?php echo sanitize_input($row['direccion']); ?></td>
                        <td><?php echo sanitize_input($row['telefono']); ?></td>
                        <td><?php echo sanitize_input($row['nombre']); ?></td>
                        <td><?php echo sanitize_input($row['apellido_paterno']); ?></td>
                        <td><?php echo sanitize_input($row['apellido_materno']); ?></td>
                        <td><?php echo sanitize_input($row['formacion_academica']); ?></td>
                        <td><?php echo sanitize_input($row['experiencia']); ?></td>
                        <td>
                            <?php if ($row['foto']): ?>
                                <img src="uploads/<?php echo sanitize_input($row['foto']); ?>" alt="Foto Profesor" width="100">
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="10">No se encontraron registros.</td></tr>
            <?php endif; ?>
        </table>

        <h1>Registro de Materias</h1>
        <table border="1">
            <tr>
                <th>Inglés</th>
                <th>Matemáticas</th>
                <th>Español</th>
                <th>Geografía</th>
                <th>Ciencias</th>
            </tr>
            <?php if ($result_materias->num_rows > 0): ?>
                <?php while ($row = $result_materias->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo sanitize_input($row['ingles']); ?></td>
                        <td><?php echo sanitize_input($row['matematicas']); ?></td>
                        <td><?php echo sanitize_input($row['espanol']); ?></td>
                        <td><?php echo sanitize_input($row['geografia']); ?></td>
                        <td><?php echo sanitize_input($row['ciencias']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No se encontraron registros.</td></tr>
            <?php endif; ?>
        </table>
        </div>
</body>
</html>

<?php $conn->close(); ?>