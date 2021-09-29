<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <h1 class="center">Seccion de Consulta</h1>

        <table width="100%">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include_once 'models/alumno.php';
                    foreach($this->alumnos as $row){
                        $alumno = new Alumno();
                        $alumno = $row;
                    
                ?>
                <tr>
                    <td><?php echo $alumno->matricula; ?></td></td>
                    <td><?php echo $alumno->nombre; ?></td>
                    <td><?php echo $alumno->apellido; ?></td>
                    <td><a href="<?php echo constant('URL')."consulta/verAlumno/". $alumno->matricula; ?>">Edit</a></td>
                    <td><a href="<?php echo constant('URL')."consulta/eliminarAlumno/". $alumno->matricula;?>">Delete</a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <!-- <?php echo var_dump($this->alumnos);?> -->
    </div>
    <?php require 'views/footer.php'; ?>
</body>
</html>