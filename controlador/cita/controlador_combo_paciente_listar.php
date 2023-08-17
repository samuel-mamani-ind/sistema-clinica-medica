<?php
  require '../../modelo/modelo_cita.php';

  $MC = new Modelo_Cita();
  $consulta = $MC->listar_combo_paciente();
  echo json_encode($consulta);
?>