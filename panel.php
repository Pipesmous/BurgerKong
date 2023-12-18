<?php 
	session_start();
	include 'libs/tools.php';
	if (empty($_SESSION['idAdmin'])) {
		header('Location: sucursales.php');
	}
	$sucursal = getSucursal($_SESSION['idAdmin']);
	$infoSucursal = infoSucursal($sucursal[0]['id']);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Burger Kong | Panel</title>
 	<link rel="stylesheet" href="style/stylePanel.css">
 </head>
 <body>
 		<?php echo getHeader();?>
 		<div id="wrapper">
 			<div class="midWrapper">
 				<div id="titleWelcome"><?php echo 'Bienvenido Administrador de '.$sucursal[0]['nombre'] ?></div>
				<div id="contentTable">
					<div id="table">
	 					<div id="montoSucursal"><div class="titleTable">Monto Total: </div><div class="intTable"><?php echo $infoSucursal['monto'] ?></div></div>
	 					<div id="promSucursal"><div class="titleTable">Promedio Tickets: </div><div class="intTable"><?php echo $infoSucursal['promedio'] ?></div></div>
 					</div>
 				</div>
 			</div>
			<div class="mid2Wrapper">
				<div id="contentLink"><a id="btnMenu" href="?btn=menu">Menu</a>
				<?php
					if (isset($_GET['btn'])) {
						echo '<div id="tickets">
									<a class="links" href="listar_tickets.php">Tickets</a>				
									<a class="links" href="nuevo_producto.php">Crear Producto</a>				
									<a class="links" href="listar_producto.php">Listar Productos</a>				
									<a class="links" href="logout.php">Salir</a>				
								</div>';
					}
				?>
				</div>
			</div>

		</div>
		<?php echo getFooter();?>
 </body>
 </html>

 