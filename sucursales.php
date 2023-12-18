<?php 
	include 'libs/tools.php'; 
	$sucursales = query('SELECT * FROM `burgerKong__sucursales` WHERE 1',true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style/styleHeader.css">
	<link rel="stylesheet" href="./style/styleFooter.css">
	<link rel="stylesheet" href="./style/styleSucursales.css">
	<title>Burger Kong | Sucursales</title>
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
		body{
			background-color: #5d1a22;
		}
		#wrapper{
			display: flex;
			justify-content: center;
		}
	</style>
</head>
<body>
	<?php 
		echo getHeader();

		echo "<div id='wrapper'>";
			echo "<div class='contentSucursales'>";
			for ($i=0; $i < count($sucursales); $i++) {
				$idSucursal = $i+1; 
				echo "<a href='menu.php?sucursal=".$idSucursal."'>
					<div class='sucursales'>
						<div class='iconSucursal'><img class='logoSucursal' src='./style/img/icon.png'></div>
						".$sucursales[$i]["nombre"]."
						".$sucursales[$i]["ubicacion"]."
					</div></a>
				";
			}
			echo "</div>";
		echo "</div>";

		echo getFooter();
	?>
	
</body>
</html>