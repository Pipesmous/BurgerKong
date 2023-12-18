<?php 
	include 'libs/tools.php'; 
	session_start();
	if (isset($_POST['btnClient'])) {
		makeClient($_POST['nameClient'],$_POST['surnameClient'],$_POST['dniClient'],$_POST['telClient'],$_POST['dirClient'],$_POST['emailClient'],$_POST['passClient']);
		$idClient = query("SELECT id FROM `burgerKong__clientes` WHERE email = '".$_POST['emailClient']."' ",true);
		$_SESSION['ticket'] = makeTicket($idClient,$_GET['sucursal'],$_SESSION['carrito'],$_POST['metodoPago']);
		unset($_SESSION['carrito']);
		header('Location: gracias.php');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BurgerKong | Ticket</title>
	<link rel="stylesheet" href="style/styleTicket.css">
</head>
<body>
	<div id="wrapper">
	<?php 
		echo getHeader(); 
		echo '<div id="contentTicket">';
		$ticket = getCardTicket($_SESSION['carrito']);
		echo '</div>';
		echo getFooter();
	?>
	</div>
</body>
</html>
