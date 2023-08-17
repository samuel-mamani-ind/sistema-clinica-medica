var tableespecialidad;
function listar_especialidad(){
  tableespecialidad = $("#tabla_especialidad").DataTable({
     "ordering":false,
     "paging": false,
     "searching": { "regex": true },
     "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
     "pageLength": 100,
     "destroy":true,
     "async": false ,
     "processing": true,
     "ajax":{
         "url":"../controlador/especialidad/controlador_especialidad_listar.php",
         type:'POST'
     },
     "order":[[1,'asc']],
     "columns":[
        {"defaultContent":""},
        {"data":"especialidad_nombre"},
        {"data":"especialidad_fregistro"},
        {"data":"especialidad_estatus",
        render: function (data, type, row ) {
            if(data=='ACTIVO'){
              return "<span class='label label-success'>"+data+"</span>";                   
            }else{
              return "<span class='label label-danger'>"+data+"</span>";   
            }
          }
        },
         {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
     ],

     "language":idioma_espanol,
     select: true
 });

    document.getElementById("tabla_especialidad_filter").style.display = "none";

    $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('tr').attr('data-column') );
    });

    tableespecialidad.on( 'draw.dt', function () {
      var PageInfo = $('#tabla_especialidad').DataTable().page.info();
      tableespecialidad.column(0, { page: 'current' }).nodes().each( function (cell, i) {
              cell.innerHTML = i + 1 + PageInfo.start;
          } );
    } );

}

$("#tabla_especialidad").on('click','.editar',function(){
  var data = tableespecialidad.row($(this).parents('tr')).data();//Detecta a que fila hago click y captura los datos en la variable data.
  if(tableespecialidad.row(this).child.isShown()){//Cuando esta en tamaño responsivo
    var data = tableespecialidad.row(this).data();
  }

  $("#modal_editar").modal({backdrop:'static',keyboard:false});
  $("#modal_editar").modal('show');

  $("#txt_idespecialidad").val(data.especialidad_id);

  $("#txt_especialidad_actual_editar").val(data.especialidad_nombre);
  $("#txt_especialidad_nuevo_editar").val(data.especialidad_nombre);

  $("#cbm_estatus_editar").val(data.especialidad_estatus).trigger("change");
})

function filterGlobal() {
  $('#tabla_especialidad').DataTable().search(
      $('#global_filter').val(),
  ).draw();
}

function AbrirModalRegistro(){
  $("#modal_registro").modal({backdrop:'static',keyboard:false});
  $("#modal_registro").modal('show');
}

/* PENDIENTE */
function Registrar_Especialidad(){
  var especialidad = $("#txt_especialidad").val();
  var estatus = $("#cbm_estatus").val();
  
  if(especialidad.length==0 || estatus.length==0){
    Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/especialidad/controlador_especialidad_registro.php',
    type:'POST',
    data:{
      especialidad:especialidad,
      es:estatus
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
        Swal.fire("Mensaje De Advertencia","La especialidad ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}
 
function LimpiarCampos(){
  $("#txt_especialidad").val("");
}

function Modificar_Especialidad(){
  var id = $("#txt_idespecialidad").val();

  var especialidadactual = $("#txt_especialidad_actual_editar").val();
  var especialidadnuevo = $("#txt_especialidad_nuevo_editar").val();

  var estatus = $("#cbm_estatus_editar").val();

  if(especialidadnuevo.length==0 ||  estatus.length==0){
    Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/especialidad/controlador_especialidad_modificar.php',
    type:'POST',
    data:{
      id:id,
      espac:especialidadactual,
      esnu:especialidadnuevo,
      es:estatus
    }
  }).done(function(resp){
    if(resp>0){
      if(resp==1){
        listar_especialidad();
        $("#modal_editar").modal('hide');
        Swal.fire("Mensaje De Confirmacion","Datos actualizados corrrectamente","success");
      }else{
        Swal.fire("Mensaje De Advertencia","La especialidad ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}