<?php
  require '../../modelo/modelo_cita.php';

  $MC = new Modelo_Cita();

  $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');

  $consulta = $MC->listar_combo_medico($id);
  echo json_encode($consulta);
?>