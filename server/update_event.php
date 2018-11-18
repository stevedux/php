<?php 

  include('conector.php');

  	//ACTUALIZAR EVENTO

 	$condicion = "id = " . $_POST["id"];

  	$data["start_date"] = $_POST["start_date"];
  	$data["end_date"] = $_POST["end_date"];

  	$tabla = 'eventos';

	if($con->actualizarRegistro($tabla,$data , $condicion) ){
      $response['msg']="OK";
    }else {
      $response['msg']= "Hubo un error al actualizar el evento";
    }


  $response["recibidos"] = $_POST;

  $con->cerrarConexion();

  echo json_encode($response);


?>
