<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id="main-container">
        <form action="" method="POST" id="nuevo-pendiente-container">
            <P>
                QUE HACER <br>
                <input type="text" name="todo" id="todo">
            </P>
            <p>
                <input type="button" id="bEnviar" value="Añadir todo">

            </p>
        </form>
    </div>

    <div id="mostrar-todo-container">
        
    </div>

    <script src="main.js"></script>
    <script>
        cargarTodos();
    </script>
    
</body>
</html>