<?php
  require '../../modelo/modelo_cita.php';

  $MC = new Modelo_Cita();

  $idpaciente = htmlspecialchars($_POST['idpac'],ENT_QUOTES,'UTF-8');
  $idmedico = htmlspecialchars($_POST['idmed'],ENT_QUOTES,'UTF-8');
  $idespecialidad = htmlspecialchars($_POST['ides'],ENT_QUOTES,'UTF-8');
  $descripcion = htmlspecialchars($_POST['des'],ENT_QUOTES,'UTF-8');
  $idusuario = htmlspecialchars($_POST['idusu'],ENT_QUOTES,'UTF-8');

  $consulta = $MC->Registrar_Cita($idpaciente,$idmedico,$descripcion,$idusuario,$idespecialidad);
  echo ($consulta);

?>