var tableinsumo;
function listar_insumo(){
  tableinsumo = $("#tabla_insumo").DataTable({
     "ordering":false,
     "paging": false,
     "searching": { "regex": true },
     "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
     "pageLength": 100,
     "destroy":true,
     "async": false ,
     "processing": true,
     "ajax":{
         "url":"../controlador/insumo/controlador_insumo_listar.php",
         type:'POST'
     },
     "order":[[1,'asc']],
     "columns":[
        {"defaultContent":""},
        {"data":"insumo_nombre"},
        {"data":"insumo_stock"},
        {"data":"insumo_feregistro"},
        {"data":"insumo_estatus",
        render: function (data, type, row ) {
            if(data=='ACTIVO'){
                return "<span class='label label-success'>"+data+"</span>";                   
            }
            if(data=='INACTIVO'){
              return "<span class='label label-danger'>"+data+"</span>";                   
            }
            if(data=='AGOTADO'){
              return "<span class='label label-black' style='background:black'>"+data+"</span>";                   
            } 
          }
        },
         {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
     ],

     "language":idioma_espanol,
     select: true
 });

    document.getElementById("tabla_insumo_filter").style.display = "none";

    $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('tr').attr('data-column') );
    });

    tableinsumo.on( 'draw.dt', function () {
      var PageInfo = $('#tabla_insumo').DataTable().page.info();
      tableinsumo.column(0, { page: 'current' }).nodes().each( function (cell, i) {
              cell.innerHTML = i + 1 + PageInfo.start;
          } );
    } );

}

$("#tabla_insumo").on('click','.editar',function(){
  var data = tableinsumo.row($(this).parents('tr')).data();//Detecta a que fila hago click y captura los datos en la variable data.
  if(tableinsumo.row(this).child.isShown()){//Cuando esta en tamaño responsivo
    var data = tableinsumo.row(this).data();
  }
  $("#modal_editar").modal({backdrop:'static',keyboard:false});
  $("#modal_editar").modal('show');

  $("#txt_idinsumo").val(data.insumo_id);
  $("#txt_insumo_actual_editar").val(data.insumo_nombre);
  $("#txt_insumo_nuevo_editar").val(data.insumo_nombre);
  $("#txt_stock_editar").val(data.insumo_stock);
  $("#cbm_estatus_editar").val(data.insumo_estatus).trigger("change");
})

function AbrirModalRegistro(){
  $("#modal_registro").modal({backdrop:'static',keyboard:false});
  $("#modal_registro").modal('show');
}

function filterGlobal() {
  $('#tabla_insumo').DataTable().search(
      $('#global_filter').val(),
  ).draw();
}

function Registrar_Insumo(){
  var insumo = $("#txt_insumo").val();
  var stock = $("#txt_stock").val();
  var estatus = $("#cbm_estatus").val();
  if(stock<0){
    Swal.fire("Mensaje De Advertencia", "El stock no puede ser negativo", "warning");
  }

  if(insumo.length==0 || stock.length==0 || estatus.length==0){
    Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/insumo/controlador_insumo_registro.php',
    type:'POST',
    data:{
      in:insumo,
      st:stock,
      es:estatus
    }
  }).done(function(resp){
    if(resp>0){
      if(resp==1){
        listar_insumo();
        LimpiarCampos();
        $("#modal_registro").modal('hide');
        Swal.fire("Mensaje De Confirmacion","Datos guardados corrrectamente","success");
      }else{
        LimpiarCampos();
        Swal.fire("Mensaje De Advertencia","El insumo ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}

function LimpiarCampos(){
  $("#txt_insumo").val("");
  $("#txt_stock").val("");
}

function Modificar_Insumo(){
  var id = $("#txt_idinsumo").val();

  var insumoactual = $("#txt_insumo_actual_editar").val();
  var insumonuevo = $("#txt_insumo_nuevo_editar").val();

  var stock = $("#txt_stock_editar").val();
  var estatus = $("#cbm_estatus_editar").val();

  if(stock<0){
    Swal.fire("Mensaje De Advertencia", "El stock no puede ser negativo", "warning");
  }

  if(insumonuevo.length==0 || stock.length==0 || estatus.length==0){
    Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/insumo/controlador_insumo_modificar.php',
    type:'POST',
    data:{
      id:id,
      inac:insumoactual,
      innu:insumonuevo,
      st:stock,
      es:estatus
    }
  }).done(function(resp){
    if(resp>0){
      if(resp==1){
        listar_insumo();
        $("#modal_editar").modal('hide');
        Swal.fire("Mensaje De Confirmacion","Datos actualizados corrrectamente","success");
      }else{
        Swal.fire("Mensaje De Advertencia","El insumo ya existe en nuestra data","warning");
      }
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo completar", "error");
    }
  })
}