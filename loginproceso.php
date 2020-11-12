<?php
    session_start();
    include ("conexion/Conexion.php");
    include ("conexion/config.php");
    $bd = new Conexion();
    
sleep(2);


        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $query = "SELECT * from usuario where user='$user' and pass='$pass';";

        $result = $bd->select($query);

        if($result->num_rows > 0){

          while($row = $result->fetch_assoc()){
            $id_us = $row["id_usuario"];
            $admin = $row["administrador"];
            $nombre = $row["nombre"];
            $apellido1 = $row["apellido1"];

          }
       
          $_SESSION["id_usuario"] = $id_us;
          $_SESSION['administrador'] = $admin;
          $_SESSION["nomb_comp"] = $nombre." ".$apellido1;
          header("Location: index.php");
        }else{
          echo "<script>alert('Datos incorrectos');</script>";
          echo "<script>window.history.back();</script>";
          
        }
        
        
      
    ?>
