<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nuevo</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <h1 class="center">Detalle de <?php echo $this->alumno->matricula;?></h1>

        <div class="center"><?php echo $this->mensaje;?></div>
        
        <form action="<?php echo constant('URL');?>consulta/actualizarAlumno" method="POST" class="center">

            <P>
                <label for="matricula">Matricula</label><br>
                <input type="text" name="matricula" disabled value="<?php echo $this->alumno->matricula;?>" required>

            </P>
            <P>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo $this->alumno->nombre;?>" required>

            </P>
            <P>
                <label for="apellido">Apellido</label><br>
                <input type="text" name="apellido" value="<?php echo $this->alumno->apellido;?>" required><br><br>

            </P>

            <p>
                <input type="submit" value="Actualizar Alumno">
            </p>

        </form>
    </div>
    <?php require 'views/footer.php'; ?>
</body>
</html>