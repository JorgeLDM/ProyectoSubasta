<!DOCTYPE html>
<html lang="es">
	<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proyecto">
    <meta name="author" content="Jorge Duarte">

    <title>Inicio</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

	<nav>
		<div id='barraNav'>
			<a href="./index.php"><img id='nav_logo' src="./imagenes/bestnid/logo.png"></a>
			<a href="./index.php"><div class="nav_boton">Bestnid</div></a>
			<?php
				if(!isset($_SESSION)) {
					session_start();
				}
				if(!isset($_SESSION['usuario'])) {
			?>
				<div id="nav_derecha" style="width: 465px;">
					<a href="./registro.php"><div class="nav_boton">Registrarse</div></a>
					<a href="./recuperar_clave.php"><div class="nav_boton">Recuperar clave</div></a>
					<form method="POST" name="iniciarsesion" action="./sistema/iniciar_sesion.php">
						<div class="nav_sesion">
							<input type="email" id="emailmenu" name="usermenu" placeholder="Correo"></br>
							<input type="password" id="passmenu" name="passmenu" placeholder="Clave">
						</div>
						<div id="ingresar">
							<input type="button" value="Ingresar" onclick="valida()">
						</div>
					</form>
				</div>
			<?php
				}
				else {
			?>
				<div style="margin-left: 75px;" class="nav_boton"><b> Bienvenido: 
					<div style="color: #3b5998; display: inline-block;">
					<?php 
						if(!isset($_SESSION)) {
							session_start();
						}
						echo $_SESSION['mail'];
					?>
					</div>
				</b></div>
				<div id="nav_derecha">
					<a href="./configuracion.php"><div class="nav_boton">Configuracion</div></a>
					<a href="./sistema/cerrar_sesion.php"><div class="nav_boton">Cerrar sesion</div></a>
				</div>
			<?php					
				}
			?>
		</div>
	</nav>
	
</html>