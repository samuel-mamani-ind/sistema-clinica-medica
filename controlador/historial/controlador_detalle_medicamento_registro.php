<?php
  require '../../modelo/modelo_historial.php';

  $MH = new Modelo_Historial();

  $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
  $idmedicamento = htmlspecialchars($_POST['idmedicamento'],ENT_QUOTES,'UTF-8');
  $cantidad = htmlspecialchars($_POST['cantidad'],ENT_QUOTES,'UTF-8');

  $arreglo_medicamento = explode(",",$idmedicamento);//separo los datos
  $arreglo_cantidad = explode(",",$cantidad);//separo los datos

  for($i=0;$i<count($arreglo_medicamento);$i++){
    $consulta = $MH->Registrar_Detalle_Medicamento($id,$arreglo_medicamento[$i],$arreglo_cantidad[$i]);
  }
  echo ($consulta);
?>