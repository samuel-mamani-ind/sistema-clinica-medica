<?php
  require '../../modelo/modelo_historial.php';

  $MH = new Modelo_Historial();

  $consulta = $MH->listar_combo_procedimiento();
  echo json_encode($consulta);
?>