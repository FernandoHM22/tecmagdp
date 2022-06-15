		function eliminarNotaPorID(nota){
		swal({
			title: "Estas segur@ de eliminar esta nota?",
			text: "Una vez eliminado, no podrá recuperarse!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type:"POST",
					data:"nota=" + nota,
					url:"../procesos/notas/eliminarNotas.php",
					success: function(respuesta){
						respuesta = respuesta.trim();

						if (respuesta == 1) {
							location.reload();
							swal("Eliminado con éxito!", {
							icon: "success",
						});
						} else{
							swal("Error al eliminar!", {
							icon: "error",
							
						});
					}
				}
				});
			}
		});
	}		

	function eliminarNotaReddin(nota){

				$.ajax({
					type:"POST",
					data:"nota=" + nota,
					url:"../procesos/notas/eliminarNotas.php",
					success: function(respuesta){
						respuesta = respuesta.trim();

						if (respuesta == 1) {
							location.reload();
							swal("Eliminado con éxito!", {
							icon: "success",
						});
						} else{
							swal("Error al eliminar!", {
							icon: "error",
							
						});
					}
				}
				});
			}
