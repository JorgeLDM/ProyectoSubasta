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

    <title>Nueva subasta</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link href="css/sb-admin.css" rel="stylesheet">


    <link href="css/plugins/morris.css" rel="stylesheet">


    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 </head>

<body background="imagenes/subasta.png" width="65px">

  <?php

    if(isset($_POST["agregar"])){

      //Variables que se guardaran en la tabla carro
      $marca = $_POST["marca"];
      $cc = $_POST["cc"];
      $modelo = $_POST["modelo"];
      $descripcion = $_POST["descripcion"];
      $categoria = $_POST["categoria"];
      $foto = $_FILES["foto"]["name"];//nombre de la imagen 
      $ruta = $_FILES["foto"]["tmp_name"];//ruta de la imagen

      $foto2 = $_FILES["foto2"]["name"];//nombre de la imagen 
      $ruta2 = $_FILES["foto2"]["tmp_name"];

      $foto3 = $_FILES["foto3"]["name"];//nombre de la imagen 
      $ruta3 = $_FILES["foto3"]["tmp_name"];
  

      $p_minimo = $_POST["minimo"];
      $p_maximo = $_POST["maximo"];
      $fecha_hora_actual = date("Y-m-d H:i:s");
      $fecha_fin = $_POST["fecha_fin"];
      $hora_fin = $_POST["hora_fin"];
      $fecha_hora_fin = "$fecha_fin $hora_fin:00";
      $estado = 0;//1 = vendida && 0 = disponible
      $subastador = $_SESSION["id_usuario"];




      if($foto == null){
        if($foto2 == null){
          if($foto3 == null){

        $res = $bd->query("INSERT into carros(marca, cc, modelo, descripcion, imagen, imagen1, imagen2, id_categoria)
                            values('$marca', '$cc', '$modelo','$descripcion','default.jpg', 'default2.jpg', 'default3.jpg',$categoria);");

        if($res==true){
          echo "<script>alert('Vehiculo agregado correctamente');</script>";
          $id_carro = $bd->insert_id();

          $res2 = $bd->query("INSERT into subasta(min, max, tiempo_ini, tiempo_fin, estado, subastador, id_carro)
                              values($p_minimo,$p_maximo,'$fecha_hora_actual','$fecha_hora_fin',$estado,$subastador,$id_carro);");

          if($res2==true){
            echo "<script>alert('Subasta iniciada correctamente');</script>";
          }else{
            echo "<script>alert('No se pudo agregar subasta');</script>";
          }
        }else{
          echo "<script>alert('No se pudo agregar el Vehiculo, ni la subasta');</script>";
        }
}
}      }else{

        $dest = "imagenes/Vehiculos/";
        copy($ruta,$dest.''.$foto);

        $dest = "imagenes/Vehiculos/";
        copy($ruta2,$dest.''.$foto2);

        $dest = "imagenes/Vehiculos/";
        copy($ruta3,$dest.''.$foto3);

        $res = $bd->query("INSERT into carros(marca, cc, modelo, descripcion, imagen, imagen1, imagen2, id_categoria)
                            values('$marca', '$cc', '$modelo','$descripcion','$foto', '$foto2', '$foto3',$categoria);");

        if($res==true){
          echo "<script>alert('Vehiculo agregado correctamente');</script>";
          $id_carro = $bd->insert_id();

          $res2 = $bd->query("INSERT into subasta(min, max, tiempo_ini, tiempo_fin, estado, subastador, id_carro)
                              values($p_minimo,$p_maximo,'$fecha_hora_actual','$fecha_hora_fin',$estado,$subastador,$id_carro);");

          if($res2==true){
            echo "<script>alert('Subasta agregada correctamente');</script>";
          }else{
            echo "<script>alert('No se pudo agregar subasta');</script>";
          }
        }else{
          echo "<script>alert('No se pudo agregar el Vehiculo, ni la subasta');</script>";
        }
      }

    }

  ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="subastas.php">Venta de Autos S.A</a>
            </div>
            <!-- Top Menu Items -->
            <?php
              include ("header.php");
            ?>

            <?php
              include ("sidebar.php");
            ?>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                    <?php
                    if($_SESSION["administrador"] != "0"){
                    ?>
                     <h2>    </h2>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Subastas <small>Agregar nueva subasta</small>
                        </h1>
                        
                    </div>
                </div>

                      <div class="row">

                        <form role="form" action="" method="post" enctype="multipart/form-data">

                          <div class="col-lg-6">

                                <h3>Detalle del Vehículo</h3>

                                  <div class="form-group">
                                      <label>Nombre</label>
                                      <input type="text" name="marca" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Cilindraje</label>
                                      <input type="text" name="cc" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Año de Modelo</label>
                                      <input type="text" name="modelo" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Descripción</label>
                                      <textarea name="descripcion" class="form-control" required></textarea>
                                  </div>

                                  <div class="form-group">
                                      <label>Categoría</label>
                                      <select class="form-control" name="categoria">
                                          <?php
                                            $res = $bd->select("SELECT * from categoria");
                                            if($res->num_rows > 0){
                                              while($row = $res->fetch_assoc()){
                                                echo "<option value='".$row["id_categoria"]."'>".$row["categoria"]."</option>";
                                              }
                                            }else{
                                              echo "<option value='s/c'>Agrega una desde tu panel lateral</option>";
                                            }
                                          ?>
                                      </select>
                                      <p class="text-info">Si no esta la categoria que busca puede agregar</p>
                                  </div>

                                  <div class="form-group">
                                      <label>Foto de Frente</label>
                                      <input type="file" name="foto">
                                  </div>

                                  <div class="form-group">
                                      <label>Foto de Atrás </label>
                                      <input type="file" name="foto2">
                                  </div>

                                  <div class="form-group">
                                      <label>Interior</label>
                                      <input type="file" name="foto3">
                                  </div>

                        </div>
                        <div class="col-lg-6">

                              <h3>Detalle de la subasta</h3>

                                  <div class="form-group">
                                      <label>Precio mínimo</label>
                                      <input type="number" name="minimo" class="form-control">
                                  </div>

                                  <div class="form-group">
                                      <label>Precio máximo</label>
                                      <input type="number" name="maximo" class="form-control"  required>
                                  </div>

                                  <div class="form-group">
                                      <label>Fecha de cierre</label>
                                      <input type="date" name="fecha_fin" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Hora de cierre</label>
                                      <input type="time" name="hora_fin" class="form-control" required>
                                  </div>

                                  <br>

                                  <button name="agregar" type="submit" class="btn btn-outline-primary">Subastar</button>
                                  <button type="reset" class="btn btn-outline-warning">Cancelar</button>

                          </div>

                        </form>

                      </div>
                      <!-- /.row -->
                  <br>
            
            <?php
              }
              ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
