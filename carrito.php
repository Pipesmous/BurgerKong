<?php 
	include 'libs/tools.php'; 
	session_start();
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
	<link rel="stylesheet" href="./style/styleCarrito.css">
	<title>BurgerKong | Carrito</title>
</head>
<body>
	<?php 
		echo getHeader();
		echo "<div id='carrito'>
			  <div id='contentCart'>
				  <div id='tituloProdCart'>Producto</div>
				  <div id='cantidadProdCart'>Cantidad</div>
				  <div id='precioProdCart'>Precio</div>
			  </div>
		";
		$total = 0;
		$arrayProductos = array();
		$idProd = array();
		for ($i=0; $i < count($_SESSION['carrito']); $i++) {
			$arrayProductos[] = getProducto($_SESSION['carrito'][$i]);
			$idProd[] = $_SESSION['carrito'][$i]['id'];
			$total += ifMostOne($_SESSION['carrito'][$i]);

			if (isset($_GET['add'.$_SESSION['carrito'][$i]['id'].''])) {
				$_SESSION['carrito'][$i]['cant']++;
				header('Location: carrito.php?sucursal='.$_GET['sucursal']);
			}

			if (isset($_GET['remove'.$_SESSION['carrito'][$i]['id'].''])) {
				$_SESSION['carrito'][$i]['cant']--;
				header('Location: carrito.php?sucursal='.$_GET['sucursal']);
			}

			if ($_SESSION['carrito'][$i]['cant'] > 0) {
				echo $arrayProductos[$i];
			}else{
				unset($_SESSION['carrito'][$i]);
			}
		}
		echo getTotalCart($total);
		echo "<div class='contentBtnCompra'>
			  	<div class='btnCompra'>
					<a href='ticket.php?sucursal=".$_GET['sucursal']."'>Finalizar Compra</a>
				</div>	  
			  </div>
		";
		echo '</div>';
		echo getFooter();
	?>
</body>
</html>

