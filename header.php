
       

<ul class="nav navbar-right top-nav">
    <li class="dropdown">
        <a href="#" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["nomb_comp"]; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
           
            <li class="divider"></li>

            <li>
              <a class="dropdown-item" href="index.php"><i class="fa fa-fw fa-bell-o"></i> Nosotros</a>
            </li>

            <li>
              <a class="dropdown-item" href="proxima.php"><i class="fa fa-fw fa-bell-o"></i>Proximas Subastas</a>
            </li>

            <li>
              <a class="dropdown-item" href="subastas.php"><i class="fa fa-fw fa-bell-o"></i> Subastas Activas</a>
            </li>
                    
            <li>
                <a class="dropdown-item" href="carrito.php"><i class="fa fa-fw fa-shopping-cart"></i> Mi carrito</a>
            </li>
            <li>
                <a class="dropdown-item" href="cuenta.php"><i class="fa fa-fw fa-th-list"></i> Mi cuenta</a>
            </li>
            <li>
                <a class="dropdown-item" href="configuracion.php"><i class="fa fa-fw fa-plus"></i> Configuración</a>
            </li>
            <li>
                <a class="dropdown-item" href="logout.php"><i class="fa fa-fw fa-power-off"></i> Cerrar sesion</a>
            </li>
           </ul>
    </li>
</ul>


<?php

    $res_1 = $bd->select("SELECT * from subasta where estado = 0");
    if($res_1->num_rows > 0){
      while($row = $res_1->fetch_assoc()){
        $id_subasta = $row["id_subasta"];
        $min = $row["min"];
        $max = $row["max"];
        $ini = $row["tiempo_ini"];
        $fin = $row["tiempo_fin"];
        $comprador = $row["comprador"];
        $id_carro = $row["id_carro"];

        $datetime_actual = date("Y-m-d H:i:s");
        $datetime1 = date_create($datetime_actual);
        $datetime2 = date_create($fin);
        $interval = $datetime1->diff($datetime2);
        $signo = $interval->format("%R");


        if($signo == "-"){
     
          if($comprador != null){
       
              $res_2 = $bd->query("INSERT into cesta(id_usuario, id_subasta) values($comprador,$id_subasta);");
              if($res_2 == false){
                echo "<script>alert('Estamos manejando errores');</script>";
              }else{
                $res_2_1 = $bd->query("UPDATE subasta set estado=1 where id_subasta=$id_subasta;");
                if($res_2_1 == false){
                  echo "<script>alert('Estamos manejando errores');</script>";
                }
              }
          }else{
              $res_3 = $bd->query("UPDATE subasta set estado=1 where id_subasta=$id_subasta;");
              if($res_3 == false){
                echo "<script>alert('Estamos manejando errores');</script>";
              }
          }

        }
      }
    }
?>
