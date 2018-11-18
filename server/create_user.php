<?php

	//// INSERCION DE USUARIOS

  include('conector.php');

  //USUARIO-1
  $data[0]['usuario'] = "stevedux@gmail.com";
  $data[0]['nombre'] = "Steve Semprun";
  $data[0]['password'] = password_hash("1234", PASSWORD_DEFAULT);
  $data[0]['fecha_nac'] = "1975-10-27";

  //USUARIO-2
  $data[1]['usuario'] = "saidmathias@gmail.com";
  $data[1]['nombre'] = "Said Semprun";
  $data[1]['password'] = password_hash("said", PASSWORD_DEFAULT);
  $data[1]['fecha_nac'] = "2016-09-16";

  //USUARIO-3
  $data[2]['usuario'] = "criss.cristy@gmail.com";
  $data[2]['nombre'] = "Cristy Petit";
  $data[2]['password'] = password_hash("petit", PASSWORD_DEFAULT);
  $data[2]['fecha_nac'] = "1982-11-17";


  
	if($con->insertData('usuarios', $data[0]) && $con->insertData('usuarios', $data[1]) && $con->insertData('usuarios', $data[2]) ){

      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los usuarios no han sido cargados";
    }


  $con->cerrarConexion();

  echo json_encode($response);


 ?>
