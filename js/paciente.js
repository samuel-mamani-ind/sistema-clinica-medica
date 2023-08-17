var tablepaciente;
function listar_paciente(){
  tablepaciente = $("#tabla_paciente").DataTable({
     "ordering":false,
     "paging": false,
     "searching": { "regex": true },
     "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
     "pageLength": 100,
     "destroy":true,
     "async": false ,
     "processing": true,
     "ajax":{
         "url":"../controlador/paciente/controlador_paciente_listar.php",
         type:'POST'
     },
     "order":[[1,'asc']],
     "columns":[
        {"defaultContent":""},
        {"data":"paciente_nrodocumento"},
        {"data":"paciente"},
        {"data":"paciente_direccion"},
        {"data":"paciente_sexo",
        render: function (data, type, row ) {
          if(data=='M'){
            return "MASCULINO";                   
          }else{
            return "FEMENINO"; 
          }
        }
        },
        {"data":"paciente_movil"},
        {"data":"paciente_estatus",
        render: function (data, type, row ) {
            if(data=='ACTIVO'){
                return "<span class='label label-success'>"+data+"</span>";                   
            }
            if(data=='INACTIVO'){
              return "<span class='label label-danger'>"+data+"</span>";                   
            } 
          }
        },
         {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
     ],

     "language":idioma_espanol,
     select: true
 });

    document.getElementById("tabla_paciente_filter").style.display = "none";

    $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('tr').attr('data-column') );
    });

    tablepaciente.on( 'draw.dt', function () {
      var PageInfo = $('#tabla_paciente').DataTable().page.info();
      tablepaciente.column(0, { page: 'current' }).nodes().each( function (cell, i) {
              cell.innerHTML = i + 1 + PageInfo.start;
          } );
    } );

}

$("#tabla_paciente").on('click','.editar',function(){
  var data = tablepaciente.row($(this).parents('tr')).data();//Detecta a que fila hago click y captura los datos en la variable data.
  if(tablepaciente.row(this).child.isShown()){//Cuando esta en tamaño responsivo
    var data = tablepaciente.row(this).data();
  }
  $("#modal_editar").modal({backdrop:'static',keyboard:false});
  $("#modal_editar").modal('show');

  $("#id_paciente").val(data.paciente_id);

  $("#txt_nombres_editar").val(data.paciente_nombre);
  $("#txt_apepat_editar").val(data.paciente_apepat);
  $("#txt_apemat_editar").val(data.paciente_apemat);
  $("#txt_direccion_editar").val(data.paciente_direccion);
  $("#txt_movil_editar").val(data.paciente_movil);

  $("#txt_ndoc_editar_actual").val(data.paciente_nrodocumento);
  $("#txt_ndoc_editar_nuevo").val(data.paciente_nrodocumento);

  $("#txt_sexo_editar").val(data.paciente_sexo).trigger("change");
  $("#txt_fenac_editar").val(data.paciente_fenac);
  $("#cbm_estatus_editar").val(data.paciente_estatus).trigger("change");

})

function AbrirModalRegistro(){
  $("#modal_registro").modal({backdrop:'static',keyboard:false});
  $("#modal_registro").modal('show');
}

function filterGlobal() {
  $('#tabla_paciente').DataTable().search(
      $('#global_filter').val(),
  ).draw();
}

function Registrar_Paciente(){
  var nombres = $("#txt_nombres").val();
  var apepat = $("#txt_apepat").val();
  var apemat = $("#txt_apemat").val();
  var direccion = $("#txt_direccion").val();
  var movil = $("#txt_movil").val();
  var ndoc = $("#txt_ndoc").val();
  var sexo = $("#txt_sexo").val();
  var fenac = $("#txt_fenac").val();

  if(nombres.length==0 || apepat.length==0 || apemat.length==0 || direccion.length==0 || movil.length==0 || ndoc.length==0 || sexo.length==0 || fenac.length==0){
    Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/paciente/controlador_paciente_registro.php',
    type:'POST',
    data:{
      nombres:nombres,
      apepat:apepat,
      apemat:apemat,
      direccion:direccion,
      movil:movil,
      ndoc:ndoc,
      sexo:sexo,
      fenac:fenac
    }
  }).done(function(resp){
    if(resp>0){
      if(resp==1){
        listar_paciente();
        LimpiarCampos();
        $("#modal_registro").modal('hide');
        Swal.fire("Mensaje De Confirmacion","Datos guardados corrrectamente","success");
      }else{
        LimpiarCampos();
        Swal.fire("Mensaje De Advertencia","El nro de documento ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}

function LimpiarCampos(){
  $("#txt_nombres").val("");
  $("#txt_apepat").val("");
  $("#txt_apemat").val("");
  $("#txt_direccion").val("");
  $("#txt_movil").val("");
  $("#txt_ndoc").val("");
  $("#txt_sexo").val("");
  $("#txt_fenac").val("");
}

function Modificar_Paciente(){
  var idpaciente = $("#id_paciente").val();

  var nombres = $("#txt_nombres_editar").val();
  var apepat = $("#txt_apepat_editar").val();
  var apemat = $("#txt_apemat_editar").val();
  var direccion = $("#txt_direccion_editar").val();
  var movil = $("#txt_movil_editar").val();

  var ndocactual = $("#txt_ndoc_editar_actual").val();
  var ndocnuevo = $("#txt_ndoc_editar_nuevo").val();

  var sexo = $("#txt_sexo_editar").val();
  var fenac = $("#txt_fenac_editar").val();
  var estatus = $("#cbm_estatus_editar").val();

  if(nombres.length==0 || apepat.length==0 || apemat.length==0 || direccion.length==0 || movil.length==0 || ndocnuevo.length==0 || sexo.length==0 || fenac.length==0){
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/paciente/controlador_paciente_modificar.php',
    type:'POST',
    data:{
      idpaciente:idpaciente,
      nombres:nombres,
      apepat:apepat,
      apemat:apemat,
      direccion:direccion,
      movil:movil,
      ndocactual:ndocactual,
      ndocnuevo:ndocnuevo,
      sexo:sexo,
      fenac:fenac,
      es:estatus
    }
  }).done(function(resp){
    if(resp>0){
      if(resp==1){
        listar_paciente();
        LimpiarCampos();
        $("#modal_editar").modal('hide');
        Swal.fire("Mensaje De Confirmacion","Datos guardados corrrectamente","success");
      }else{
        LimpiarCampos();
        Swal.fire("Mensaje De Advertencia","El nro de documento ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}