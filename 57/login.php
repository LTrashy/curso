<?php
    include_once 'db.php';
    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: admin.php');
                break;
            
            case 2:
                header('location: colab.php');
                break;
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];


        $db = new DB();
        $query = $db->connect()->prepare('SELECT*FROM usuarios WHERE username = :username AND password = :password');
        $query->execute(['username' => $username,
                         'password' => $password]);

        $row = $query->fetch(PDO::FETCH_NUM);
        // var_dump($row);
        // die();
        if($row == true){
            //validar rol
            $rol = $row[1];
            $_SESSION['rol'] = $rol;

            switch($_SESSION['rol']){
                case 1:
                    header('location: admin.php');
                    break;
                
                case 2:
                    header('location: colab.php');
                    break;
            }
        }else{
            echo "El usuario o contraseña son incorrectos";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOgin</title>
</head>
<style>
                    body{
                font-family: Arial, Helvetica, sans-serif;
            }
            form{
                background-color: purple;
                margin: 0 auto;
                width: 400px;
                padding: 20px;
            }

            input{
                border: solid 0;
                border-radius: 3px;
            }

            input[type=text], input[type=password]{
                padding: 10px;
                font-size: 18px;
                outline: none;
                width: 370px;
            }
            input[type=submit]{
                background-color: black;
                color: white;
                padding: 8px;
                border: none;
                width: 200px;
                text-align: center;
            }
            .center{
                text-align: center;
            }

            .opcion{
                padding: 5px 0;
            }

            .barra{
                background-color:rgb(152, 196, 236);
                border-radius: 4px;
                padding: 10px;
            }

            .seleccionado{
                background-color: rgb(33, 90, 143);
                border-radius: 4px;
                color: white;
                padding: 10px;
            }

            #menu{
                background-color: #eee;
                padding: 10px;
            }
            #menu ul{
                margin: 0;
                padding: 0;
                list-style: none;
                display: inline-block;
                width: 100%;
            }
            #menu ul li{
                display: inline;
            }
            #menu ul li a{
                color: #1E69E3;
                text-decoration: none;
            }
            #menu ul li a:hover{
                color: rgb(227, 109, 30);
                text-decoration: none;
            }
            .cerrar-sesion{
                float: right;
            }
	</style>
<body>
    <form action="#" method="post">
        <p>
            Username: <br><input type="text" name="username"><br>
        </p>
        <p>
            Password: <br><input type="text" name="password"><br>
        </p>
        <p class="center">
            <input type="submit" value="Iniciar secion">
        </p>
    </form>
</body>
</html>