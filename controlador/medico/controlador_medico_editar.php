<?php
  require '../../modelo/modelo_medico.php';

  $MME= new Modelo_Medico();

  $idmed = htmlspecialchars($_POST['idmed'],ENT_QUOTES,'UTF-8');

  $nombres = htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8');
  $apepat = htmlspecialchars($_POST['apepat'],ENT_QUOTES,'UTF-8');
  $apemat = htmlspecialchars($_POST['apemat'],ENT_QUOTES,'UTF-8');
  $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
  $movil = htmlspecialchars($_POST['movil'],ENT_QUOTES,'UTF-8');

  $ndocactual = htmlspecialchars($_POST['ndocactual'],ENT_QUOTES,'UTF-8');
  $ndocnuevo = htmlspecialchars($_POST['ndocnuevo'],ENT_QUOTES,'UTF-8');

  $sexo = htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
  $fenac = htmlspecialchars($_POST['fenac'],ENT_QUOTES,'UTF-8');

  $ncolactual = htmlspecialchars($_POST['ncolactual'],ENT_QUOTES,'UTF-8');
  $ncolnuevo = htmlspecialchars($_POST['ncolnuevo'],ENT_QUOTES,'UTF-8');

  $especialidad = htmlspecialchars($_POST['especialidad'],ENT_QUOTES,'UTF-8');

  $idusu = htmlspecialchars($_POST['idusu'],ENT_QUOTES,'UTF-8');
  $email = htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');

  $consulta = $MME->Modificar_Medico($idmed,$nombres,$apepat,$apemat,$direccion,$movil,$sexo,$fenac,$ndocactual,$ndocnuevo,$ncolactual,$ncolnuevo,$especialidad,$email,$idusu);
  echo ($consulta);

?>