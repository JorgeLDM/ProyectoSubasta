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

    <title>Inicio</title>
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
                 
                </button>
                <a class="navbar-brand" href="subastas.php">Venta de Autos S.A</a>
            </div>
            
            <?php
              
              include ("header.php");
            ?>
            
            <?php
          
              include ("sidebar.php");
            ?>

        </nav>

        <div id="page-wrapper">
     
            <div class="container-fluid">

         
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nosotros <small>  </small>
                        </h1>
                        
                    </div>
                </div>

                
<div class="jumbotron">
  <h1 class="display-4">VISIÓN</h1>
  <p class="lead">Ser la empresa referente y mantener la posición de liderazgo en su mercado, manteniendo unos volúmenes que le proporcionen una rentabilidad adecuada para la continuidad de la misma. Ser una empresa guatemalteca de referencia en el sector automotriz en calidad, tecnología, infraestructura, capital humano, rentabilidad y solidez financiera, excediendo las expectativas de clientes, empleados y proveedores.</p>
  <hr class="my-4">
  <p> </p>
  
</div>

<div class="jumbotron">
  <h1 class="display-4">MISIÓN</h1>
  <p class="lead"> Ser una empresa especializada en la comercialización de coches nuevos y usados. Contar con personal altamente cualificado, tecnología punta e infraestructura que garanticen siempre un servicio integral de máxima calidad. Cumplir con los estándares de las marcas, normas ambientales y del entorno social y trabajar por el bienestar y crecimiento de nuestro talento humano.
Nuestra misión está encaminada hacia la excelencia, es decir, hacia la total satisfacción del cliente, así como la de los profesionales que la integran, un comportamiento medioambiental respetuoso y la distinción del liderazgo. </p>
  <hr class="my-4">
  <p>   </p>
 
</div>


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
