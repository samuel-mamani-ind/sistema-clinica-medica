<?php
  class Modelo_Consulta{
    private $conexion;
    function __construct(){
      require_once 'modelo_conexion.php';
      $this->conexion = new conexion();
      $this->conexion->conectar();
    }


    function listar_consulta($fechainicio,$fechafin){
      $sql = "call SP_LISTAR_CONSULTA('$fechainicio','$fechafin')";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)){
        while($consulta_VU = mysqli_fetch_assoc($consulta)){
          $arreglo["data"][]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

    function listar_combo_paciente_cita(){
      $sql = "call SP_LISTAR_PACIENTE_CITA()";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)){
        while($consulta_VU = mysqli_fetch_array($consulta)){
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

    function Registrar_consulta($idpaciente,$desconsulta,$desdiagnostico){
      $sql = "call SP_REGISTRAR_CONSULTA('$idpaciente','$desconsulta','$desdiagnostico')";
      if ($consulta = $this->conexion->conexion->query($sql)){
        return 1;
      }else{
        return 0;
      }
      $this->conexion->cerrar();
    }

    function Modificar_Consulta($id,$desconsulta,$desdiagnostico){
      $sql = "call SP_MODIFICAR_CONSULTA('$id','$desconsulta','$desdiagnostico')";
      if ($consulta = $this->conexion->conexion->query($sql)){
        return 1;
      }else{
        return 0;
      }
      $this->conexion->cerrar();
    }

  }

?>