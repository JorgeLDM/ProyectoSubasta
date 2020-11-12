<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();
  if(!isset($_SESSION["id_usuario"])){
    header("Location: login.php");
  }
  if(!$_GET["id"]){
    header("Location: subastas.php");
  }


  $id_sub = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Subasta de Vehiculo</title>


    <link rel="icon" type="image/png" sizes="16x16" href="imagenes/favicon.png">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">


    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body background="imagenes/subasta.png" width="65px">

    <?php
      if (isset($_POST["ofertar"])) {

        $oferta = $_POST["oferta"];
        $id_user_1 = $_POST["id_user"];
        $id_sub_1 = $_POST["id_sub"];
        $max = $_POST["max"];
        $fecha_hora_actual = date("Y-m-d H:i:s");

          if($oferta == $max){

            $res_1 = $bd->query("INSERT into oferta(oferta, estado, fecha, id_subasta, comprador) values($oferta, 1, '$fecha_hora_actual',$id_sub_1, $id_user_1);");
            if($res_1 == false){
              echo "<script>alert('No se ha podido ofertar');</script>";
            }else{
              $res_2 = $bd->query("INSERT into cesta(id_usuario, id_subasta) values($id_user_1,$id_sub_1);");
              if($res_2 == false){
                echo "<script>alert('No se pudo agregar Vehiculo a al carrito');</script>";
              }else{
                $res_2_1 = $bd->query("UPDATE subasta set estado=1, comprador=$id_user_1 where id_subasta=$id_sub_1;");
                if($res_2_1 == false){
                  echo "<script>alert('No se pudo actualizar la subasta');</script>";
                }else{
                  echo "<script>alert('¡Vendido!');</script>";
                }
              }
            }
          }else{

            $res_1 = $bd->query("INSERT into oferta(oferta, estado, fecha, id_subasta, comprador) values($oferta, 0, '$fecha_hora_actual',$id_sub_1, $id_user_1);");
            if($res_1 == false){
              echo "<script>alert('No se ha podido ofertar');</script>";
            }else{
              $res_2_1 = $bd->query("UPDATE subasta set comprador=$id_user_1 where id_subasta=$id_sub_1;");
              if($res_2_1 == false){
                echo "<script>alert('No se pudo actualizar la subasta');</script>";
              }else{
                echo "<script>alert('Oferta realizada con exito');</script>";
              }
            }
          }
      }elseif(isset($_POST["comprar"])){

        
        $oferta = $_POST["max"];
        $id_user_1 = $_POST["id_user"];
        $id_sub_1 = $_POST["id_sub"];
        $max = $_POST["max"];
        $fecha_hora_actual = date("Y-m-d h:i:s");

          $res_1 = $bd->query("INSERT into oferta(oferta, estado, fecha, id_subasta, comprador) values($oferta, 1, '$fecha_hora_actual',$id_sub_1, $id_user_1);");
          if($res_1 == false){
            echo "<script>alert('No se ha podido ofertar');</script>";
          }else{
            $res_2 = $bd->query("INSERT into carrito(id_usuario, id_subasta) values($id_user_1,$id_sub_1);");
            if($res_2 == false){
              echo "<script>alert('No se pudo agregar Vehiculo al carrito');</script>";
            }else{
              $res_2_1 = $bd->query("UPDATE subasta set estado=1, comprador=$id_user_1 where id_subasta=$id_sub_1;");
              if($res_2_1 == false){
                echo "<script>alert('No se pudo actualizar la subasta');</script>";
              }else{
                echo "<script>alert('¡Vendido!');</script>";
              }
            }
          }
      }
    ?>

    <div id="wrapper">


        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="subastas.php">Subastas</a>
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
                            Vehiculo <small>Haz tu mejor oferta</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i></i> 
                            </li>
                            
                        </ol>
                    </div>
                </div>


                <div class="row">

                  <?php

                      $res = $bd->select("SELECT * from subasta where id_subasta=$id_sub");
                      if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                          $min = $row["min"];
                          $max = $row["max"];
                          $ini = $row["tiempo_ini"];
                          $fin = $row["tiempo_fin"];
                          $estado = $row["estado"];
                          $comprador = $row["comprador"];
                          $subastador = $row["subastador"];
                          $id_carro = $row["id_carro"];

                          $datetime_actual = date("Y-m-d H:i:s");
                          $datetime1 = date_create($datetime_actual);
                          $datetime2 = date_create($fin);
                          $interval = $datetime1->diff($datetime2);


                          $res2 = $bd->select("SELECT * from carros where id_carro=$id_carro");
                          if($res2->num_rows > 0){
                            while($row2 = $res2->fetch_assoc()){
                              $nombre_p = $row2["marca"];
                              $imagen_p = $row2["imagen"];
                              $imagen_p2 = $row2["imagen1"];
                              $imagen_p3 = $row2["imagen2"];
                              $descripcion_p = $row2["descripcion"];
                              $id_categoria = $row2["id_categoria"];

    
                              $result = $bd->select("SELECT * from categoria where id_categoria=$id_categoria");
                              $categoria_arr = mysqli_fetch_array($result);
                              $categoria = $categoria_arr["categoria"];

                             

                              $res_count=$bd->select("SELECT count(*) as total from oferta where id_subasta=$id_sub");
                              $data=mysqli_fetch_array($res_count);
                              $count_ofert = $data['total'];

                              $res3 = $bd->select("SELECT * from oferta where id_subasta=$id_sub order by id_oferta desc limit 1");
                              if($res3->num_rows > 0){
                                while($row3 = $res3->fetch_assoc()){
                                  $id_oferta = $row3["id_oferta"];
                                  $oferta = $row3["oferta"];
                                  $ofertante_comp = $row3["comprador"];



                                  ?>
                                  <div class="col-sm-6 col-md-6">
                                    <div class="thumbnail">
                                      <?php
                                            
                                           echo '<p style="color:black;font-size:25px;font-family:sans-serif;>"texto"</p>'; 
                                           
                                          echo "<h1 class='text-success'> Parte Delantera del Vehículo </h1>";
                                            
                                             echo "<img src='imagenes/Vehiculos/$imagen_p' style='max-height: 450px; width: 100%;'>";

                                          echo "<h1 class='text-success'> Parte Trasera del Vehículo </h1>";
                                          
                                            echo "<img src='imagenes/Vehiculos/$imagen_p2' style='max-height: 450px; width: 100%;'>";

                                          echo "<h1 class='text-success'> Interior del Vehículo </h1>"; 
                             
                                            echo "<img src='imagenes/Vehiculos/$imagen_p3' style='max-height: 450px; width: 100%;'>";
                                          ?>
                                    </div>
                                  </div>

                                  <div class="col-sm-6 col-md-6">
                                    <div class="thumbnail">
                                      <?php //echo "<img src='images/productos/$imagen_p' style='height: 220px;'>";?>
                                      <div class="caption">
                                        <?php
                                          if($estado == 1 && $ofertante_comp != null){
                                            echo "<h1 class='text-danger'>VENDIDO</h1>";
                                          }
                                        ?>
                                        <h2 class="text-success"> Marca: <?php echo $nombre_p; ?></h2>
                                        <h4 class="text-info"><?php echo $descripcion_p; ?></h4>
                                        <p class="text-warning text-right"><i class="fa fa-tag"></i> Categoría: <?php echo $categoria; ?></p>
                                        <hr style="margin: 1px 1px 1px 1px;">

                                        <p>Vehículo publicado el: <?php echo "<b>$ini</b>"; ?></p>
                                        <p><?php //print $interval->format('%R %a días %H horas %I minutos'); ?></p>

                                        <p id="tiempo"></p>
                                        <input type="hidden" id="limite" value="<?php echo $fin; ?>">

                                        <p><?php echo "<b>Ofertantes:</b> $count_ofert";?></p>
                                        <p><?php echo "<b>Mínimo:</b> Q$min.00"; ?></p>
                                        <p><?php echo "<b>Máximo:</b> Q$max.00"; ?></p>
                                        <h4>Oferta actual: <b class="text-danger"><?php echo "Q$oferta.00"; ?></b></h4>

                                        <form class="form-inline" action="" method="post">

                                          <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_usuario']; ?>">
                                          <input type="hidden" name="id_sub" value="<?php echo $id_sub; ?>">
                                          <input type="hidden" name="max" value="<?php echo $max; ?>">
                                          <input type="hidden" name="fin" value="<?php echo $fin; ?>">

                                          <?php
                                            if($estado == 1 || $_SESSION["id_usuario"] == $ofertante_comp || $_SESSION["id_usuario"] == $subastador){
                                              ?>

                                              <div class="form-group">
                                                <input type="number" disabled name="oferta" max="<?php echo $max;?>" min="<?php echo $oferta+1;?>" class="form-control" value="<?php echo $oferta+1;?>">
                                              </div>

                                              <button type="submit" disabled class="btn btn-info" name="ofertar">Mejorar oferta</button>
                                              <button type="submit" disabled class="btn btn-danger" name="comprar">Comprar ahora</button>

                                              <?php
                                            }elseif($estado == 0){
                                              ?>
                                              <div class="form-group">
                                                <input type="number" name="oferta" max="<?php echo $max;?>" min="<?php echo $oferta+1;?>" class="form-control" value="<?php echo $oferta+1;?>">
                                              </div>

                                              <button type="submit" class="btn btn-warning" name="ofertar">Mejorar oferta</button>
                                              <button type="submit" class="btn btn-success" name="comprar">Comprar ahora</button>

                                              <?php
                                            }
                                          ?>


                                        </form>


                                      </div>
                                    </div>
                                  </div>
                                  <?php

                                }
                              }else{
                                
                                ?>
                                      <div class="col-sm-6 col-md-6">
                                          <?php
                                            
                                           echo '<p style="color:black;font-size:25px;font-family:sans-serif;>"texto"</p>'; 
                                           
                                            echo "Parte Delantera del Vehiculo";
                                             echo "<img src='imagenes/Vehiculos/$imagen_p' style='max-height: 450px; width: 100%;'>";

                                              echo "Parte Trasera del Vehiculo";
                                            echo "<img src='imagenes/Vehiculos/$imagen_p2' style='max-height: 450px; width: 100%;'>";


                                            echo "Interior del Vehiculo";
                                            echo "<img src='imagenes/Vehiculos/$imagen_p3' style='max-height: 450px; width: 100%;'>";
                                          ?>
                                      </div>
                                      <div class="col-sm-6 col-md-6">
                                        <div class="thumbnail">
                                          
                                          <div class="caption">
                                            <h2 class="text-success"><?php echo $nombre_p; ?></h2>
                                            <h4 class="text-info"><?php echo $descripcion_p; ?></h4>
                                            <p class="text-warning text-right"><i class="fa fa-tag"></i> <?php echo $categoria; ?></p>
                                            <hr style="margin: 1px 1px 1px 1px;">
                                            <p>Producto publicado el <?php echo "<b>$ini</b>"; ?></p>
                                            <p>

                                            <p id="tiempo"></p>
                                            <input type="hidden" id="limite" value="<?php echo $fin; ?>">

                                            <p><?php echo "<b>Oferta minima:</b> Q$min.00"; ?></p>
                                            <p><?php echo "<b>Oferta maxima:</b> Q$max.00"; ?></p>
                                            <h4>Oferta actual: <b class="text-danger"><?php echo "Q0.00"; ?></b></h4>

                                            <form class="form-inline" action="" method="post">

                                              <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_usuario']; ?>">
                                              <input type="hidden" name="id_sub" value="<?php echo $id_sub; ?>">
                                              <input type="hidden" name="max" value="<?php echo $max; ?>">
                                              <input type="hidden" name="fin" value="<?php echo $fin; ?>">

                                              <?php
                                                if($_SESSION["id_usuario"] == $subastador){
                                                  ?>
                                                  <div class="form-group">
                                                    <input type="number" disabled name="oferta" class="form-control" max="<?php echo $max;?>" min="<?php echo $min;?>" value="<?php echo $min;?>">
                                                  </div>

                                                  <button type="submit" disabled class="btn btn-info" name="ofertar">Ofertar ahora</button>
                                                  <button type="submit" disabled class="btn btn-success" name="comprar">Comprar ahora</button>
                                                  <?php
                                                }else{
                                                  ?>
                                                  <div class="form-group">
                                                    <input type="number" name="oferta" class="form-control" max="<?php echo $max;?>" min="<?php echo $min;?>" value="<?php echo $min;?>">
                                                  </div>

                                                  <button type="submit" class="btn btn-info" name="ofertar">Ofertar ahora</button>
                                                  <button type="submit" class="btn btn-success" name="comprar">Comprar ahora</button>
                                                  <?php
                                                }
                                              ?>


                                            </form>


                                          </div>
                                        </div>
                                      </div>
                                <?php

                              }

                            }
                          }else{
                            echo "<h4>Hubo un error al recuperar el Vehiculo</h4>";
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>







    <!-- Archivo de cuenta regresiva -->
    <script src="js/regresivo.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <script>
      //Se le define el tiempo de ejecucion - al segundo
      setInterval("tiempo()",1000);

      function tiempo(){
        $.post("ajax/tiempo_regresivo.php",{tiempo_limite:$("#limite").val()}, function(data){

            $("#tiempo").html(data);

        });

      }
    </script>

</body>

</html>
