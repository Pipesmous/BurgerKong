<?php 
	include 'libs/tools.php'; 
	session_start(); 
	$ticket = getLastTicket();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BurgerKong | Gracias</title>
	<link rel="stylesheet" href="style/styleGracias.css">
</head>
<body>
	<div id="wrapper">
		<div id="msg">
			Muchas Gracias por su compra, para seguir comprando productos presione confirmar.
		</div>
		<div id="btnGoToSucursales">
			<a href="sucursales.php" id="btnConfirm">Confirmar</a>
		</div>
		<div id="ticket">
			El Numero de Ticket es <?php echo $ticket[0]['id'] ?>
		</div>
	</div>
</body>
</html>