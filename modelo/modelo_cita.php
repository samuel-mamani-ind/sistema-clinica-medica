<?php
  class Modelo_Cita{
    private $conexion;
    function __construct(){
      require_once 'modelo_conexion.php';
      $this->conexion = new conexion();
      $this->conexion->conectar();
    }


    function listar_cita(){
      $sql = "call SP_LISTAR_CITA()";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)){
        while($consulta_VU = mysqli_fetch_assoc($consulta)){
          $arreglo["data"][]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

    function listar_combo_paciente(){
      $sql = "call SP_LISTAR_COMBO_PACIENTE()";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)){
        while($consulta_VU = mysqli_fetch_array($consulta)){
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

    function listar_combo_medico($id){
      $sql = "call SP_LISTAR_COMBO_MEDICO('$id')";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)){
        while($consulta_VU = mysqli_fetch_array($consulta)){
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

    function Registrar_Cita($idpaciente,$idmedico,$descripcion,$idusuario,$idespecialidad){
      $sql = "call SP_REGISTRAR_CITA('$idpaciente','$idmedico','$descripcion','$idusuario','$idespecialidad')";
      if ($consulta = $this->conexion->conexion->query($sql)){
        if($row = mysqli_fetch_array($consulta)){
            return $id = trim($row[0]);
        }
        $this->conexion->cerrar();
      }
    }

    function Modificar_Cita($idcita,$paciente,$especialidad,$medico,$descripcion,$estatus){
      $sql = "call SP_MODIFICAR_CITA('$idcita','$paciente','$especialidad','$medico','$descripcion','$estatus')";
      if ($consulta = $this->conexion->conexion->query($sql)){
        return 1;
      }else{
        return 0;
      }
      $this->conexion->cerrar();
    }

  }

?>