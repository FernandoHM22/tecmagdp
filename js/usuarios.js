$('[data-toggle="tooltip"]').tooltip();


$(document).ready(function(){
	$(document).on("click", ".delete", function(event) {
		event.preventDefault();
		$(this).parents("tr").remove();
		var id = $(this).attr("id");
		var string = id;
		swal({
			title: "¿Está seguro que desea eliminar usuario?",
			text: "Al confirmar, validas que la información es correcta, no se podrá recuperar.",
			icon: "warning",
			cancelButtonColor: "#DD6B55",
			buttons: [
			'No',
			'Confirmar'
			],
			successMode: true,
		}).then(function(isConfirm) {
			if (isConfirm) {
				$.ajax({
					url: "../../ajax/perfil/ajax_eliminarUsuario.php",
					method: 'POST',
					data: {string: string},
					success: function(data) {
						data = data.trim();
						if (data == 1) {
							
							swal("Eliminado con éxito!", {
								icon: "success",
							});
						}else{
							swal("Error al registrar!", {
								icon: "error",
							});
						}
					}
				});
			}
		});
	});
});