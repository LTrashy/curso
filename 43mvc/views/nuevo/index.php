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
        <h1 class="center">Nuevo</h1>

        <div class="center"><?php echo $this->mensaje;?></div>
        
        <form action="<?php constant('URL')?>nuevo/registrarAlumno" method="POST" class="center">

            <P>
                <label for="matricula">Matricula</label><br>
                <input type="text" name="matricula" required>

            </P>
            <P>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" required>

            </P>
            <P>
                <label for="apellido">Apellido</label><br>
                <input type="text" name="apellido" required><br><br>

            </P>

            <p>
                <input type="submit" value="Registrar nuevo Alumno">
            </p>

        </form>
    </div>
    <?php require 'views/footer.php'; ?>
</body>
</html>