<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once '../../../conexion_reportes/r_conexion.php';
$consulta="
  SELECT cita.cita_id, cita.cita_nroatencion,cita.cita_feregistro,
  CONCAT_WS(' ',medico_nombre,medico_apepat,medico_apemat) AS medico,
  CONCAT_WS(' ',paciente_nombre,paciente_apepat,paciente_apemat) AS paciente,
  cita.cita_descripcion,
  especialidad.especialidad_nombre
  FROM cita
  INNER JOIN medico
    ON cita.medico_id=medico.medico_id
  INNER JOIN paciente
    ON cita.paciente_id=paciente.paciente_id
  INNER JOIN especialidad
    ON medico.especialidad_id=especialidad.especialidad_id
  WHERE cita_id='".$_GET['id']."'
";
$html="

<style>
.barcode {
    padding: 1.5mm;
    margin: 0;
    vertical-align: top;
    color: black;
}
.barcodecell {
    text-align: center;
    vertical-align: middle;
}
</style>


  <table>
  <tr>
    <td>
      <h2 style='font-size:18px'>DATOS DE LA CITA</h2>
    </td>
  </tr>
  </table>
";

$resultado = $mysqli->query($consulta);
while($row = $resultado->fetch_assoc()){
  $html.="<br><b>Numero atencion:</b> ".$row['cita_nroatencion']."
  <br><br><b>Paciente:</b><br> ".$row['paciente']."
  <br><b>Medico:</b><br> ".$row['medico']."
  <br><b>Especialidad:</b><br> ".$row['especialidad_nombre']."
  <br><b>Descripcion:</b><br> ".$row['cita_descripcion']."
  <br><b>Fecha:</b><br> ".$row['cita_feregistro']."
  <br>-----------------------------------------<br>
  <span style='font-size:12px'>Gracias por confiar en nosotros!</span><br>
  <span style='font-size:12px'>Telefono: xxx-xxxxxxx</span>
  
  <div class='barcodecell'><barcode code='".$row['cita_id']."' type='I25' class='barcode' /><br>".$row['cita_id']."</div>";
}

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [80, 150]]);
$mpdf->WriteHTML($html);
$mpdf->Output();

