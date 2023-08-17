<?php
  require '../../modelo/modelo_historial.php';

  $MH = new Modelo_Historial();

  $consulta = $MH->listar_combo_insumos();
  echo json_encode($consulta);
?>