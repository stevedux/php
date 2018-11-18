<?php

  require('./conector.php');

    $resultado_consulta = $con->consultar(['usuarios'],
    ['id','usuario', 'password'], 'WHERE usuario = "'. $_POST['usuario'] . '"');

    if ($resultado_consulta->num_rows != 0) {

      $fila = $resultado_consulta->fetch_assoc();

      if (password_verify($_POST['password'], $fila['password'])) {

        $response['acceso'] = 'concedido';

        session_start();
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['id_usuario'] = $fila['id'];

      }else {
        $response['motivo'] = 'Contraseña incorrecta';
        $response['acceso'] = 'rechazado';
      }

    }else{
      $response['motivo'] = 'Usuario incorrecto';
      $response['acceso'] = 'rechazado';
    }
  

  echo json_encode($response);

  $con->cerrarConexion();


 ?>
