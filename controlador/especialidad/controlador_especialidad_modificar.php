<?php
  require '../../modelo/modelo_especialidad.php';

  $ME = new Modelo_Especialidad();

  $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
  $especialidaactual = htmlspecialchars($_POST['espac'],ENT_QUOTES,'UTF-8');
  $especialidadnuevo = htmlspecialchars($_POST['esnu'],ENT_QUOTES,'UTF-8');
  $estatus = htmlspecialchars($_POST['es'],ENT_QUOTES,'UTF-8');
  $consulta = $ME->Modificar_Especialidad($id,$especialidaactual,$especialidadnuevo,$estatus);
  echo ($consulta);

?>