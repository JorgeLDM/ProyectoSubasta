<?php
  
  include ("conexion/Conexion.php");
 
  $bd = new Conexion();
  
  session_start();
 
  if(!isset($_SESSION["id_usuario"])){
   
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reportes</title>

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">

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
            <?php
              include ("header.php");
            ?>
           
            <?php
              include ("sidebar.php");
            ?>

             </nav>
         <?php
                  
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=0");
                  $data=mysqli_fetch_array($res_count);
                  $count_sub = $data['total'];

                               
                  $res_count=$bd->select("SELECT count(*) as total from subasta where comprador and subastador=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_sub_act = $data['total'];
                  
                
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=1 and subastador=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_sub_cerr = $data['total'];


                  $res_count=$bd->select("SELECT SUM(oferta) as total from oferta where estado=1");
                  $data=mysqli_fetch_array($res_count);
                  $count_oferta = $data['total'];
                
                ?>





  <div id="page-wrapper">
     
            <div class="container-fluid">

         
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Reportes <small>  </small>
                        </h1>
                        
                    </div>
                </div>
                 <?php
                    if($_SESSION["administrador"] != "0"){
                    ?>                     

<div class="jumbotron">
  <h3 class="display-4">Total de subastas activas: <?php echo $count_sub;

                                        ?></h3>

    <h3 class="display-4">Total de subastas terminadas: <?php echo $count_sub_cerr;
                                        ?></h3> 

    <h3 class="display-4">Total de dinero: Q<?php echo $count_oferta;
                            
                                        ?></h3> 


  <p class="lead"></p>
  <hr class="my-4">
  <p> </p>
   <div class="thumbnail">

<div class="table-responsive">                    
      <table  class="table table-bordered table-dark table-hover" border="5">
        <thead class="table table-striped" border="5">
    
            <tr>
                <th scope="row">Número de Subasta</th>
                <th scope="col">Nombre del comprador</th>
                <th scope="col">Correlativo Vehículo</th>
                    
            </tr>
        </thead>

      <tbody>

        <?php
                  
                  $res = $bd->select("SELECT * from subasta INNER JOIN usuario ON comprador = id_usuario");

                     if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                                      		
                     
       ?>
            <tr>
                <td><?php echo $row['id_subasta']; ?> </td>
                <td><?php echo $row['nombre']; ?> </td>
                <td><?php echo $row['id_carro']; ?> </td>
					
			</tr>
           
        <?php
                           } 
                                    }
                                   
              
 		?>

      </tbody>
    </table>

    <div class="table-responsive">                    
      <table  class="table table-bordered table-dark table-hover" border="5">
        <thead class="table table-striped" border="5">
    
            <tr>
                <th scope="col">Número de Subasta</th>
                <th scope="row">Número de Comprador</th>
                <th scope="col">Cantidad</th>
                    
            </tr>
        </thead>

      <tbody>

        <?php
                  
                  $res = $bd->select("SELECT * from oferta where estado = 1");

                     if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                                          
                     
       ?>
            <tr>
                <td><?php echo $row['id_subasta']; ?> </td>
                <td><?php echo $row['comprador']; ?> </td>
                <td>Q<?php echo $row['oferta']; ?> </td>
          
      </tr>
           
        <?php
                           } 
                                    }
                                   
              
    ?>

      </tbody>
    </table>

    <a href="javascript:window.print()">
<img src="imagenes/reporte.png" width="50px" height="50px" alt="Imprimir" /> </a>
</div>

</div>


</div>      

                   
  

            </div>
         

        </div>
     
 <li>
           
   <?php
              }
              ?>
            
    </div>    </div>

    <script src="js/jquery.js"></script>

   
    <script src="js/bootstrap.min.js"></script>


    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    <script src="js/plugins/imprimir.js"></script>

</body>

</html>
