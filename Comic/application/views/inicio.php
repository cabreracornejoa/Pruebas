<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Comic</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="<?= base_url('assets/jquery-3.3.1.min.js');?>" ></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Lista de Comic</h1>
			</div>
		</div>
		<div class="row">
			

			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Comic Agregados</div>
					<div class="panel-body">
						<table id="tablaComic" class="table table-hover table-striped">
							<thead>
								<th>Id</th>
								<th>Comic</th>
								<th>Año</th>
								<th>Editorial</th>
								<th>Vigencia</th>
								<th></th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="col-md-12 text-right">
								<a href="<?= base_url("ComicController/exportar")?>" class="btn btn-success">Exportar a Excel</a>	 
							</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<script type="text/JavaScript">

		$( document ).ready(function() {
		    cargar();
		});

		function cargar() {
			$.ajax({
		  		url: '<?= base_url() ?>ComicController/traerData',
		  		success: function (res) {
		  			obj = JSON.parse(res);
			  		$("#tablaComic tbody tr").remove();
			  		$.each(obj, function(idx, opt) {
			  			$('#tablaComic').append('<tr><td>' + opt.ID + '</td><td>' + opt.COMIC + '</td><td>' + opt.YEAR + '</td><td>' + opt.EDITORIAL + '</td><td>' + opt.VIGENCIA + '</td><td><button class="btn btn-danger" onclick="borrar('+ opt.ID +')" >Borrar</button></td></tr>');
			  		});
		  		}
			});
		}

		function borrar(id) {
			if(confirm("¿Desea Eliminar Este Comic?")) {
				$.ajax({
					type: 'POST',
			  		url: '<?= base_url() ?>ComicController/borrar',
			  		data: { 'id': id },
			  		dataType: 'json',
			  		success: function (res) {
			  			console.log(res);
				  		alert('Registro Eliminado!');
				  		cargar();
			  		}
				});
			}	
		}
		
	</script>

</body>
</html>