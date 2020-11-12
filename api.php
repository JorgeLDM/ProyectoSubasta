<?php

$url = "https://proveesubasta.firebaseio.com/vehiculos.json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, "1");
$response = curl_exec($ch);
curl_close($ch);

echo ($response);

?>