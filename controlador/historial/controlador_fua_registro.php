<?php
  require '../../modelo/modelo_historial.php';

  $MH = new Modelo_Historial();

  $idhistorial = htmlspecialchars($_POST['idhistorial'],ENT_QUOTES,'UTF-8');
  $ididconsulta = htmlspecialchars($_POST['idconsulta'],ENT_QUOTES,'UTF-8');

  $consulta = $MH->Registrar_Fua($idhistorial,$ididconsulta);
  echo ($consulta);
?>