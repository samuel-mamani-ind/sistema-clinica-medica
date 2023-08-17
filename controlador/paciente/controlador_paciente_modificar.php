<?php
  require '../../modelo/modelo_paciente.php';

  $MP = new Modelo_Paciente();

  $idpaciente = htmlspecialchars($_POST['idpaciente'],ENT_QUOTES,'UTF-8');

  $nombres = htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8');
  $apepat = htmlspecialchars($_POST['apepat'],ENT_QUOTES,'UTF-8');
  $apemat = htmlspecialchars($_POST['apemat'],ENT_QUOTES,'UTF-8');
  $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
  $movil = htmlspecialchars($_POST['movil'],ENT_QUOTES,'UTF-8');
  $ndocactual = htmlspecialchars($_POST['ndocactual'],ENT_QUOTES,'UTF-8');
  $ndocnuevo = htmlspecialchars($_POST['ndocnuevo'],ENT_QUOTES,'UTF-8');
  $sexo = htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
  $fenac = htmlspecialchars($_POST['fenac'],ENT_QUOTES,'UTF-8');
  $estatus = htmlspecialchars($_POST['es'],ENT_QUOTES,'UTF-8');

  $consulta = $MP->Modificar_Paciente($idpaciente,$nombres,$apepat,$apemat,$direccion,$movil,$ndocactual,$ndocnuevo,$sexo,$fenac,$estatus);
  echo ($consulta);

?>