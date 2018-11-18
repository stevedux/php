<?php

  require('./conector.php');
  session_start();

    $resultado_consulta = $con->consultar(['eventos'],
    ['*'], 'WHERE id_usuario = "'. $_SESSION['id_usuario'] . '"');

    $index = 0;

    while ($fila = $resultado_consulta->fetch_assoc()) {
    	$response["msg"] = "OK";

    	$response["eventos"][$index]["title"] = $fila["titulo"];
    	$response["eventos"][$index]["start"] = $fila["start_date"] . " " . $fila["start_hour"];
    	$response["eventos"][$index]["end"] = $fila["end_date"] . " " . $fila["end_hour"];
    	$response["eventos"][$index]["id"] = $fila["id"];

    	$index++;

    }      


    // SI NO HAY EVENTOS ENVIO UN ARREGLO VACIO PARA INICIALIZAR EL CALENDARIO
    if ($index == 0){
        $response["msg"] = "OK";
        $response["eventos"][0]["title"] = "";
        $response["eventos"][0]["start"] = "0000-00-00";
        $response["eventos"][0]["end"] = "0000-00-00";
    }

  
/*
    $response["msg"] = "OK";
    $response["eventos"][0]["title"] = "prueba";
    $response["eventos"][0]["start"] = "2018-11-14 06:00:00";
    $response["eventos"][0]["end"] = "2018-11-14 07:00:00";

    $response["eventos"][1]["title"] = "prueba2";
    $response["eventos"][1]["start"] = "2018-11-04 06:00:00";
    $response["eventos"][1]["end"] = "2018-11-04 07:00:00";
*/




  echo json_encode($response);

  $con->cerrarConexion();


 ?>
