var tableconsulta;
function listar_consulta(){
  var finicio = $("#txt_fechainicio").val();
  var ffin = $("#txt_fechafin").val();
  tableconsulta = $("#tabla_consulta_medica").DataTable({
     "ordering":false,
     "paging": false,
     "searching": { "regex": true },
     "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
     "pageLength": 100,
     "destroy":true,
     "async": false ,
     "processing": true,
     "ajax":{
         "url":"../controlador/consulta/controlador_consulta_listar.php",
         type:'POST',
         data:{
           fechainicio:finicio,
           fechafin:ffin
         }
     },
     "order":[[1,'asc']],
     "columns":[
        {"defaultContent":""},
        {"data":"paciente_nrodocumento"},
        {"data":"paciente"},
        {"data":"consulta_feregistro"},
        {"data":"medico"},
        {"data":"especialidad_nombre"},
        {"data":"consulta_estatus",
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
         {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
     ],

     "language":idioma_espanol,
     select: true
 });

    tableconsulta.on( 'draw.dt', function () {
      var PageInfo = $('#tabla_consulta_medica').DataTable().page.info();
      tableconsulta.column(0, { page: 'current' }).nodes().each( function (cell, i) {
              cell.innerHTML = i + 1 + PageInfo.start;
          } );
    } );

}

$("#tabla_consulta_medica").on('click','.editar',function(){
  var data = tableconsulta.row($(this).parents('tr')).data();//Detecta a que fila hago click y captura los datos en la variable data.
  if(tableconsulta.row(this).child.isShown()){//Cuando esta en tamaño responsivo
    var data = tableconsulta.row(this).data();
  }
  $("#modal_editar").modal({backdrop:'static',keyboard:false});
  $("#modal_editar").modal('show');

  $("#txt_idconsulta").val(data.consulta_id);
  $("#cbm_paciente_consulta_editar").val(data.paciente);
  $("#txt_descripcion_consulta_editar").val(data.consulta_descripcion);
  $("#txt_diagnostico_consulta_editar").val(data.consulta_diagnostico);
})

function AbrirModalRegistro(){
  $("#modal_registro").modal({backdrop:'static',keyboard:false});
  $("#modal_registro").modal('show');
}

function listar_combo_paciente_consulta(){
  $.ajax({
    "url":"../controlador/consulta/controlador_combo_paciente_cita_listar.php",
    type:'POST'
  }).done(function(resp){
    var data = JSON.parse(resp);
    var cadena = "";
    if(data.length>0){
      for(var i=0;i<data.length; i++){
        cadena+="<option value='"+data[i][0]+"'>Nro atencion "+data[i][1]+" - Paciente: "+data[i][2]+"</option>";
      }
      $("#cbm_paciente_consulta").html(cadena);
    }else{
      cadena = "<option value=''>NO HAY REGISTROS</option>";
      $("#cbm_paciente_consulta").html(cadena);
    }
  })
}

function Registrar_Consulta(){
  var idcita = $("#cbm_paciente_consulta").val();
  var desconsulta = $("#txt_descripcion_consulta").val();
  var desdiagnostico = $("#txt_diagnostico_consulta").val();
  
  if(idcita.length==0 || desconsulta.length==0 || desdiagnostico.length==0 ){
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/consulta/controlador_consulta_registro.php',
    type:'POST',
    data:{
      idpac:idcita,
      desconsulta:desconsulta,
      desdiagnostico:desdiagnostico
    }
  }).done(function(resp){
    if(resp>0){
      $("#modal_registro").modal('hide');
      listar_consulta();
      Swal.fire("Mensaje de Confirmacion","La consulta se agrego exitosamente","success");
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo agregar", "error");
    }
  })
}

function Modificar_Consulta(){
  var idconsulta = $("#txt_idconsulta").val();
  var desconsulta = $("#txt_descripcion_consulta_editar").val();
  var desdiagnostico = $("#txt_diagnostico_consulta_editar").val();
  
  if(idconsulta.length==0 || desconsulta.length==0 || desdiagnostico.length==0 ){
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }

  $.ajax({
    url: '../controlador/consulta/controlador_consulta_modificar.php',
    type:'POST',
    data:{
      idcon:idconsulta,
      desconsulta:desconsulta,
      desdiagnostico:desdiagnostico
    }
  }).done(function(resp){
    if(resp>0){
      $("#modal_editar").modal('hide');
      listar_consulta();
      Swal.fire("Mensaje de Confirmacion","La consulta se modifico exitosamente","success");
    }else{
      Swal.fire("Mensaje De Error", "El registro no se pudo modificar", "error");
    }
  })
}

