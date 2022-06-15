$('[data-toggle="tooltip"]').tooltip();
var actions = $(".tableIngles td:last-child").html();
$(".add-newIngles").click(function(event) {
	event.preventDefault();
	$(this).attr("disabled", "disabled");
	$(".btnCancel").removeAttr("hidden");
	var index = $(".tableIngles tbody tr:last-child").index();
	var row = '<tr>' + 
	'<td><select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="txtnivelActual" id="txtnivelActual" required><option hidden>Seleccione...</option><option value="Sin Conocimiento">Sin Conocimiento</option><option value="Básico 1">Básico 1</option><option value="Básico 2">Básico 2</option><option value="Intermedio 1">Intermedio 1</option><option value="Intermedio 2">Intermedio 2</option><option value="Avanzado 1">Avanzado 1</option><option value="Avanzado 2">Avanzado 2</option></select></td>' + 
	'<td><select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="txtnivelRequerido" id="txtnivelRequerido" required><option hidden>Seleccione...</option><option value="Básico 1">Básico 1</option><option value="Básico 2">Básico 2</option><option value="Intermedio 1">Intermedio 1</option><option value="Intermedio 2">Intermedio 2</option><option value="Avanzado 1">Avanzado 1</option><option value="Avanzado 2">Avanzado 2</option></select></td>' +
	'<td><select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="txtestatus" id="txtestatus" required><option hidden>Seleccione...</option><option value="No Cursando">No Cursando</option><option value="Completado">Completado</option><option value="Básico 1">Cursando Básico 1</option><option value="Básico 2">Cursando Básico 2</option> <option value="Intermedio 1">Cursando Intermedio 1</option><option value="Intermedio 2">Cursando Intermedio 2</option><option value="Avanzado 1">Cursando Avanzado 1</option><option value="Avanzado 2">Cursando Avanzado 2</option></select></td> ' +
	'<td><textarea class="form-control" name="txtobservaciones" required id="txtobservaciones" style="font-size:13px; margin:0; padding:0;height:100px;"></textarea><input type="text" name="txtreloj" id="txtreloj" hidden value="'+ no_reloj +'"></td>' + 
	'<td>' + actions + '</td>' + '</tr>';
	$(".tableIngles").append(row);
	$(".tableIngles tbody tr").eq(index + 1).find(".add, .edit").toggle();
	$('[data-toggle="tooltip"]').tooltip();
});

$(document).on("click", ".add", function(event) {
	event.preventDefault();
	var empty = false;
	var input = $(this).parents("tr").find('input[type="number"], textarea, select');
	input.each(function() {
		if(!$(this).val()) {
			$(this).addClass("error");
			empty = true;
		} else {
			$(this).removeClass("error");
		}
	});
	var txtnivelActual = $("#txtnivelActual").val();
	var txtnivelRequerido = $("#txtnivelRequerido").val();
	var txtestatus = $("#txtestatus").val();
	var txtobservaciones = $("#txtobservaciones").val();
	var txtreloj = $("#txtreloj").val();

	$.post("../ajax/ingles/ajax_agregarIngles.php", {
		txtnivelActual: txtnivelActual,
		txtnivelRequerido: txtnivelRequerido,
		txtestatus: txtestatus,
		txtobservaciones: txtobservaciones,
		txtreloj: txtreloj
	}, function(data) {
		$("#displaymessage").html(data);
		$(".btnCancel").attr("hidden", "hidden");
	});
	$(this).parents("tr").find(".error").first().focus();
	if(!empty) {
		input.each(function() {
			$(this).parent("td").html($(this).val());
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-newIngles").removeAttr("disabled");
	}
});

$(document).on("click", ".btnCancel", function() {
	$(this).attr("hidden", true);
	$(".add-newIngles").removeAttr("disabled");
	$(".tableIngles tbody tr:first-child").remove();

});

$(document).on("click", ".delete", function(event) {
	event.preventDefault();
	$(this).parents("tr").remove();
	$(".add-newIngles").removeAttr("disabled");
	var id = $(this).attr("id");
	var string = id;
	$.post("../ajax/ingles/ajax_eliminarIngles.php", {
		string: string
	}, function(data) {
		$("#displaymessage").html(data);
	});
});

$(document).on("click", ".update", function(event) {
	event.preventDefault();
	var id = $(this).attr("id");
	var string = id;
	var txtnivelActual = $("#txtnivelActual").val();
	var txtnivelRequerido = $("#txtnivelRequerido").val();
	var txtestatus = $("#txtestatus").val();
	var txtobservaciones = $("#txtobservaciones").val();
	$.post("../ajax/ingles/ajax_actualizarIngles.php", {
		string: string,
		txtnivelActual: txtnivelActual,
		txtnivelRequerido: txtnivelRequerido,
		txtestatus: txtestatus,
		txtobservaciones: txtobservaciones
	}, function(data) {
		$("#displaymessage").html(data);  
		$(".add-newIngles").removeAttr("disabled");
		$('.update').hide(); 
		$('.edit').show();
		$('.update').attr("class", "add");
		$('.add').hide();
		$('select, textarea').each(function(){
        var content = $(this).val();//.replace(/\n/g,"<br>");
        $(this).html(content);
        $(this).contents().unwrap();    
    }); 
	});
});

$(document).on("click", ".edit", function(event) {
	event.preventDefault();
	$(this).parents("tr").find("td:not(:last-child)").each(function(i) {
		if(i == '0') {
			var idname = 'txtnivelActual';
		} else if(i == '1') {
			var idname = 'txtnivelRequerido';
		}  else if(i =='2') {
			var idname = 'txtestatus';
		} else if(i == '3') {
			var idname = 'txtobservaciones';
		}
		if (idname == 'txtnivelActual') {
		$(this).html('<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="txtnivelActual" id="' + idname +'" required><option hidden>' + $(this).text() +'</option><option value="Sin Conocimiento">Sin Conocimiento</option><option value="Básico 1">Básico 1</option><option value="Básico 2">Básico 2</option><option value="Intermedio 1">Intermedio 1</option><option value="Intermedio 2">Intermedio 2</option><option value="Avanzado 1">Avanzado 1</option><option value="Avanzado 2">Avanzado 2</option></select>');
		}
		if (idname == 'txtnivelRequerido') {
		$(this).html('<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="txtnivelRequerido" id="'+ idname +'" required><option hidden>'+ $(this).text() +'</option><option value="Básico 1">Básico 1</option><option value="Básico 2">Básico 2</option><option value="Intermedio 1">Intermedio 1</option><option value="Intermedio 2">Intermedio 2</option><option value="Avanzado 1">Avanzado 1</option><option value="Avanzado 2">Avanzado 2</option></select>');
		}
		if (idname == 'txtestatus') {
		$(this).html('<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="txtestatus" id="'+ idname +'" required><option hidden>'+ $(this).text() +'</option><option value="No Cursando">No Cursando</option><option value="Completado">Completado</option><option value="Básico 1">Cursando Básico 1</option><option value="Básico 2">Cursando Básico 2</option> <option value="Intermedio 1">Cursando Intermedio 1</option><option value="Intermedio 2">Cursando Intermedio 2</option><option value="Avanzado 1">Cursando Avanzado 1</option><option value="Avanzado 2">Cursando Avanzado 2</option></select>');
		}
		if (idname == 'txtobservaciones') {
		$(this).html('<textarea class="form-control" name="txtobservaciones" required id="'+ idname +'" style="font-size:13px; margin:0; padding:0;height:100px;">'+ $(this).text() +'</textarea>');
		}

	});
	$(this).parents("tr").find(".add, .edit").toggle();
	$('.update').show();
	$(".add-newIngles").attr("disabled", "disabled");
	$(this).parents("tr").find(".add").removeClass("add").addClass("update");
});
