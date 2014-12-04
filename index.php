
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cigarrita</title>
	<link rel="stylesheet" type="text/css" href="skin/css/bootstrap.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="skin/css/style.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="skin/css/datatable.css" media="screen, projection">
	<style type="text/css">
		body{
			width: 100%;
			overflow-x: hidden;
			background-color: #F5F5F5;
			font-family: 'Lato' !important;
		}
		.bs-example{
			font-family: sans-serif;
			position: relative;
			margin: 100px;
		}
		.typeahead, .tt-query, .tt-hint{
			border: 2px solid #CCCCCC;
			border-radius: 8px;
			font-size: 24px;
			height: 50px;
			line-height: 30px;
			outline: medium none;
			padding: 8px 12px;
			width: 100%;
		}
		.txt-input {
			width: 70%;
		}
		.typeahead {
			background-color: #FFFFFF;
		}
		.typeahead:focus {
			border: 2px solid #0097CF;
		}
		.tt-query {
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
		}
		.tt-hint {
			color: #999999;
		}
		.tt-dropdown-menu {
			background-color: #FFFFFF;
			border: 1px solid rgba(0, 0, 0, 0.2);
			border-radius: 8px;
			box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
			margin-top: 12px;
			padding: 8px 0;
			width: 422px;
		}
		.tt-suggestion {
			font-size: 24px;
			line-height: 24px;
			padding: 3px 20px;
		}
		.tt-suggestion.tt-is-under-cursor {
			background-color: #0097CF;
			color: #FFFFFF;
		}
		.tt-suggestion p {
			margin: 0;
		}
		.left-menu{
			background-color: #3D3D3D;
			/*width:100%;*/
			display: block !important;			
		}
		.bg-white{
			background-color: #FFF;

		}
		.logo{
			font-family: 'Great Vibes';
			font-size: 60px;
		}
		.logo small{
			font-family: 'Lato';
			font-size: 20px;
		}
		.logo_footer{
			font-family: 'Great Vibes';
			font-size: 28px;
		}
		.logo_footer small{
			font-family: 'Lato';
			font-size: 12px;
		}
		
		.nav-pills > li > a{
			color: #FFF;
			border-radius: 0px;
		}
		.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus, .nav-pills > li > a:hover {
		    color: #FFF;
		    
		    background-color: #4F4F4F;
		}
	</style>

	<script type="text/javascript" src="skin/js/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="skin/js/underscore.js"></script>
	<script type="text/javascript" src="skin/js/typeahead.js"></script>
	<script type="text/javascript" src="skin/js/webfont.js"></script> 
    <script type="text/javascript">

    $(document).ready(function(){
    	// $('input.typeahead').typeahead('destroy');

    	setTimeout(function(){
    		var aleatorio = Math.floor(Math.random() * 51) + 25;

    		$('input.typeahead').typeahead({
			        name: aleatorio,
			        prefetch: 'generator/tables.php',
			        limit: 10,
			        ttl_ms: 1 
			});
    	},200);

    	

		WebFont.load({
		  google: {
		    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic","Great Vibes:400"]
		  }
		});

		$('#generate_table').submit(function( event ) {

			event.preventDefault();

			$.ajax({
		        type: "POST",
		        url: "generator/creator.php",
		        cache: false,
		        data:{
		        	table:$('#InputTable').val(),
		        	aplication:$('#InputAplication').val()
		        },
		        success: function(data) {
		    		// console.log(data);	

		    		$('#panel-generate #files').html(data);
		    		$('#panel-generate #already').append('<li class="text-success">'+$('#InputTable').val()+'</li>');     		

	    			
		        },
		        error: function(result) { 
		        	
		        }              
		    });

		});

		

        // $('input.typeahead').typeahead({
        //   	name: 'accounts',
        //   	local: ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen']
        // });

    });  

    </script>



</head>
<body>


	<section>

		<div class="row">
			<div class="col-md-2 left-menu" style="height: 600px !important;">
				<br><br><br><br><br><br>
				<ul class="nav nav-pills nav-stacked" style="width: 100%;padding-left: 10px;">
			      <li role="presentation" class="active"><a href="#">Generar DataList</a></li>
			      <li role="presentation"><a href="#">Crear APP template</a></li>
			      <li role="presentation"><a href="#">Crear Forms</a></li>
			    </ul>
			</div>
			<div class="col-md-10">
				<div class="row bg-white">
					<div class="col-md-12"><h1 class="logo">Cigarrita <small>Worker</small></h1></div>
				</div>
				<div class="row bg-gray">
					<div class="col-md-offset-1 col-md-6">
						<br>
						<h1>Elegir Tabla a Generar</h1>
						<br>
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="#">Inicio</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Generador DataList</a>
							</li>
						</ul>
						<form id="generate_table" role="form" action="generator/creator.php" method="POST" >
						  <div class="form-group">
						    <label for="InputAplication">Aplicacion Name</label>
						    <input type="text" class="form-control tt-query txt-input" name="aplication" id="InputAplication" placeholder="Aplication Root Name">
						  </div>
						  <div class="form-group">
						    <label for="InputTable">Ingresar Tabla</label><br>
						    <input id="InputTable" placeholder="Tabla" type="text" name="table" class="typeahead tt-query" autocomplete="off" spellcheck="false">
						  </div>
						  
						  <button type="submit" class="btn btn-default btn-lg">Generar</button>
						</form>
					</div>
					<div class="col-md-4">
						<br><br>
						<div class="panel panel-default">
							<div id="panel-generate" class="panel-body">
								<ul id="already" class="unstyled"></ul>
								<div id="files">
									<p>Para Comenzar solo tienes que configurar el archivo "config.php" con los parametros requeridos de tu DataBase y a sacarle todo el jugo!!</p>
									<p>Se Generará los Archivos Necesarios para poder listar utilizando boostrap o Semantic UI, datatbleJS integrado con BackboneJS,HandleBar y usando la API de tu Agrado</p>
									<br>
									<p>para ver que todo se instalo correcto Ingresa a el nombre de tu APP requerido en el <strong>localhot/yourApp/done.php</strong>  para verificar</p>
								</div>							

							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		
	</section>
	<footer>
		<div class="row bg-white">
			<div class="col-md-2 left-menu">
				<div class="row">
					<div class="col-md-12"><h1 class="logo_footer">&nbsp;</h1></div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row bg-white">
					<div class="col-md-12"><h1 class="logo_footer text-center"> <small>Cigarrita Worker,    Todos los Derechos Reservados</small></h1></div>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>