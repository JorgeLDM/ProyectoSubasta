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
	 <!-- Firebase -->
	<script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-firestore.js"></script>
	 <!-- firebase -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Proximas Subastas</title>

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

                    <div class="container-fluid">

     
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Próximas <small>Subastas</small>
                        </h1>
                        
                    </div>
                </div>
            </div>
        



<div class="table-responsive">                    
      <table  class="table table-bordered table-dark table-hover" border="5">
        <thead class="table table-striped" border="5">
    <tr>
    	<th scope="col">#</th>	
      <th scope="col">Marca</th>
      <th scope="col">Modelo</th>
      <th scope="col">CC</th>
      <th scope="col">Millaje</th>
      <th scope="col">Estado</th>
      <th scope="col">Foto</th>

    </tr>
  </thead>
  <tbody>

  	<?php
		$data = json_decode ( file_get_contents("vehiculos.json"),true);
		echo "<br>";
		for($i=1; $i<count($data); $i++) {
	
		echo "<tr>";
			echo "<td>"   . $i  . "</td>";
   			echo   "<td>"  .$data[$i]["Marca"] ."</td>";
  			echo    "<td> " .$data[$i]["Modelo"] ."</td>";
		   	echo  " <td>"  .$data[$i]["CC"] ."</td>";
		   	echo    "<td>" . $data[$i]["Millaje"]. "</td>";
		   	echo   "<td>" . $data[$i]["Estado"]. "</td>";
      	echo   "<td>" ."<img src='fire/'"  .$data[$i]["URL1"]. ">"."</td>"; 
      //  echo "<td>" . '<img src="data:fire/jpeg;base64,'.base64_encode($data[$i]["URL1"]).'" >'. "</td>";
		echo "</tr>";

	}	
	?>

    
  </tbody>
</table>

        </div>


    </div>

    <script src="app.js"> </script>
    <script src="js/jquery.js"></script>


    <script src="js/bootstrap.min.js"></script>

    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
  

</body>


<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>



<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyCeOZ_7r_26oiA7UvFRWAKEUFfkYyko_Sc",
    authDomain: "proveesubasta.firebaseapp.com",
    databaseURL: "https://proveesubasta.firebaseio.com",
    projectId: "proveesubasta",
    storageBucket: "proveesubasta.appspot.com",
    messagingSenderId: "336297132632",
    appId: "1:336297132632:web:72c693e0ded14805d0002d"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>

</html>
