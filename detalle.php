<?php 
	include 'libs/tools.php'; 
	session_start();
	$categorias = query("SELECT * FROM `burgerKong__categorias`",true);
	$producto = $_GET['producto'];
	$productos = query("SELECT * FROM `burgerKong__productos` WHERE `id` = $producto",true);
	if(!isset($_SESSION['carrito'])){
		$_SESSION['carrito'] = array();	
	}
	if (isset($_POST['btnCarrito'])) {
		if (($response = isInCart($_SESSION['carrito'],$producto)) != -1) {
			$_SESSION['carrito'][$response]['cant'] += 1;
			var_dump($response);
		}else{
			$arrayProducto = array();
			$arrayProducto['id'] = $producto;
			$arrayProducto['cant'] = 1;
			$_SESSION['carrito'][] = $arrayProducto;
		}
		header('Location: menu.php?sucursal='.$_GET['sucursal']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/styleMenu.css">
	<title>Burger Kong | Producto</title>
	<style>
		body{
			background-color: #5d1a22;
		}
	</style>
</head>
<body>
	<?php 
		echo getHeader();

		echo getCategorias($_GET['sucursal']);
		
		echo getMenu();

		echo getFooter();
	?>
	
	</form>
</body>
</html>