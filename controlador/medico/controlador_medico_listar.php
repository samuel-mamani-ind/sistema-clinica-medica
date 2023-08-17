<?php
  require '../../modelo/modelo_medico.php';

  $MED = new Modelo_Medico();
  $consulta = $MED->listar_medico();
  if($consulta){
    echo json_encode($consulta);
  }else{
    echo '{
      "sEcho": 1,
      "iTotalRecords": "0",
      "iTotalDisplayRecords": "0",
      "aaData": []
    }';
  }

?>
