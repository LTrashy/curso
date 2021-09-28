<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validar formulario</title>
	<style>
		body{background-color: #264673; box-sizing: border-box; font-family: Arial;}

		form{
			background-color: white;
			padding: 10px;
			margin: 100px auto;
			width: 400px;
		}

		input[type=text], input[type=password]{
			padding: 10px;
			width: 380px;
		}
		input[type="submit"]{
			border: 0;
			background-color: #ED8824;
			padding: 10px 20px;
		}

		.error{
			background-color: #FF9185;
			font-size: 12px;
			padding: 10px;
		}
		.correcto{
			background-color: #A0DEA7;
			font-size: 12px;
			padding: 10px;
		}
	</style>
</head>
<body>
	<form action="validacion.php" method="POST">
		<?php
			$nombre = "";
			$password = "";
			$email = "";
			$pais = "";
			$nivel = "";
			$lenguajes= array();

			if(isset($_POST['nombre'])){
				$nombre = $_POST['nombre'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$pais = $_POST['pais'];
				
				if(isset($_POST['nivel'])){
					$nivel=	$_POST['nivel'];
				}else{
					$nivel="";
				}

				if(isset($_POST['lenguajes'])){
					$lenguajes = $_POST['lenguajes'];
				}else{
					$lenguajes= "";
				}

				$campos = array();

				if($nombre == ""){
					array_push($campos, "El campo Nombre no pude estar vacío");
				}

				if($password == "" || strlen($password) < 6){
					array_push($campos, "El campo Password no puede estar vacío, ni tener menos de 6 caracteres.");
				}

				if($email == "" || strpos($email, "@") === false){
					array_push($campos, "Ingresa un correo electrónico válido.");
				}
				
				if($pais == ""){
					array_push($campos, "Ingresa un pais de origen.");
				}
				
				if($nivel == ""){
					array_push($campos, "Selecciona un nivel de desarrollo.");
				}
				
				if($lenguajes == "" || count($lenguajes) < 2 ){
					array_push($campos, "Selecciona al menos dos lenguajes.");
				}

				if(count($campos) > 0){
					echo "<div class='error'>";
					for($i = 0; $i < count($campos); $i++){
						echo "<li>".$campos[$i]."</i>";
					}
				}else{
					echo "<div class='correcto'>
							Datos correctos";
				}
				echo "</div>";
			}
		?>
		<p>
		Nombre:<br/>
		<input type="text" name="nombre" value="<?= $nombre; ?>">
		</p>

		<p>
		Password:<br/>
		<input type="password" name="password" value="<?= $password; ?>">
		</p>

		<p>
		correo electrónico:<br/>
		<input type="text" name="email" value="<?= $email; ?>">
		</p>

		<p>
		Pais de Origen: <br>
		<select name="pais" id="">
			<option value="">Selecciona un pais</option>
			<option value="mx" <?=($pais == "mx")?"selected":""?>>Mexico</option>
			<option value="eu"<?=($pais == "eu") ? "selected" : ""?>>Estados unidos</option>
			<option value="es"<?=($pais == "es") ? "selected" : ""?>>España</option>
			<option value="ar"<?=($pais == "ar") ? "selected" : ""?>>Argentina</option>
			<option value="ch"<?=($pais == "ch") ? "selected" : ""?>>China</option>

		</select>
		</p>
		<p>
			Nivel de desarrollo: <br>
			<input type="radio" name="nivel" value="principiante" <?=($nivel == "principiante")?"checked":""; ?>> Principiante
			<input type="radio" name="nivel" value="intermedio" <?=($nivel == "intermedio") ? "checked":""; ?>> Intermedio
			<input type="radio" name="nivel" value="avanzado" <?=($nivel == "avanzado") ? "checked":""; ?>> Avanzado

		</p>
		<p>
			Lenguajes de programacion <br>
			<input type="checkbox" name="lenguajes[]" value="php" <?=(in_array("php",$lenguajes)) ? "checked":""?>> PHP <br> 
			<input type="checkbox" name="lenguajes[]" value="js" <?=(in_array("js",$lenguajes)) ? "checked":""?>> Javascript <br> 
			<input type="checkbox" name="lenguajes[]" value="java"<?=(in_array("java",$lenguajes)) ? "checked":""?>> Java <br> 
			<input type="checkbox" name="lenguajes[]" value="swift"<?=(in_array("swift",$lenguajes)) ? "checked":""?>> Swift <br> 
			<input type="checkbox" name="lenguajes[]" value="py" <?=(in_array("py",$lenguajes)) ? "checked":""?>> Python <br> 
		</p>

		<p><input type="submit" value="enviar datos"></p> 
	</form>
</body>
</html>