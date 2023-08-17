<?php
  require '../../modelo/modelo_consulta.php';

  $MC = new Modelo_Consulta();

  $idpaciente = htmlspecialchars($_POST['idpac'],ENT_QUOTES,'UTF-8');
  $desconsulta = htmlspecialchars($_POST['desconsulta'],ENT_QUOTES,'UTF-8');
  $desdiagnostico = htmlspecialchars($_POST['desdiagnostico'],ENT_QUOTES,'UTF-8');

  $consulta = $MC->Registrar_consulta($idpaciente,$desconsulta,$desdiagnostico);
  echo ($consulta);

?>