var tablecita;
function listar_cita(){
  tablecita = $("#tabla_cita").DataTable({
     "ordering":false,
     "paging": false,
     "searching": { "regex": true },
     "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
     "pageLength": 100,
     "destroy":true,
     "async": false ,
     "processing": true,
     "ajax":{
         "url":"../controlador/cita/controlador_cita_listar.php",
         type:'POST'
     },
     "order":[[1,'asc']],
     "columns":[
        {"defaultContent":""},
        {"data":"cita_nroatencion"},
        {"data":"cita_feregistro"},
        {"data":"paciente"},
        {"data":"medico"},
        {"data":"cita_estatus",
        render: function (data, type, row ) {
            if(data=='PENDIENTE'){
                return "<span class='label label-warning'>"+data+"</span>";                   
            }
            if(data=='CANCELADA'){
              return "<span class='label label-danger'>"+data+"</span>";                   
            }
            if(data=='ATENDIDA'){
              return "<span class='label label-success'>"+data+"</span>";                  
            } 
          }
        },
         {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='imprimir btn btn-danger'><i class='fa fa-print'></i></button>"}
     ],

     "language":idioma_espanol,
     select: true
 });

    document.getElementById("tabla_cita_filter").style.display = "none";

    $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('tr').attr('data-column') );
    });

    tablecita.on( 'draw.dt', function () {
      var PageInfo = $('#tabla_cita').DataTable().page.info();
      tablecita.column(0, { page: 'current' }).nodes().each( function (cell, i) {
              cell.innerHTML = i + 1 + PageInfo.start;
          } );
    } );

}

$("#tabla_cita").on('click','.editar',function(){
  var data = tablecita.row($(this).parents('tr')).data();//Detecta a que fila hago click y captura los datos en la variable data.
  if(tablecita.row(this).child.isShown()){//Cuando esta en tamaño responsivo
    var data = tablecita.row(this).data();
  }
  $("#modal_editar").modal({backdrop:'static',keyboard:false});
  $("#modal_editar").modal('show');

  $("#txt_idcita").val(data.cita_id);

  $("#cbm_paciente_editar").val(data.paciente_id).trigger("change");
  $("#cbm_especialidad_editar").val(data.especialidad_id).trigger("change");
  listar_combo_medico_editar(data.especialidad_id,data.medico_id);

  $("#txt_descripcion_editar").val(data.cita_descripcion);

  $("#cbm_estatus_editar").val(data.cita_estatus).trigger("change");
})

$("#tabla_cita").on('click','.imprimir',function(){
  var data = tablecita.row($(this).parents('tr')).data();//Detecta a que fila hago click y captura los datos en la variable data.
  if(tablecita.row(this).child.isShown()){//Cuando esta en tamaño responsivo
    var data = tablecita.row(this).data();
  }
  window.open("../vista/libreporte/reportes/generar_ticket.php?id="+parseInt(data.cita_id)+"#zoom=100%","Ticket","scrollbars=NO");
})


function AbrirModalRegistro(){
  $("#modal_registro").modal({backdrop:'static',keyboard:false});
  $("#modal_registro").modal('show');
}

function filterGlobal() {
  $('#tabla_cita').DataTable().search(
      $('#global_filter').val(),
  ).draw();
}

 
function listar_combo_paciente(){
  $.ajax({
    "url":"../controlador/cita/controlador_combo_paciente_listar.php",
    type:'POST'
  }).done(function(resp){
    var data = JSON.parse(resp);
    var cadena = "";
    if(data.length>0){
      for(var i=0;i<data.length; i++){
        cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
      }
      $("#cbm_paciente").html(cadena);
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_paciente").html(cadena);
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
       var id = $("#cbm_especialidad").val();
       listar_combo_medico(id);//Selecciona el medico estatico
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_especialidad").html(cadena);
    }
  })
}

function listar_combo_medico(id){
  $.ajax({
    "url":"../controlador/cita/controlador_combo_medico_listar.php",
    type:'POST',
    data:{
      id:id
    }
  }).done(function(resp){
    var data = JSON.parse(resp);
    var cadena = "";
    if(data.length>0){
      for(var i=0;i<data.length; i++){
        cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
      }
      $("#cbm_medico").html(cadena);
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_medico").html(cadena);
    }
  })
}

function Registrar_Cita(){
  var idpaciente = $("#cbm_paciente").val();
  var idmedico = $("#cbm_medico").val();
  var idespecialidad = $("#cbm_especialidad").val();
  var descripcion = $("#txt_descripcion").val();
  var idusuario = $("#txtidprincipal").val();
  
  if(idpaciente.length==0 || idmedico.length==0 || idespecialidad.length==0 || descripcion.length==0 || idusuario.length==0){
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/cita/controlador_cita_registro.php',
    type:'POST',
    data:{
      idpac:idpaciente,
      idmed:idmedico,
      ides:idespecialidad,
      des:descripcion,
      idusu:idusuario
    }
  }).done(function(resp){
    if(resp>0){
        Swal.fire({
          title: 'Datos de confirmacion',
          text: "Datos correctamente, nueva cita registrada",
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Imprimir Ticket'
        }).then((result) => {
          tablecita.ajax.reload();
          if (result.value) {
            window.open("../vista/libreporte/reportes/generar_ticket.php?id="+parseInt(resp)+"#zoom=100%","Ticket","scrollbars=NO");
          }else{
            $("#modal_registro").modal('hide');
            listar_cita();
          }
        })
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}

function LimpiarCampos(){
  $("#txt_descripcion").val("");
}


function listar_combo_paciente_editar(){
  $.ajax({
    "url":"../controlador/cita/controlador_combo_paciente_listar.php",
    type:'POST'
  }).done(function(resp){
    var data = JSON.parse(resp);
    var cadena = "";
    if(data.length>0){
      for(var i=0;i<data.length; i++){
        cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
      }
      $("#cbm_paciente_editar").html(cadena);
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_paciente_editar").html(cadena);
    }
  })
}

function listar_combo_especialidad_editar(){
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
      $("#cbm_especialidad_editar").html(cadena);
       var id = $("#cbm_especialidad_editar").val();
       listar_combo_medico_editar(id);//Selecciona el medico estatico
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_especialidad_editar").html(cadena);
    }
  })
}

function listar_combo_medico_editar(id,idmedico){
  $.ajax({
    "url":"../controlador/cita/controlador_combo_medico_listar.php",
    type:'POST',
    data:{
      id:id
    }
  }).done(function(resp){
    var data = JSON.parse(resp);
    var cadena = "";
    if(data.length>0){
      for(var i=0;i<data.length; i++){
        cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
      }
      $("#cbm_medico_editar").html(cadena);
      /* Pendiente */
      if(idmedico!=''){
        $("#cbm_medico_editar").val(idmedico).trigger("change");
      }
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_medico_editar").html(cadena);
    }
  })
}

function Modificar_Cita(){

  var idcita = $("#txt_idcita").val();

  var paciente = $("#cbm_paciente_editar").val();
  var especialidad = $("#cbm_especialidad_editar").val();
  var medico = $("#cbm_medico_editar").val();
  var descripcion = $("#txt_descripcion_editar").val();
  var estatus = $("#cbm_estatus_editar").val();

  if(idcita.length==0 || paciente.length==0 || especialidad.length==0 || medico.length==0 || descripcion.length==0 || estatus.length==0){
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/cita/controlador_citar_modificar.php',
    type:'POST',
    data:{
      idcita:idcita,
      paciente:paciente,
      especialidad:especialidad,
      medico:medico,
      descripcion:descripcion,
      es:estatus
    }
  }).done(function(resp){
    if(resp>0){
      Swal.fire({
        title: 'Datos de confirmacion',
        text: "Datos Correctamente Actualizados",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Imprimir Ticket'
      }).then((result) => {
        tablecita.ajax.reload();
        if (result.value) {
          window.open("../vista/libreporte/reportes/generar_ticket.php?id="+parseInt(idcita)+"#zoom=100%","Ticket","scrollbars=NO");
        }else{
          $("#modal_registro").modal('hide');
          listar_cita();
        }
      })
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo modificar", "error");
    }
  })
}