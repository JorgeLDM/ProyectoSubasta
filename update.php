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

    <title>Perfil</title>

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">


    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">

    <link href="css/plugins/morris.css" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body background="imagenes/subasta.png" width="65px">

  <?php

    if(isset($_POST["guardar"])){

      $id_usuario = $_POST["id_usuario"];
      $nombre = $_POST["nombre"];
      $apellido1 = $_POST["apellido1"];
      $apellido2 = $_POST["apellido2"];
      $telefono = $_POST["telefono"];

      $correo = $_POST["correo"];
      $user = $_POST["user"];
      $pass = $_POST["pass"];

      $foto = $_FILES["foto"]["name"];
      $ruta = $_FILES["foto"]["tmp_name"];

      if($foto == null){
        

        $res = $bd->query("UPDATE usuario set nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', telefono='$telefono',
                          correo='$correo', user='$user', pass='$pass' where id_usuario=$id_usuario;");

        if($res==true){
          echo "<script>alert('Usuario modificado correctamente');</script>";
          
        }else{
          echo "<script>alert('No se modificaron los datos');</script>";
        }

      }else{
        

        $dest = "imagenes/";
        copy($ruta,$dest.''.$foto);

        $res = $bd->query("UPDATE usuario set nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', telefono='$telefono',
                          foto='$foto', correo='$correo', user='$user', pass='$pass' where id_usuario=$id_usuario;");

        if($res==true){
          echo "<script>alert('Datos modificados correctamente');</script>";
          $_SESSION["nomb_comp"] = $nombre." ".$apellido1;
        }else{
          echo "<script>alert('No se modificaron los datos');</script>";
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
                            Modificación de Clientes <small>Ventas de Autos,SA</small>
                        </h1>
                    </div>
                </div>

                <?php
                  $id_sub = $_GET["id"];
                  $res = $bd->select("SELECT * from usuario where id_usuario=$id_sub");

                  if($res->num_rows == 1){
                    while($row = $res->fetch_assoc()){
                      $id_usuario = $row["id_usuario"];
                      $nombre = $row["nombre"];
                      $apellido1 = $row["apellido1"];
                      $apellido2 = $row["apellido2"];
                      $telefono = $row["telefono"];
                      $foto = $row["foto"];
                      $correo = $row["correo"];
                      $user = $row["user"];
                      $pass = $row["pass"];

                      ?>

                      <div class="row">
               <?php
                                            
                       echo '<p style="color:black;font-size:25px;font-family:sans-serif;>"texto"</p>'; 
                       echo "Foto Perfil";
                       echo "<img src='imagenes/$foto' style='max-height: 100px; width: 10%;'>";

                  ?>
                        <form role="form" action="" method="post" enctype="multipart/form-data">

                          <div class="col-lg-6">

                                  <div class="form-group">
                                      <label>Id de Cliente</label>
                                      <input type="text" name="id_usuario" class="form-control" readonly value="<?php echo $id_usuario; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label>Nombre</label>
                                      <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label>Apellido</label>
                                      <input type="text" name="apellido1" class="form-control" value="<?php echo $apellido1; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label>Apellido</label>
                                      <input type="text" name="apellido2" class="form-control" value="<?php echo $apellido2; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label>Teléfono</label>
                                      <input type="number" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                                  </div>

                        </div>
                        <div class="col-lg-6">

                                  <div class="form-group">
                                      <label>Foto</label>
                                      <input type="file" name="foto">
                                  </div>

                                  <div class="form-group">
                                      <label>Correo</label>
                                      <input type="email" name="correo" class="form-control" value="<?php echo $correo; ?>" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Usuario</label>
                                      <input type="text" name="user" class="form-control" value="<?php echo $user; ?>" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Contraseña</label>
                                      <input type="text" name="pass" class="form-control" value="<?php echo $pass; ?>" required>
                                  </div>

                                  <br>

                                  <button name="guardar" type="submit" class="btn btn-lg btn-primary">Guardar</button>
                                  <button type="reset" class="btn btn-secondary btn-lg">Cancelar</button>

                                    
                          </div>

                        </form>

                      </div>

                      <?php
                    }
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
