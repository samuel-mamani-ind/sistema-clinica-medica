<script type="text/javascript" src="../js/medico.js?rev=<?php echo time(); ?>"></script>
<div class="col-md-12">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MANTENIMIENTO DE MEDICO</h3>
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
          <table id="tabla_medico" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nro Doc</th>              
              <th>Medico</th>              
              <th>Nro Colegiatura</th>
              <th>Especialidad</th>
              <th>Sexo</th>
              <th>Celular</th>
              <th>Acci&oacute;n</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nro Doc</th>              
              <th>Medico</th>              
              <th>Nro Colegiatura</th>
              <th>Especialidad</th>
              <th>Sexo</th>
              <th>Celular</th>
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
        <h4 class="modal-title">Registro de Medico</h4>
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
        <div class="col-lg-6">
          <label for="">Colegiatura</label>
          <input type="text" class="form-control" id="txt_ncol" placeholder="Ingrese su nro de colegiatura" onkeypress="return soloNumeros(event)"><br>
        </div>
        <div class="col-lg-6">
          <label for="">Especialidad</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_especialidad">
          </select><br>
        </div>
        <div class="col-lg-12" style="text-align:center">
          <b>DATOS DEL USUSARIO</b><br><br>

        </div>
        <div class="col-lg-6">
          <label for="">Usuario</label>
          <input type="text" class="form-control" id="txt_usu" placeholder="Ingrese su usuario"><br>
        </div>
        <div class="col-lg-6">
          <label for="">Contraseña</label>
          <input type="text" class="form-control" id="txt_contra" placeholder="Ingrese su contraseña"><br>
        </div>
        <div class="col-lg-6">
          <label for="">Rol</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_rol">
          </select><br>
        </div>
        <div class="col-lg-6">
          <label for="">Email</label>
          <input type="text" class="form-control" id="txt_email" placeholder="Ingrese su email"><br>
          <label for="" id="emailOK" style="color:red"></label>
          <input type="hidden" id="validar_email">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Registrar_Medico()"> <i class="fa fa-check"></i>&nbsp; Registrar</button>
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
        <h4 class="modal-title">Editar Medico</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <input type="hidden" id="id_medico">
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
        <div class="col-lg-6">
          <label for="">Sexo</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="txt_sexo_editar">
          <option value="M">MASCULINO</option>
          <option value="F">FEMENINO</option>
          </select><br>
        </div>
        <div class="col-lg-6">
          <label for="">Fecha nacimiento</label>
          <input type="date" class="form-control" id="txt_fenac_editar"><br>
        </div>
        <div class="col-lg-6">
          <label for="">Colegiatura</label>
          <input type="hidden" id="txt_ncol_editar_actual" placeholder="Ingrese su nro de colegiatura" onkeypress="return soloNumeros(event)">
          <input type="text" class="form-control" id="txt_ncol_editar_nuevo" placeholder="Ingrese su nro de colegiatura" onkeypress="return soloNumeros(event)"><br>
        </div>
        <div class="col-lg-6">
          <label for="">Especialidad</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_especialidad_editar">
          </select><br>
        </div>
        <div class="col-lg-12" style="text-align:center">
          <b>DATOS DEL USUSARIO</b><br><br>

        </div>
        <div class="col-lg-6">
          <label for="">Usuario</label>
          <input type="hidden" id="id_usuario">
          <input type="text" class="form-control" id="txt_usu_editar" placeholder="Ingrese su usuario" disabled><br>
        </div>
        <div class="col-lg-6">
          <label for="">Rol</label>
          <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_rol_editar" disabled>
          </select><br>
        </div>
        <div class="col-lg-12">
          <label for="">Email</label>
          <input type="text" class="form-control" id="txt_email_editar" placeholder="Ingrese su email"><br>
          <label for="" id="emailOK_editar" style="color:red"></label>
          <input type="hidden" id="validar_email_editar">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Editar_Medico()"> <i class="fa fa-check"></i>&nbsp; Modificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>&nbsp; Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    listar_medico();
    listar_combo_rol();
    listar_combo_especialidad();
    $('.js-example-basic-single').select2();
    $("#modal_registro").on('shown.bs.modal',function(){
      $("#txt_nombres").focus();
    })
  });

  document.getElementById('txt_email').addEventListener('input', function() {
    campo = event.target;   
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if(emailRegex.test(campo.value)){
      $(this).css("border","");
      $("#emailOK").html("");
      $("#validar_email").val("correcto");
    }else{
      $(this).css("border","1px solid red");
      $("#emailOK").html("Email incorrecto");
      $("#validar_email").val("incorrecto");
    }

  });

  document.getElementById('txt_email_editar').addEventListener('input', function() {
    campo = event.target;   
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if(emailRegex.test(campo.value)){
      $(this).css("border","");
      $("#emailOK_editar").html("");
      $("#validar_email_editar").val("correcto");
    }else{
      $(this).css("border","1px solid red");
      $("#emailOK_editar").html("Email incorrecto");
      $("#validar_email_editar").val("incorrecto");
    }

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