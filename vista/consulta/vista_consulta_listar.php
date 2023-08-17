<script type="text/javascript" src="../js/consulta_medica.js?rev=<?php echo time(); ?>"></script>
<div class="col-md-12">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MANTENIMIENTO DE CONSULTA MEDICA</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

    </div>

    <div class="box-body">
      <div class="form-group">
        <div class="col-lg-4">
          <label for="">Fecha inicio</label>
          <input type="date" id="txt_fechainicio" class="form-control">
        </div>
        <div class="col-lg-4">
          <label for="">Fecha fin</label>
          <input type="date" id="txt_fechafin" class="form-control">
        </div>
        <div class="col-lg-2">
          <label for="">&nbsp;</label><br>
          <button class="btn btn-danger" style="width:100%" onclick="listar_consulta()"><i class="glyphicon glyphicon-search"></i>Buscar</button>
        </div>
        <div class="col-lg-2">
          <label for="">&nbsp;</label><br>
          <button class="btn btn-success" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Nuevo Registro</button>
        </div><br><br><br>
      </div>
        <div class="box-body">
          <table id="tabla_consulta_medica" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nro Documento</th>
              <th>Paciente</th>
              <th>Fecha</th>
              <th>Medico</th>
              <th>Especialidad</th>
              <th>Estatus</th>
              <th>Acci&oacute;n</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nro Documento</th>
              <th>Paciente</th>
              <th>Fecha</th>
              <th>Medico</th>
              <th>Especialidad</th>
              <th>Estatus</th>
              <th>Acci&oacute;n</th>
            </tr>
          </tfoot>
          </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Registro -->
<div class="modal fade" id="modal_registro" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registro de Consulta Medica</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <label for="">Paciente</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_paciente_consulta">
          </select><br>
        </div>
        <div class="col-lg-12">
          <label for="">Descripcion</label>
          <textarea id="txt_descripcion_consulta" rows="5" class="form-control" style="resize: none;"></textarea><br>
        </div>
        <div class="col-lg-12">
          <label for="">Diagnostico</label>
          <textarea id="txt_diagnostico_consulta" rows="5" class="form-control" style="resize: none;"></textarea><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Registrar_Consulta()"> <i class="fa fa-check"></i>&nbsp; Registrar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>&nbsp; Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modal_editar" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar de Consulta Medica</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <input type="hidden" id="txt_idconsulta">
          <label for="">Paciente</label>
          <input type="text" class="form-control" id="cbm_paciente_consulta_editar" disabled><br>
        </div>
        <div class="col-lg-12">
          <label for="">Descripcion</label>
          <textarea id="txt_descripcion_consulta_editar" rows="5" class="form-control" style="resize: none;"></textarea><br>
        </div>
        <div class="col-lg-12">
          <label for="">Diagnostico</label>
          <textarea id="txt_diagnostico_consulta_editar" rows="5" class="form-control" style="resize: none;"></textarea><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Modificar_Consulta()"> <i class="fa fa-check"></i>&nbsp; Modificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>&nbsp; Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    $('.js-example-basic-single').select2();
    var n = new Date();
    var y = n.getFullYear();
    var m = n.getMonth()+1;
    var d = n.getDate();
    if(d<10){
      d='0'+d;
    }
    if(m<10){
      m='0'+m;
    }
    document.getElementById('txt_fechainicio').value=y+"-"+m+"-"+d;
    document.getElementById('txt_fechafin').value=y+"-"+m+"-"+d;

    listar_consulta();
    listar_combo_paciente_consulta();
    $("#modal_registro").on('shown.bs.modal',function(){
      $("#txt_nrocita").focus();
    })
  });

  $('.box').boxWidget({
    animationSpeed: 500,
    collapseTrigger:'[data-widget="collapse"]',
    removeTrigger:'[data-widget="remove"]',
    collapseIcon:'fa-minus',
    expandIcon:'fa-plus',
    removeIcon:'fa-times',
  })

  
</script>