<?php 
	session_start();
	include 'libs/tools.php';
	if (empty($_SESSION['idAdmin'])) {
		header('Location: sucursales.php');
	}
	$sucursal = getSucursal($_SESSION['idAdmin']);
	$productos = query("SELECT * FROM `burgerKong__productos` WHERE `id` = '".$_GET['borrar']."' ",true);
	$categorias = query("SELECT * FROM `burgerKong__categorias` WHERE 1",true);
	if (isset($_POST['btnYes'])) {
		query("DELETE FROM `burgerKong__productos` WHERE `id` = '".$_GET['borrar']."' ",true);
		header('Location: listar_producto.php');
	}
	if (isset($_POST['btnNot'])) {
		header('Location: listar_producto.php');
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Burger Kong | Panel</title>
 	<link rel="stylesheet" href="style/styleBorrarProducto.css">
 </head>
 <body>
 		<?php echo getHeader();?>
 		<div id="wrapper">
 			<div class="midWrapper">
 				<div id="titleWelcome"><?php echo "Quieres Eliminar el Producto [".$productos[0]['titulo']."]?"; ?></div>
 				<div id="contentForm">
 					<form method="POST">
 						<input type="submit" class="btn" name="btnYes" value="Si">
 						<input type="submit" class="btn" name="btnNot" value="No">
 					</form>
 				</div>
 			</div>
			<div class="mid2Wrapper">
				<div id="contentLink"><a id="btnMenu" href="listar_producto.php">Volver</a>
				</div>
			</div>
		</div>
		<?php echo getFooter();?>
 </body>
 </html>