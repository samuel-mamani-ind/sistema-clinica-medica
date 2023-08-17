<?php
  require '../../modelo/modelo_medico.php';

  $MME = new Modelo_Medico();
  $consulta = $MME->listar_combo_especialidad();
  echo json_encode($consulta);
?>