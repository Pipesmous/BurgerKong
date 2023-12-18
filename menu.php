<?php 
	include 'libs/tools.php'; 
	session_start();
	$categoria = 25;
	if (empty($_GET['sucursal'])) { //|| empty($_GET['categoria'])
		header('Location: sucursales.php');
	}
	if (isset($_GET['categoria'])) {
		$categoria = $_GET['categoria'];
	}
	$idSucursal = $_GET['sucursal'];
	$productos = query("SELECT * FROM `burgerKong__productos` WHERE `idCategoria` = $categoria",true);
	$categorias = query("SELECT * FROM `burgerKong__categorias`",true);
	if(!isset($_SESSION['carrito'])){
		$_SESSION['carrito'] = array();	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style/styleHeader.css">
	<link rel="stylesheet" href="./style/styleFooter.css">
	<link rel="stylesheet" href="./style/styleMenu.css">
	<title>Burger Kong | Categorias</title>
	<style>
		@import url(//db.onlinewebfonts.com/c/c5f70443eb657fcfadfd17a973fad2e0?family=BourbonW00-Regular);
		@font-face {
			font-family: "BourbonW00-Regular"; 
			src: url("//db.onlinewebfonts.com/t/c5f70443eb657fcfadfd17a973fad2e0.eot"); 
			src: url("//db.onlinewebfonts.com/t/c5f70443eb657fcfadfd17a973fad2e0.eot?#iefix") format("embedded-opentype"), 
				url("//db.onlinewebfonts.com/t/c5f70443eb657fcfadfd17a973fad2e0.woff2") format("woff2"), 
				url("//db.onlinewebfonts.com/t/c5f70443eb657fcfadfd17a973fad2e0.woff") format("woff"), 
				url("//db.onlinewebfonts.com/t/c5f70443eb657fcfadfd17a973fad2e0.ttf") format("truetype"), 
				url("//db.onlinewebfonts.com/t/c5f70443eb657fcfadfd17a973fad2e0.svg#BourbonW00-Regular") format("svg"); 
		} 
		*{
			margin: 0;
			padding: 0;
			font-family: "BourbonW00-Regular";
		}
	</style>
</head>
<body>
	<div id="wrapperMenu">
	<?php 
		echo getHeader();
		echo getCategorias($_GET['sucursal']);
			echo "<div class='contentProductos'>";
			for ($i=0; $i < count($productos); $i++) { 
				echo "
					<div class='producto'>
					<a href='detalle.php?sucursal=".$_GET['sucursal']."&producto=".$productos[$i]["id"]."'>
						<div class='titleProducto'>".$productos[$i]["titulo"]."</div>
						<img src=".$productos[$i]["imagenMenu"].">
						<div class='precioProducto'>
							".$productos[$i]["precio"]."
						</div>
					</a>
					</div>
					"
					;
			}
			echo '</div>';
		echo getFooter();
	 ?>
	 </div>

</body>
</html>