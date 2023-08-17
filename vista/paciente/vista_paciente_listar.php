<script type="text/javascript" src="../js/paciente.js?rev=<?php echo time(); ?>"></script>
<div class="col-md-12">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MANTENIMIENTO DE PACIENTE</h3>
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
          <table id="tabla_paciente" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nro Doc</th>              
              <th>Paciente</th>              
              <th>Direccion</th>
              <th>Sexo</th>
              <th>Celular</th>
              <th>Estatus</th>
              <th>Acci&oacute;n</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>#</th>
              <th>Nro Doc</th>              
              <th>Paciente</th>              
              <th>Direccion</th>
              <th>Sexo</th>
              <th>Celular</th>
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
        <h4 class="modal-title">Registro de Paciente</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <label for="">Nombres</label>
          <input type="text" class="form-control" id="txt_nombres" placeholder="Escriba su nombre" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-6">
          <label for="">A. Paterno</label>
          <input type="text" class="form-control" id="txt_apepat" placeholder="Ingrese apellido paterno" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-6">
          <label for="">A. Materno</label>
          <input type="text" class="form-control" id="txt_apemat" placeholder="Ingrese apellido materno" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-4">
          <label for="">Direccion</label>
          <input type="text" class="form-control" id="txt_direccion" placeholder="Ingrese su direccion"><br>
        </div>
        <div class="col-lg-4">
          <label for="">Movil</label>
          <input type="text" class="form-control" id="txt_movil" placeholder="Ingrese su movil"><br>
        </div>
        <div class="col-lg-4">
          <label for="">Nro Documento</label>
          <input type="text" class="form-control" id="txt_ndoc" placeholder="Ingrese su nro de documento" onkeypress="return soloNumeros(event)"><br>
        </div>
        <div class="col-lg-6">
          <label for="">Sexo</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="txt_sexo">
          <option value="M">MASCULINO</option>
          <option value="F">FEMENINO</option>
          </select><br>
        </div>
        <div class="col-lg-6">
          <label for="">Fecha nacimiento</label>
          <input type="date" class="form-control" id="txt_fenac"><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Registrar_Paciente()"> <i class="fa fa-check"></i>&nbsp; Registrar</button>
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
        <h4 class="modal-title">Editar Paciente</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <input type="hidden" id="id_paciente">
          <label for="">Nombres</label>
          <input type="text" class="form-control" id="txt_nombres_editar" placeholder="Escriba su nombre" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-6">
          <label for="">A. Paterno</label>
          <input type="text" class="form-control" id="txt_apepat_editar" placeholder="Ingrese apellido paterno" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-6">
          <label for="">A. Materno</label>
          <input type="text" class="form-control" id="txt_apemat_editar" placeholder="Ingrese apellido materno" onkeypress="return soloLetras(event)"><br>
        </div>
        <div class="col-lg-4">
          <label for="">Direccion</label>
          <input type="text" class="form-control" id="txt_direccion_editar" placeholder="Ingrese su direccion"><br>
        </div>
        <div class="col-lg-4">
          <label for="">Movil</label>
          <input type="text" class="form-control" id="txt_movil_editar" placeholder="Ingrese su movil"><br>
        </div>
        <div class="col-lg-4">
          <label for="">Nro Documento</label>
          <input type="hidden" id="txt_ndoc_editar_actual" placeholder="Ingrese su nro de documento" onkeypress="return soloNumeros(event)">
          <input type="text" class="form-control" id="txt_ndoc_editar_nuevo" placeholder="Ingrese su nro de documento" onkeypress="return soloNumeros(event)"><br>
        </div>
        <div class="col-lg-4">
          <label for="">Sexo</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="txt_sexo_editar">
          <option value="M">MASCULINO</option>
          <option value="F">FEMENINO</option>
          </select><br>
        </div>
        <div class="col-lg-4">
          <label for="">Fecha nacimiento</label>
          <input type="date" class="form-control" id="txt_fenac_editar"><br>
        </div>
      </div>
      <div class="col-lg-4">
          <label for="">Estatus</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_estatus_editar">
          <option value="ACTIVO">ACTIVO</option>
          <option value="INACTIVO">INACTIVO</option>
          </select><br><br>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Modificar_Paciente()"> <i class="fa fa-check"></i>&nbsp; Modificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>&nbsp; Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    listar_paciente();
    $('.js-example-basic-single').select2();
    $("#modal_registro").on('shown.bs.modal',function(){
      $("#txt_nombres").focus();
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