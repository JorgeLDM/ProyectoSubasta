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

    <title>Subastas</title>


    <link rel="icon" type="image/png" sizes="16x16" href="imagenes/favicon.png">

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

        <div id="page-wrapper">

            <div class="container-fluid">


                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Subastas <small>Todas las subastas disponibles</small>
                        </h1>
                        
                    </div>
                </div>

                <div class="row">

                  <?php

                      $res = $bd->select("SELECT * from subasta where estado=0 order by id_subasta desc");
                      if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                          $id_subasta = $row["id_subasta"];
                          $min = $row["min"];
                          $max = $row["max"];
                          $ini = $row["tiempo_ini"];
                          $fin = $row["tiempo_fin"];
                          $comprador = $row["comprador"];
                          $id_carro = $row["id_carro"];

                          $datetime_actual = date("Y-m-d H:i:s");
                          $datetime1 = date_create($datetime_actual);
                          $datetime2 = date_create($fin);
                          $interval = $datetime1->diff($datetime2);

                          //Inicia consulta de producto de las subastas
                          $res2 = $bd->select("SELECT * from carros where id_carro=$id_carro");
                          if($res2->num_rows > 0){
                            while($row2 = $res2->fetch_assoc()){
                              $nombre_p = $row2["marca"];
                              $imagen_p = $row2["imagen"];

                              //echo "$id_subasta, $min, $max, $ini, $fin, $comprador, $id_producto, $nombre_p, $imagen_p<br>";

                              $res3 = $bd->select("SELECT * from oferta where id_subasta=$id_subasta order by id_oferta desc limit 1");
                              if($res3->num_rows > 0){
                                while($row3 = $res3->fetch_assoc()){
                                  $id_oferta = $row3["id_oferta"];
                                  $oferta = $row3["oferta"];


                                  ?>
                                        <div class="col-sm-6 col-md-4">
                                          <div class="thumbnail">
                                            <?php echo "<img src='imagenes/Vehiculos/$imagen_p' style='height: 220px;'>";?>
                                            <div class="caption">
                                              <h3><?php echo $nombre_p; ?></h3>
                                              <p><?php print $interval->format('%a días %H horas %I minutos'); ?></p>
                                              <p><?php echo "Q$min.00 - Q$max.00"; ?></p>
                                              <h4>Oferta actual: <b class="text-danger"><?php echo "Q$oferta.00"; ?></b></h4>
                                              <?php echo "<p><a href='subasta.php?id=$id_subasta' class='btn btn-success btn-block' role='button'>Mejorar oferta</a></p>";?>
                                            </div>
                                          </div>
                                        </div>
                                  <?php


                                }
                              }else{

                                ?>
                                      <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                          <?php echo "<img src='imagenes/Vehiculos/$imagen_p' style='height: 220px;'>";?>
                                          <div class="caption">
                                            <h3><?php echo $nombre_p; ?></h3>
                                            <p><?php print $interval->format('%a días %H horas %I minutos'); ?></p>
                                            <p><?php echo "Q$min.00 - Q$max.00"; ?></p>
                                            <h4>Oferta actual: <b class="text-danger"><?php echo "Q0.00"; ?></b></h4>
                                            <?php echo "<p><a href='subasta.php?id=$id_subasta' class='btn btn-info btn-block' role='button'>Primero en ofertar</a></p>";?>
                                          </div>
                                        </div>
                                      </div>
                                <?php
                                /*Fin de los productos que no tienen oferta*/
                              }

                            }
                          }else{
                            echo "<h4>Hubo un error al recuperar el producto</h4>";
                          }

                        }
                      }else{
                        echo "<h3>Por el momento no existen subastas</h3>";
                      }


                  ?>





                </div>


            </div>


        </div>


    </div>

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
