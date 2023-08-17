<?php
  require '../../modelo/modelo_cita.php';

  $MC = new Modelo_Cita();

  $idcita = htmlspecialchars($_POST['idcita'],ENT_QUOTES,'UTF-8');
  $paciente = htmlspecialchars($_POST['paciente'],ENT_QUOTES,'UTF-8');
  $especialidad = htmlspecialchars($_POST['especialidad'],ENT_QUOTES,'UTF-8');
  $medico = htmlspecialchars($_POST['medico'],ENT_QUOTES,'UTF-8');
  $descripcion = htmlspecialchars($_POST['descripcion'],ENT_QUOTES,'UTF-8');
  $estatus = htmlspecialchars($_POST['es'],ENT_QUOTES,'UTF-8');

  $consulta = $MC->Modificar_Cita($idcita,$paciente,$especialidad,$medico,$descripcion,$estatus);
  echo ($consulta);

?>