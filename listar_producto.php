<?php 
	session_start();
	include 'libs/tools.php';
	if (empty($_SESSION['idAdmin'])) {
		header('Location: sucursales.php');
	}
	$sucursal = getSucursal($_SESSION['idAdmin']);
	$infoSucursal = infoSucursal($sucursal[0]['id']);
	$date = date("Y-m-d H:i:s");
	$tickets = query("SELECT * FROM `burgerKong__tickets` WHERE `FK_ID_SUCURSAL` = '".$sucursal[0]['id']."' ORDER BY `fechaTicket` DESC ",true);
	$productos = query("SELECT * FROM `burgerKong__productos` WHERE `FK_ID_SUCURSAL` = '".$sucursal[0]['id']."' ",true);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Burger Kong | Panel</title>
 	<link rel="stylesheet" href="style/styleListProducto.css">
 </head>
 <body>
 		<?php echo getHeader();?>
 		<div id="wrapper">
 			<div class="midWrapper">
 				<div id="titleWelcome">Productos únicos de la sucursal</div>
				<div id="contentTable">
					<div id="table">
 						<?php 
 							for ($i=0; $i < count($productos); $i++) { 
 								echo '<div class="ticket">
 											<div class="container"><div class="idTicket">Id</div><div class="id">'.$productos[$i]['id'].'</div></div>
											<div class="container"><div class="idClient">Id Categoria</div><div class="client">'.$productos[$i]['idCategoria'].'</div></div>
											<div class="container"><div class="idSucursal">Id Sucursal</div><div class="sucursal">'.$sucursal[0]['id'].'</div></div>
											<div class="container"><div class="idSucursal">Titulo</div><div class="sucursal">'.$productos[$i]['titulo'].'</div></div>
											<div class="container"><div class="metodoPago">Subtitulo</div><div class="pago">'.$productos[$i]['subtitulo'].'</div></div>
											<div class="container"><div class="totalCompra">Total</div><div class="total">'.$productos[$i]['precio'].'</div></div>
											<div class="container"><div class="fechaTicket">Fecha de Compra</div><div class="fecha">'.$productos[$i]['fechaCreacion'].'</div></div>
 											<div id="containerLinks">
	 											<div class="contentImg"><a href="editar_producto.php?editar='.$productos[$i]['id'].'"><img class="imgEdit" src="style/img/edit.svg" alt=""></a></div>
	 											<div class="contentImg"><a href="borrar_producto.php?borrar='.$productos[$i]['id'].'"><img class="imgEdit" src="style/img/delete.svg" alt=""></a></div>
	 										</div>
 										</div>';
 							}
 						 ?>
 					</div>
 				</div>
 			</div>
			<div class="mid2Wrapper">
				<div id="contentLink"><a id="btnMenu" href="panel.php">Volver</a>
				</div>
			</div>
		</div>
		<?php echo getFooter();?>
 </body>
 </html>
