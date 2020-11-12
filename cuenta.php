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

    <title>Mi Cuenta</title>
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
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
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

        <div id="page-wrapper" >

            <div class="container-fluid" >


                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Mi cuenta <small>Carros subastados</small>
                        </h1>
                       
                    </div>
                </div>


                <div class="row">
                  <div class="col-lg-6">

                    <div class="table-responsive">
                      <h2>Subastas activas</h2>

                       <div class="thumbnail">
                      <hr>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Marca</th>
                                    <th>Categoría</th>
                                    <th>Pagado</th>
                                </tr>
                            </thead>
                            <tbody>

                  <?php

                          //Inicia consulta de subastas
                          $iduser = $_SESSION['id_usuario'];
                          $res = $bd->select("SELECT * from subasta where subastador=$iduser and estado=0 order by id_subasta desc");
                          if($res->num_rows > 0){
                            while($row = $res->fetch_assoc()){
                              $sub = $row["id_subasta"];
                              $min = $row["min"];
                              $max = $row["max"];
                              $ini = $row["tiempo_ini"];
                              $fin = $row["tiempo_fin"];
                              $id_carro = $row["id_carro"];

                              //Inicia consulta de producto de las subastas
                              $res2 = $bd->select("SELECT * from carros where id_carro=$id_carro");
                              if($res2->num_rows > 0){
                                while($row2 = $res2->fetch_assoc()){
                                  $nombre_p = $row2["marca"];
                                  $imagen_p = $row2["imagen"];
                                  $catego_p = $row2["id_categoria"];

                                  //Inicia consulta de categoria del producto
                                  $result = $bd->select("SELECT * from categoria where id_categoria=$catego_p");
                                  $categoria_arr = mysqli_fetch_array($result);
                                  $categoria = $categoria_arr["categoria"];

                                  //Inicia consulta de categoria del producto
                                  $result1 = $bd->select("SELECT * from oferta where id_subasta=$sub order by id_oferta desc limit 1");
                                  $oferta = mysqli_fetch_array($result1);
                                  $of_final = $oferta["oferta"];

                                  ?>


                                      <tr>
                                          <td width="180px">
                                            <center>
                                              <a href="<?php echo "subasta.php?id=$sub"; ?>">
                                                <img src="<?php echo "imagenes/Vehiculos/$imagen_p";?>" style="height: 80px;">
                                              </a>
                                            </center>
                                          </td>
                                          <td><?php echo "<b class='text-success'>$nombre_p</b>";?></td>
                                          <td><?php echo $categoria;?></td>
                                          <td><?php echo "<b class='text-danger'>Q$of_final.00</b>";?></td>
                                      </tr>


                                  <?php


                                }
                              }
                            }
                          }



                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>


                  <div class="col-lg-6">

                    <div class="table-responsive">
                      <h2>Subastas cerradas</h2>
                      <div class="thumbnail">
                      <hr>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Pagado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                  <?php


                          $iduser = $_SESSION['id_usuario'];
                          $res = $bd->select("SELECT * from subasta where subastador=$iduser and estado=1 order by id_subasta desc");
                          if($res->num_rows > 0){
                            while($row = $res->fetch_assoc()){
                              $sub = $row["id_subasta"];
                              $min = $row["min"];
                              $max = $row["max"];
                              $ini = $row["tiempo_ini"];
                              $fin = $row["tiempo_fin"];
                              $id_carro = $row["id_carro"];


                              $res2 = $bd->select("SELECT * from carros where id_carro=$id_carro");
                              if($res2->num_rows > 0){
                                while($row2 = $res2->fetch_assoc()){
                                  $nombre_p = $row2["marca"];
                                  $imagen_p = $row2["imagen"];
                                  $catego_p = $row2["id_categoria"];

          
                                  $result = $bd->select("SELECT * from categoria where id_categoria=$catego_p");
                                  $categoria_arr = mysqli_fetch_array($result);
                                  $categoria = $categoria_arr["categoria"];


                                  $result1 = $bd->select("SELECT * from oferta where id_subasta=$sub order by id_oferta desc limit 1");
                                  $oferta = mysqli_fetch_array($result1);
                                  $of_final = $oferta["oferta"];

                                  ?>


                                      <tr>
                                          <td width="180px">
                                            <center>
                                              <a href="<?php echo "subasta.php?id=$sub"; ?>">
                                                <img src="<?php echo "imagenes/Vehiculos/$imagen_p";?>" style="height: 80px;">
                                              </a>
                                            </center>
                                          </td>
                                          <td><?php echo "<b class='text-success'>$nombre_p</b>";?></td>
                                          <td><?php echo $categoria;?></td>
                                          <td><?php echo "<b class='text-danger'>Q$of_final.00</b>";?></td>
                                      </tr>


                                  <?php


                                }
                              }
                            }
                          }

    

                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>


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
