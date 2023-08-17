<script type="text/javascript" src="../js/cita.js?rev=<?php echo time(); ?>"></script>
<div class="col-md-12">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MANTENIMIENTO DE CITAS</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

    </div>

    <div class="box-body">
      <div class="form-group">
        <div class="col-lg-10">
          <div class="input-group">
            <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresa los datos a buscar">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
          </div>
        </div>
        <div class="col-lg-2">
          <button class="btn btn-success" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Nuevo Registro</button>
        </div>
      </div>
        <div class="box-body">
          <table id="tabla_cita" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nro</th>
              <th>Fecha</th>
              <th>Paciente</th>
              <th>Medico</th>
              <th>Estatus</th>
              <th>Acci&oacute;n</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nro</th>
              <th>Fecha</th>
              <th>Paciente</th>
              <th>Medico</th>
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
        <h4 class="modal-title">Registro de Cita</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <label for="">Paciente</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_paciente">
          </select><br>
        </div>
        <div class="col-lg-6">
          <label for="">Especialidad</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_especialidad">
          </select><br>
        </div>
        <div class="col-lg-6">
          <label for="">Medico</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_medico">
          </select><br><br>
        </div>
        <div class="col-lg-12">
          <label for="">Descripcion</label>
          <textarea id="txt_descripcion" rows="5" class="form-control" style="resize: none;"></textarea><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Registrar_Cita()"> <i class="fa fa-check"></i>&nbsp; Registrar</button>
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
        <h4 class="modal-title">Editar registro de Cita</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <input type="hidden" id="txt_idcita">
          <label for="">Paciente</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_paciente_editar">
          </select><br>
        </div>
        <div class="col-lg-6">
          <label for="">Especialidad</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_especialidad_editar">
          </select><br>
        </div>
        <div class="col-lg-6">
          <label for="">Medico</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_medico_editar">
          </select><br><br>
        </div>
        <div class="col-lg-12">
          <label for="">Descripcion</label>
          <textarea id="txt_descripcion_editar" rows="5" class="form-control" style="resize: none;"></textarea><br>
        </div>
        <div class="col-lg-12">
          <label for="">Estatus</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_estatus_editar">
          <option value="PENDIENTE">PENDIENTE</option>
          <option value="CANCELADA">CANCELADA</option>
          </select><br><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Modificar_Cita()"> <i class="fa fa-check"></i>&nbsp; Modificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>&nbsp; Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    listar_cita();

    listar_combo_paciente();
    listar_combo_especialidad();

    listar_combo_paciente_editar();
    listar_combo_especialidad_editar();

    $("#cbm_especialidad").change(function(){
      var id = $("#cbm_especialidad").val();
       listar_combo_medico(id);//Depende de especialidad
    });

    $("#cbm_especialidad_editar").change(function(){
      var id = $("#cbm_especialidad_editar").val();
       listar_combo_medico_editar(id,'');//Depende de especialidad
    });

    $('.js-example-basic-single').select2();
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