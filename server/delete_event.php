<?php 

  include('conector.php');

  	//ELIMINACION DE EVENTOS

  	$condicion = "id = " . $_POST["id"];
  
	if($con->eliminarRegistro('eventos', $condicion) ){
      $response['msg']="OK";
    }else {
      $response['msg']= "Hubo un error al eliminar el evento";
    }


  $response["recibidos"] = $_POST;

  $con->cerrarConexion();

  echo json_encode($response);


?>
