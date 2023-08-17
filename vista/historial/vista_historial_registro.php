<script type="text/javascript" src="../js/historial.js?rev=<?php echo time(); ?>"></script>
<div class="col-md-12">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MANTENIMIENTO DE REGISTRO DE HISTORIAL CLINICO</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

    </div>

    <div class="box-body">
      <div class="col-lg-2">
        <label for="">Codigo historial</label>
        <input type="text" id="txt_codhistorial" class="form-control" disabled>
      </div>
      <div class="col-lg-8">
        <label for="">Paciente</label>
        <input type="text" id="txt_paciente" class="form-control" disabled>
      </div>
      <div class="col-lg-2">
        <label for="">&nbsp;</label><br>
        <button class="btn btn-success" onclick="AbrirModalConsulta()"><i class="fa fa-search"></i> Buscar Consulta</button>
      </div>
      <div class="col-lg-6"><br>
        <label for="">Descripcion de la consulta</label>
        <textarea name="" id="txt_desconsulta" cols="30" rows="3" class="form-control" disabled></textarea>
      </div>
      <div class="col-lg-6"><br>
        <label for="">Diagnostico de la consulta</label>
        <textarea name="" id="txt_diagconsulta" cols="30" rows="3" class="form-control" disabled></textarea>
      </div>
      <input type="hidden" id="txt_idconsulta">

      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_x" data-toggle="tab" aria-expanded="true">Procedimiento</a></li>
            <li class=""><a href="#tab_y" data-toggle="tab" aria-expanded="false">Insumo</a></li>
            <li class=""><a href="#tab_z" data-toggle="tab" aria-expanded="false">Medicamento</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_x">
              <div class="row">
                <div class="col-lg-10">
                  <label for="">Seleccionar Procedimientos</label>
                  <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_procedimiento">
                  </select>
                </div>
                <div class="col-lg-2">
                  <label for="">&nbsp;</label><br>
                  <button class="btn btn-primary" style="width: 100%;" onclick="Agregar_Procedimiento()"><i class="fa fa-plus-square"></i>&nbsp; Agregar</button>
                </div>
                <div class="col-lg-12 table-responsive"><br>
                  <table id="tabla_procedimiento" style="width: 100%;" class="table">
                    <thead style="background-color: black;color:#FFFFFF">
                      <tr>
                        <th>ID</th>
                        <th>Procedimiento</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tabla_procedimiento">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab_y">
              <div class="row">
                <div class="col-lg-6">
                  <label for="">Seleccionar Insumo</label>
                  <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_insumos">
                  </select>
                </div>
                <div class="col-lg-2">
                  <label for="">Stock Actual</label>
                  <input type="text" class="form-control" id="stock_insumo" disabled>
                </div>
                <div class="col-lg-2">
                  <label for="">Cantidad Agregar</label>
                  <input type="text" class="form-control" id="txt_cantidad_agregar">
                </div>
                <div class="col-lg-2">
                  <label for="">&nbsp;</label><br>
                  <button class="btn btn-primary" style="width: 100%;" onclick="Agregar_Insumo()"><i class="fa fa-plus-square"></i>&nbsp; Agregar</button>
                </div>
                <div class="col-lg-12 table-responsive"><br>
                  <table id="tabla_insumo" style="width: 100%;" class="table">
                    <thead style="background-color: black;color:#FFFFFF">
                      <tr>
                        <th>ID</th>
                        <th>Insumo</th>
                        <th>Cantidad</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tabla_insumo">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab_z">
              <div class="row">
                <div class="col-lg-6">
                  <label for="">Seleccionar Medicamento</label>
                  <select class="js-example-basic-single" name="state" style="width: 100%;" id="cbm_medicamento">
                  </select>
                </div>
                <div class="col-lg-2">
                  <label for="">Stock Actual</label>
                  <input type="text" class="form-control" id="stock_medicamento" disabled>
                </div>
                <div class="col-lg-2">
                  <label for="">Cantidad Agregar</label>
                  <input type="text" class="form-control" id="txt_medicantidad_agregar">
                </div>
                <div class="col-lg-2">
                  <label for="">&nbsp;</label><br>
                  <button class="btn btn-primary" style="width: 100%;" onclick="Agregar_Medicamento()"><i class="fa fa-plus-square"></i>&nbsp; Agregar</button>
                </div>
                <div class="col-lg-12 table-responsive"><br>
                  <table id="tabla_medicamento" style="width: 100%;" class="table">
                    <thead style="background-color: black;color:#FFFFFF">
                      <tr>
                        <th>ID</th>
                        <th>Medicamento</th>
                        <th>Cantidad</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tabla_medicamento">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

      <div class="col-lg-12" style="text-align:center">
        <button class="btn btn-success btn-lg" onclick="Registrar_Historial()">REGISTRAR</button>
      </div>

    </div>
  </div>

  <!-- Modal Para Ver Las Consultas Disponibles A La Fecha-->
  <div class="modal fade" id="modal_consultas" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="text-align: center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Listado de Consultas Medica</h4>
        </div>
        <div class="modal-body">
          <div class="col-lg-12 table-responsive">
            <table id="tabla_consulta_historial" class="display responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Codigo Historial</th>
                  <th>Paciente</th>
                  <th>Accion</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
      listar_insumo()
      listar_procedimiento()
      listar_medicamento()
    });

    $("#cbm_medicamento").change(function() {
      var id = $("#cbm_medicamento").val();
      traerStockMedicamento(id); //Depende de especialidad
    });

    $("#cbm_insumos").change(function() {
      var id = $("#cbm_insumos").val();
      traerStockInsumo(id); //Depende de especialidad
    });

    $('.box').boxWidget({
      animationSpeed: 500,
      collapseTrigger: '[data-widget="collapse"]',
      removeTrigger: '[data-widget="remove"]',
      collapseIcon: 'fa-minus',
      expandIcon: 'fa-plus',
      removeIcon: 'fa-times',
    })
  </script>