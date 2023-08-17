<script type="text/javascript" src="../js/medicamento.js?rev=<?php echo time(); ?>"></script>
<div class="col-md-12">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MANTENIMIENTO DE MEDICAMENTO</h3>
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
          <table id="tabla_medicamento" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Alias</th>
              <th>Stock</th>
              <th>Fecha Registros</th>
              <th>Estatus</th>
              <th>Acci&oacute;n</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Alias</th>
              <th>Stock</th>
              <th>Fecha Registros</th>
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
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registro de Medicamento</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <label for="">Nombre</label>
          <input type="text" class="form-control" id="txt_medicamento" placeholder="Escriba medicamento" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-12">
          <label for="">Alias</label>
          <input type="text" class="form-control" id="txt_alias" placeholder="Escriba alias" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-12">
          <label for="">Stock</label>
          <input type="text" class="form-control" id="txt_stock" placeholder="Ingrese stock" maxlength="5" onkeypress="return soloNumeros(event)"><br>
        </div>
        <div class="col-lg-12">
          <label for="">Estatus</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_estatus">
          <option value="ACTIVO">ACTIVO</option>
          <option value="INACTIVO">INACTIVO</option>
          <option value="AGOTADO">AGOTADO</option>
          </select><br><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Registrar_Medicamento()"> <i class="fa fa-check"></i>&nbsp; Registrar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>&nbsp; Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modal_editar" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Medicamento</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <label for="">Nombre</label>
          <input type="hidden" id="txt_idmedicamento">
          <input type="hidden" id="txt_medicamento_actual_editar" placeholder="Escriba medicamento" onkeypress="return soloLetras(event)">
          <input type="text" class="form-control" id="txt_medicamento_nuevo_editar" placeholder="Escriba medicamento" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-12">
          <label for="">Alias</label>
          <input type="text" class="form-control" id="txt_alias_editar" placeholder="Escriba alias" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-12">
          <label for="">Stock</label>
          <input type="text" class="form-control" id="txt_stock_editar" placeholder="Ingrese stock" maxlength="5" onkeypress="return soloNumeros(event)"><br>
        </div>
        <div class="col-lg-12">
          <label for="">Estatus</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_estatus_editar">
          <option value="ACTIVO">ACTIVO</option>
          <option value="INACTIVO">INACTIVO</option>
          <option value="AGOTADO">AGOTADO</option>
          </select><br><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Modificar_Medicamento()"> <i class="fa fa-check"></i>&nbsp; Modificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>&nbsp; Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    listar_medicamento()
    $('.js-example-basic-single').select2();
    $("#modal_registro").on('shown.bs.modal',function(){
      $("#txt_medicamento").focus();
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