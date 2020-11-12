<?php
if(isset($_POST["tiempo_limite"])){
  $indicador = array();
  $fecha_servidor = date("Y-m-d H:i:s");
  $datetime1 = date_create($fecha_servidor);
  $datetime2 = date_create($_POST["tiempo_limite"]);
  $interval = date_diff($datetime1, $datetime2);
  $fecha_restantes = $interval->format('%R%d días %H:%I:%s');
  $fecha_comparar = $interval->format('%R');
  if($fecha_comparar == '-'){
    echo "Subasta cerrada";
  }else{
    echo $fecha_restantes;
  }
}
?>
