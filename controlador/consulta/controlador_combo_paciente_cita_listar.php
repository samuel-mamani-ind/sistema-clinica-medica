<?php
  require '../../modelo/modelo_consulta.php';

  $MC = new Modelo_Consulta();
  $consulta = $MC->listar_combo_paciente_cita();
  echo json_encode($consulta);
?>