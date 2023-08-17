var tablemedico;
function listar_medico(){
  tablemedico = $("#tabla_medico").DataTable({
     "ordering":false,
     "paging": false,
     "searching": { "regex": true },
     "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
     "pageLength": 100,
     "destroy":true,
     "async": false ,
     "processing": true,
     "ajax":{
         "url":"../controlador/medico/controlador_medico_listar.php",
         type:'POST'
     },
     "order":[[1,'asc']],
     "columns":[
        {"defaultContent":""},
        {"data":"medico_nrodocumento"},
        {"data":"medico"},
        {"data":"medico_colegiatura"},
        {"data":"especialidad_nombre"},
        {"data":"medico_sexo",
        render: function (data, type, row ) {
            if(data=='M'){
              return "MASCULINO";                   
            }else{
              return "FEMENINO";   
            }
          }
        },
        {"data":"medico_movil"},
         {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
     ],

     "language":idioma_espanol,
     select: true
 });

    document.getElementById("tabla_medico_filter").style.display = "none";

    $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('tr').attr('data-column') );
    });

    tablemedico.on( 'draw.dt', function () {
      var PageInfo = $('#tabla_medico').DataTable().page.info();
      tablemedico.column(0, { page: 'current' }).nodes().each( function (cell, i) {
              cell.innerHTML = i + 1 + PageInfo.start;
          } );
    } );

}

function filterGlobal() {
  $('#tabla_medico').DataTable().search(
      $('#global_filter').val(),
  ).draw();
}

function AbrirModalRegistro(){
  $("#modal_registro").modal({backdrop:'static',keyboard:false});
  $("#modal_registro").modal('show');
}

$("#tabla_medico").on('click','.editar',function(){
  var data = tablemedico.row($(this).parents('tr')).data();//Detecta a que fila hago click y captura los datos en la variable data.
  if(tablemedico.row(this).child.isShown()){//Cuando esta en tamaño responsivo
    var data = tablemedico.row(this).data();
  }

  $("#modal_editar").modal({backdrop:'static',keyboard:false});
  $("#modal_editar").modal('show');

  $("#id_medico").val(data.medico_id);

  $("#txt_nombres_editar").val(data.medico_nombre);
  $("#txt_apepat_editar").val(data.medico_apepat);
  $("#txt_apemat_editar").val(data.medico_apemat);
  $("#txt_direccion_editar").val(data.medico_direccion);
  $("#txt_movil_editar").val(data.medico_movil);
  $("#txt_ndoc_editar_actual").val(data.medico_nrodocumento);
  $("#txt_ndoc_editar_nuevo").val(data.medico_nrodocumento);
  $("#txt_sexo_editar").val(data.medico_sexo).trigger("change");
  $("#txt_fenac_editar").val(data.medico_fenac);
  $("#txt_ncol_editar_actual").val(data.medico_colegiatura);
  $("#txt_ncol_editar_nuevo").val(data.medico_colegiatura);
  $("#cbm_especialidad_editar").val(data.especialidad_id).trigger("change");
  $("#id_usuario").val(data.usu_id);
  $("#txt_usu_editar").val(data.usu_nombre);
  $("#cbm_rol_editar").val(data.rol_id).trigger("change");
  $("#txt_email_editar").val(data.usu_email);
})

function LimpiarCampos(){
  $("#txt_nombres").val("");
  $("#txt_apepat").val("");
  $("#txt_apemat").val("");
  $("#txt_direccion").val("");
  $("#txt_movil").val("");
  $("#txt_ndoc").val("");
  $("#txt_sexo").val("");
  $("#txt_fenac").val("");
  $("#txt_ncol").val("");
  $("#cbm_especialidad").val("");
  $("#txt_usu").val("");
  $("#txt_contra").val("");
  $("#cbm_rol").val("");
  $("#txt_email").val("");
}

function listar_combo_rol(){
  $.ajax({
    "url":"../controlador/usuario/controlador_combo_rol_listar.php",
    type:'POST'
  }).done(function(resp){
    var data = JSON.parse(resp);
    var cadena = "";
    if(data.length>0){
      for(var i=0;i<data.length; i++){
        if(data[i][0]=='3'){
          cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
        }
      }
      $("#cbm_rol").html(cadena);
      $("#cbm_rol_editar").html(cadena);
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_rol").html(cadena);/*  */
      $("#cbm_rol_editar").html(cadena);/*  */
    }
  })
}

function listar_combo_especialidad(){
  $.ajax({
    "url":"../controlador/medico/controlador_combo_especialidad_listar.php",
    type:'POST'
  }).done(function(resp){
    var data = JSON.parse(resp);
    var cadena = "";
    if(data.length>0){
      for(var i=0;i<data.length; i++){
        cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
      }
      $("#cbm_especialidad").html(cadena);
      $("#cbm_especialidad_editar").html(cadena);
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_especialidad").html(cadena);
      $("#cbm_especialidad_editar").html(cadena);
    }
  })
}

function Registrar_Medico(){
  var nombres = $("#txt_nombres").val();
  var apepat = $("#txt_apepat").val();
  var apemat = $("#txt_apemat").val();
  var direccion = $("#txt_direccion").val();
  var movil = $("#txt_movil").val();
  var ndoc = $("#txt_ndoc").val();
  var sexo = $("#txt_sexo").val();
  var fenac = $("#txt_fenac").val();
  var ncol = $("#txt_ncol").val();
  var especialidad = $("#cbm_especialidad").val();
  var usu = $("#txt_usu").val();
  var contra = $("#txt_contra").val();
  var rol = $("#cbm_rol").val();
  var email = $("#txt_email").val();

  var validaremail = $("#validar_email").val();
  if(validaremail=='incorrecto'){
    Swal.fire("Mensaje De Advertencia", "El email ingresado no tiene el formato correcto", "warning");
  }

  if(nombres.length==0 || apepat.length==0 || apemat.length==0 || direccion.length==0 || movil.length==0 || ndoc.length==0 || sexo.length==0 || fenac.length==0 || ncol.length==0 || especialidad.length==0 || usu.length==0 || contra.length==0 || rol.length==0 || email.length==0){
    Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/medico/controlador_medico_registro.php',
    type:'POST',
    data:{
      nombres:nombres,
      apepat:apepat,
      apemat:apemat,
      direccion:direccion,
      movil:movil,
      ndoc:ndoc,
      sexo:sexo,
      fenac:fenac,
      ncol:ncol,
      especialidad:especialidad,
      usu:usu,
      contra:contra,
      rol:rol,
      email:email
    }
  }).done(function(resp){
    if(resp>0){
      if(resp==1){
        listar_especialidad();
        LimpiarCampos();
        $("#modal_registro").modal('hide');
        Swal.fire("Mensaje De Confirmacion","Datos guardados corrrectamente, especialidad registrada","success");
      }else{
        LimpiarCampos();
        Swal.fire("Mensaje De Advertencia","El nro de documento o el nro de colegiatura ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}

function Editar_Medico(){
  var idmed = $("#id_medico").val();

  var nombres = $("#txt_nombres_editar").val();
  var apepat = $("#txt_apepat_editar").val();
  var apemat = $("#txt_apemat_editar").val();
  var direccion = $("#txt_direccion_editar").val();
  var movil = $("#txt_movil_editar").val();

  var ndocactual = $("#txt_ndoc_editar_actual").val();
  var ndocnuevo = $("#txt_ndoc_editar_nuevo").val();

  var sexo = $("#txt_sexo_editar").val();
  var fenac = $("#txt_fenac_editar").val();

  var ncolactual = $("#txt_ncol_editar_actual").val();
  var ncolnuevo = $("#txt_ncol_editar_nuevo").val();

  var especialidad = $("#cbm_especialidad_editar").val();

  var idusu = $("#id_usuario").val();
  var email = $("#txt_email_editar").val();

  var validaremail = $("#validar_email_editar").val();
  if(validaremail=='incorrecto'){
    Swal.fire("Mensaje De Advertencia", "El email ingresado no tiene el formato correcto", "warning");
  }
  
  if(nombres.length==0 || apepat.length==0 || apemat.length==0 || direccion.length==0 || movil.length==0 || ndocnuevo.length==0 || sexo.length==0 || fenac.length==0 || ncolnuevo.length==0 || especialidad.length==0 || email.length==0){
    Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/medico/controlador_medico_editar.php',
    type:'POST',
    data:{
      idmed:idmed,
      nombres:nombres,
      apepat:apepat,
      apemat:apemat,
      direccion:direccion,
      movil:movil,
      ndocactual:ndocactual,
      ndocnuevo:ndocnuevo,
      sexo:sexo,
      fenac:fenac,
      ncolactual:ncolactual,
      ncolnuevo:ncolnuevo,
      especialidad:especialidad,
      idusu:idusu,
      email:email
    }
  }).done(function(resp){
    if(resp>0){
      if(resp==1){
        listar_medico();
        LimpiarCampos();
        $("#modal_registro").modal('hide');
        Swal.fire("Mensaje De Confirmacion","Datos guardados corrrectamente, especialidad registrada","success");
      }else{
        LimpiarCampos();
        Swal.fire("Mensaje De Advertencia","El nro de documento o el nro de colegiatura ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}