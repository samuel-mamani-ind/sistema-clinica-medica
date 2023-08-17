<?php
  require '../../modelo/modelo_consulta.php';

  $MC = new Modelo_Consulta();

  $id = htmlspecialchars($_POST['idcon'],ENT_QUOTES,'UTF-8');
  $desconsulta = htmlspecialchars($_POST['desconsulta'],ENT_QUOTES,'UTF-8');
  $desdiagnostico = htmlspecialchars($_POST['desdiagnostico'],ENT_QUOTES,'UTF-8');

  $consulta = $MC->Modificar_Consulta($id,$desconsulta,$desdiagnostico);
  echo ($consulta);

?>