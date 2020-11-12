<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();
  if(isset($_SESSION["id_usuario"])){
    header("Location: index.php");
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrarme</title>


    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  </head>

<body background="imagenes/subasta.png" width="65px">

    <?php
      if(isset($_POST["registro"])){
        $correo = $_POST["correo"];
        $user = $_POST["user"];
        $nombre = $_POST["nombre"];

        $query = "INSERT into usuario(correo, user, nombre) values('$correo','$user','$nombre');";

        $result = $bd->query($query);

        if($result == true){
          echo "<script>alert('Usuario registrado, estará recibiendo un correo con su Usuario y Contraseña');</script>";

        }else{
          echo "<script>alert('No se pudo registrar el usuario');</script>";
        }

      }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="imagenes/car-driving.gif" width="65px">
                        </div>
                        <div class="col-md-9">
                          <h3>Registro</h3>
                        </div>
                      </div>

                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Correo" name="correo" type="email" autofocus required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="user" type="text" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Nombre" name="nombre" type="text" required>
                                </div>


                                <input type="submit" name="registro" class="btn btn-info" value="Confirmar
                                ">

                            </fieldset>
                        </form>
                    </div>
                    
                        
                  
                   
                </div>

                <div class="col-md-8 col-md-offset-2">
                            <a href="./login.php" class="btn btn-primary btn-block" role="button" aria-pressed="true">Inicia sesion aquí</a>
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