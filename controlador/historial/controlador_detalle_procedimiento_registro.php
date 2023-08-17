<?php
  require '../../modelo/modelo_historial.php';

  $MH = new Modelo_Historial();

  $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
  $idprocedimiento = htmlspecialchars($_POST['idprocedimiento'],ENT_QUOTES,'UTF-8');

  $arreglo_procedimiento = explode(",",$idprocedimiento);//separo los datos

  for($i=0;$i<count($arreglo_procedimiento);$i++){
    $consulta = $MH->Registrar_Detalle_procedimiento($id,$arreglo_procedimiento[$i]);
  }
  echo ($consulta);
?>