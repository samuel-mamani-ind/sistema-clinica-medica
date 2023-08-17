<?php
  class Modelo_Paciente{
    private $conexion;
    function __construct(){
      require_once 'modelo_conexion.php';
      $this->conexion = new conexion();
      $this->conexion->conectar();
    }


    function listar_paciente(){
      $sql = "call SP_LISTAR_PACIENTE()";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)){
        while($consulta_VU = mysqli_fetch_assoc($consulta)){
          $arreglo["data"][]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

    function Registrar_Paciente($nombres,$apepat,$apemat,$direccion,$movil,$ndoc,$sexo,$fenac){
      $sql = "call SP_REGISTRAR_PACIENTE('$nombres','$apepat','$apemat','$direccion','$movil','$ndoc','$sexo','$fenac')";
      if ($consulta = $this->conexion->conexion->query($sql)){
        if($row = mysqli_fetch_array($consulta)){
            return $id = trim($row[0]);
        }
        $this->conexion->cerrar();
      }
    }

    function Modificar_Paciente($idpaciente,$nombres,$apepat,$apemat,$direccion,$movil,$ndocactual,$ndocnuevo,$sexo,$fenac,$estatus){
      $sql = "call SP_MODIFICAR_PACIENTE('$idpaciente','$nombres','$apepat','$apemat','$direccion','$movil','$ndocactual','$ndocnuevo','$sexo','$fenac','$estatus')";
      if ($consulta = $this->conexion->conexion->query($sql)){
        if($row = mysqli_fetch_array($consulta)){
            return $id = trim($row[0]);
        }
        $this->conexion->cerrar();
      }
    }

  }

?>