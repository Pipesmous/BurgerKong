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
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Burger Kong | Panel</title>
 	<link rel="stylesheet" href="style/styleListTickets.css">
 </head>
 <body>
 		<?php echo getHeader();?>
 		<div id="wrapper">
 			<div class="midWrapper">
 				<div id="titleWelcome"><?php echo 'Monto total: '.$infoSucursal['monto'].'.- a la fecha '.$date ?></div>
				<div id="contentTable">
					<div id="table">
 						<?php 
 							for ($i=0; $i < count($tickets); $i++) { 
 								echo '<div class="ticket">
 											<div class="container"><div class="idTicket">Id</div><div class="id">'.$tickets[$i]['id'].'</div></div>
											<div class="container"><div class="idClient">Id Cliente</div><div class="client">'.$tickets[$i]['idCliente'].'</div></div>
											<div class="container"><div class="idSucursal">Id Sucursal</div><div class="sucursal">'.$tickets[$i]['FK_ID_SUCURSAL'].'</div></div>
											<div class="container"><div class="metodoPago">Metodo de pago</div><div class="pago">'.$tickets[$i]['metodoPago'].'</div></div>
											<div class="container"><div class="totalCompra">Total</div><div class="total">'.$tickets[$i]['totalCompra'].'</div></div>
											<div class="container"><div class="fechaTicket">Fecha de Compra</div><div class="fecha">'.$tickets[$i]['fechaTicket'].'</div></div>
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


