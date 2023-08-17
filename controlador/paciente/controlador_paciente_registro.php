<?php
  require '../../modelo/modelo_paciente.php';

  $MP = new Modelo_Paciente();

  $nombres = htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8');
  $apepat = htmlspecialchars($_POST['apepat'],ENT_QUOTES,'UTF-8');
  $apemat = htmlspecialchars($_POST['apemat'],ENT_QUOTES,'UTF-8');
  $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
  $movil = htmlspecialchars($_POST['movil'],ENT_QUOTES,'UTF-8');
  $ndoc = htmlspecialchars($_POST['ndoc'],ENT_QUOTES,'UTF-8');
  $sexo = htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
  $fenac = htmlspecialchars($_POST['fenac'],ENT_QUOTES,'UTF-8');

  $consulta = $MP->Registrar_Paciente($nombres,$apepat,$apemat,$direccion,$movil,$ndoc,$sexo,$fenac);
  echo ($consulta);

?>