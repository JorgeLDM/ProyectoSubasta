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

    <title>Nueva categoria</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">

    <link href="css/plugins/morris.css" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



</head>

<body background="imagenes/subasta.png" width="65px">

  <?php

    if(isset($_POST["agregar"])){

      $categoria = $_POST["categoria"];
      $descripcion = $_POST["descripcion"];

      $res = $bd->query("INSERT into categoria(categoria, descripcion) values('$categoria','$descripcion');");

      if($res==true){
        echo "<script>alert('Categoria agregada correctamente');</script>";
      }else{
        echo "<script>alert('No se pudo agregar categoria');</script>";
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
                <?php
                        if($_SESSION["administrador"] != "0"){
                    ?>
                     <h2>    </h2>

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categoria <small>Agregar nueva categoria</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> Consola
                            </li>
                            <li class="active">
                                <i class="fa fa-tag"></i> Nueva categoria
                            </li>
                        </ol>
                    </div>
                </div>

                      <div class="row">

                          <div class="col-lg-6">

                            <form role="form" action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="categoria" class="form-control" required>
                                </div>

                                  <div class="form-group">
                                      <label>Descripcion</label>
                                      <textarea name="descripcion" class="form-control" required></textarea>
                                  </div>

                                  <button name="agregar" type="submit" class="btn btn-success">Agregar</button>
                                  <button type="reset" class="btn btn-danger">Cancelar</button>

                                  <br><br><br><br>

                                </form>
                          </div>

                      </div>

              </br>
             <?php
              }
              ?>
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
