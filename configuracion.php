<?php

  include ("conexion/Conexion.php");

  $bd = new Conexion();

  session_start();

  if(($_SESSION["id_usuario"] =="")){

    header("Location: login.php");
  
  }

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proyecto">
    <meta name="author" content="Jorge Duarte">

    <title>Configuración</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">

    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

	<body background="imagenes/subasta.png" width="65px">
		
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    
                </button>
               <a class="navbar-brand" href="subastas.php">Venta de Autos S.A</a>
            </div>
            <!-- Top Menu Items -->
            <?php
              include ("header.php");
            ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php
              include ("sidebar.php");
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Configuración <small>Venta de Autos S.A</small>
                        </h1>
                        
                    </div>
                </div>
                
			<section>
				<div id="contenedor">
					<?php
                        if($_SESSION["administrador"] != "0"){
                    ?>
							<h2>Opciones de Administrador:</h2>

							
                            <div class="col-lg-9">
							<a href="./alta_subasta.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true">   Iniciar una Subasta</a>
</br>
</br>                       
							<a href="./alta_categoria.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true"> Agregar una Categoría </a>

							</br>    </br>

                            <a href="./listar_usuarios.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true"> Listar Usuarios </a>

                            </br>
                            </br>

                            <a href="./reportes.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true"> Reportes </a>

                            </br>
                                </div>
					<?php
						}
					?>
					

				</div>
                
				<h2>Opciones de Clientes:</h2>

				<a href="perfil.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true"> Modificar perfil </a>
</br>
</br>
				</div>
		<footer>
			
		</footer>

		<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	</body>
</html>
