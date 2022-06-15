$('#selectAño').on('change', function() {
 var año =  (this.value);
 $('#divloadswitch').load('../loads/admin/activarEvaluacion.php', {'año': año});
});


$('.enableObjetives').selectpicker();


$('#chbxEvaluar').on('change', function(){  
  if (this.checked) {  
   var año = $('#selectAño').val();
   var chbxSwith = '2';
   $.ajax({
    url: '../ajax/administracion/ajax_EvaluacionObjetivos.php',
    method: 'POST',
    data: { año: año,
     chbxSwith: chbxSwith
   },
   success: function(data) {
    $("#successMsj").css('display', 'block');
    $("#successMsj").html(data);
    $('#divObjetivosAñosActivosAdmin').load('../loads/admin/objetivosAñosActivos.php');
    /*setTimeout(function(){
      $("#successMsj").css('display', 'none');
    }, 2000);*/
  }
});
 }else{
   var año = $('#selectAño').val();
   var chbxSwith = '0';
   $.ajax({
    url: '../ajax/administracion/ajax_EvaluacionObjetivos.php',
    method: 'POST',
    data: { año: año,
      chbxSwith: chbxSwith
    },
    success: function(data) {
      $("#successMsj").css('display', 'block');
      $("#successMsj").html(data);
      $('#divObjetivosAñosActivosAdmin').load('../loads/admin/objetivosAñosActivos.php');
      /*setTimeout(function(){
        $("#successMsj").css('display', 'none');
      }, 2000);*/
    }
  });
 }
});

$('#chbxActivarBtn').on('change', function(){
  if (this.checked) {
    var chbxSwith = 1;
    $.ajax({
      url: '../ajax/administracion/ajax_btnAgregarObjetivos.php',
      method: 'POST',
      data: { chbxSwith: chbxSwith
      },
      success: function(data) {
        $("#successmsj").css('display', 'block');
        $("#successmsj").html(data);
      }
    });
  }else{
   var chbxSwith = 0;
   $.ajax({
    url: '../ajax/administracion/ajax_btnAgregarObjetivos.php',
    method: 'POST',
    data: { chbxSwith: chbxSwith
    },
    success: function(data) {
      $("#successmsj").css('display', 'block');
      $("#successmsj").html(data);
    }
  });
 }
});


$(document).ready(function() {
  $("#borrarOportunidades").click(function(e) {
    e.preventDefault();
    swal({
      title: "¿Está seguro que desea eliminar todos las registros?",
      text: "Al confirmar, validas que los registros de fortalezas y debilidades seran eliminados.",
      icon: "warning",
      cancelButtonColor: "#DD6B55",
      buttons: [
      'No',
      'Confirmar'
      ],
      successMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
       $.ajax(
       {
        type: "GET",
        url: '../ajax/administracion/ajax_borrarf_o.php',
        success: function (data) {
         $("#deletesuccess").html(data);
       },
     });
     }
   });
  });
});


$(document).ready(function(){
  $('#btnHabilitarEvaluacion').on('click', function(){  
   var arrayDeptos=[];
   $("input:checkbox[name*=checkboxDeptos]:checked").each(function(){
    arrayDeptos.push($(this).val());
  });
   $.ajax({
    url: '../ajax/administracion/ajax_habilitarEvaluacion.php',
    method: 'POST',
    data: { arrayDeptos: arrayDeptos },
   success: function(data) {
    $("#mensajeHabilitar").css('display', 'block');
    $("#mensajeHabilitar").html(data);
    setTimeout(function(){
      $("#mensajeHabilitar").css('display', 'none');
      location.reload();
    }, 2000);
  }
});
});
});

$(document).ready(function(){
  $('#btnDeshabilitarEvaluacion').on('click', function(){  
   var arrayDeptos=[];
   $("input:checkbox[name*=checkboxDeptos]:checked").each(function(){
    arrayDeptos.push($(this).val());
  });
   $.ajax({
    url: '../ajax/administracion/ajax_deshabilitarEvaluacion.php',
    method: 'POST',
    data: { arrayDeptos: arrayDeptos },
   success: function(data) {
    $("#mensajeDeshabilitar").css('display', 'block');
    $("#mensajeDeshabilitar").html(data);
    setTimeout(function(){
      $("#mensajeDeshabilitar").css('display', 'none');
      location.reload();
    }, 2000);
  }
});
});
});