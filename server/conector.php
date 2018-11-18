<?php


  class ConectorBD
  {
    private $host;
    private $user;
    private $password;
    private $conexion;

    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }

    function initConexion($nombre_db){
      $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
      if ($this->conexion->connect_error) {
        return "Error:" . $this->conexion->connect_error;
      }else {
        return "OK";
      }
    }

    
    function ejecutarQuery($query){
      //echo $query;
      return $this->conexion->query($query);
    }

    function cerrarConexion(){
      $this->conexion->close();
    }

   
    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= "'" . $value . "'";
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ');';
        $i++;
      }
      return $this->ejecutarQuery($sql);

    }

    function getConexion(){
      return $this->conexion;
    }



    function actualizarRegistro($tabla, $data, $condicion){
      $sql = 'UPDATE '.$tabla.' SET ';

      $finalData = array_keys($data);
      $ultima_key = end($finalData);

      foreach ($data as $key => $value) {
        $sql .= $key . " = '" . $value . "' ";
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= ' WHERE '.$condicion.';';

      }

      return $this->ejecutarQuery($sql);
    }




    function eliminarRegistro($tabla, $condicion){
      $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
      return $this->ejecutarQuery($sql);
    }

    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";

      $finalTabla = array_keys($campos);

      $ultima_key = end($finalTabla);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }

      $finalTabla = array_keys($tablas);

      $ultima_key = end($finalTabla);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }

      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }

      return $this->ejecutarQuery($sql);
    }


  }



  $con = new ConectorBD('localhost','root','');
  $RespConexion = $con->initConexion('calendario');

  if ($RespConexion != 'OK') {
    $response['msg']= "No se pudo conectar a la base de datos";
    echo json_encode($response);
  }




 ?>
