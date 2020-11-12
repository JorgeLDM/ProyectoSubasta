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

    <title>Lista de Usuarios</title>
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
                            Listado de Clientes <small></small>
                        </h1>
                        
                    </div>
                </div>

  <?php
                    if($_SESSION["administrador"] != "0"){
                    ?>
                
      <div class="thumbnail">              

  <div class="table-responsive">                    
      <table  class="table table-bordered table-dark table-hover">
        <thead class="table table-striped" border="5">

            <tr>
                <th scope="row">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Modificar</th>
                
       
            </tr>
        </thead>

      <tbody>

        <?php
                  
                  $res = $bd->select("SELECT * from usuario WHERE administrador = 0 ORDER BY id_usuario");

                     if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){

                      
                      ?>
            <tr>
        
                <td><?php echo $row['id_usuario']; ?> </td>
                <td><?php echo $row['nombre']; ?> </td>
                <td><?php echo $row['apellido1']; ?> </td>
                <td><?php echo $row['telefono']; ?> </td>
                <td><?php echo $row['correo']; ?> </td>
                <td><?php echo $row['user']; ?> </td>
                <td><?php echo $row['pass']; ?> </td>
                <td><a href="update.php?id=<?php echo $row['id_usuario']; ?>"  class="btn__update" >Editar</a></td>
                
           
            </tr>
                      <?php
                                          } 
                                                          }
                      ?>
      </tbody>
    </table>
</div>
<a href="javascript:window.print()">
<img src="imagenes/reporte.png" width="50px" height="50px" alt="Imprimir" /> </a>

</div>      
              </div>
           

        </div>
    

    </div></div>
  
     <?php
              }
              ?>

    <script src="js/plugins/imprimir.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    

</body>

</html>
