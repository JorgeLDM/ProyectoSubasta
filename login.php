  
<?php
    include ("conexion/Conexion.php");
    include ("conexion/config.php");
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

    <title>Iniciar sesion</title>

    <link rel="icon" type="image/png" sizes="16x16" href="imagenes/signup.png">
    <link rel="stylesheet" href="css/fondos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sb-admin.css">
    <link rel="stylesheet" href="css/plugins/morris.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" >

</head>

<body background="imagenes/subasta.png" width="15px">
 
    <div class="container">

        <div class="row">

            <div class="col-md-4 col-md-offset-1">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="imagenes/cc.gif" width="80px">
                        </div>
                        <div class="col-md-9">
                          <h3>Iniciar sesión</h3>
                          <h3>Venta de Autos S.A</h3>
                        </div>
                      </div>

                    </div>

                     <form action="loginproceso.php" method="post" role="form" style="margin: 20px;" class="FormCatElec" data-form="login">
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="user" type="text" autofocus required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="pass" type="password" required>
                                </div>

                                
                                      <p>¿Cómo iniciaras sesión?</p>
                  <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option1" checked>
                        Usuario
                    </label>
                 </div>
                 <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option2">
                         Administrador
                    </label>
                  

                 </div>
                
                  <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="entrar" class="btn btn-primary btn-block" value="Entrar">

                            </fieldset>
                        </form>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

                    <div class="container">
                        <div class="col-md-2 col-md-offset-2">
                            <a href="./registro.php" class="btn btn-primary btn-block" role="button" aria-pressed="true">   Solicita tu usuario aquí</a>
                        </div>
                    </div>
    </form>
 

                      
                    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
