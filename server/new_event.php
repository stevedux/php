<?php
  require('./conector.php');

  session_start();

  if (isset($_SESSION['id_usuario'])) {

      $data[0]['titulo'] = $_POST['titulo'];
      $data[0]['start_date'] = $_POST['start_date'];
      $data[0]['start_hour'] = $_POST['start_hour'];
   	  $data[0]['end_date'] = $_POST['end_date'];
      $data[0]['end_hour'] = $_POST['end_hour'];
      $data[0]['id_usuario']= $_SESSION['id_usuario'];

      if ($_POST['allDay'] == "true"){
      	$data[0]['allDay'] = "1";
      }else {$data[0]['allDay'] = "0";}



      if ($con->insertData('eventos', $data[0])) {
        $response['msg']= 'OK';
      }else {
        $response['msg']= 'No se pudo realizar la inserción de los datos';
      }

  }

  $response["dataRecibida"] = $_POST;
  

  echo json_encode($response);

  $con->cerrarConexion();

 ?>
