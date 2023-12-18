<?php 
	session_start();
	include 'libs/tools.php';
	$alert = '';
	unset($_SESSION['carrito']);
	if (isset($_POST['btnAccept'])) {
		$admin = validateAccount($_POST['adminUser'],$_POST['adminPass']);
		if ($admin != false) {
			$_SESSION['idAdmin'] = $admin['id'];
			header('Location: panel.php');
		}
		$alert = 'Credenciales Incorrectas';
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Burger Kong | Administradores</title>
	<link rel="stylesheet" href="style/styleAdmin.css">
</head>
<body>
	<?php echo getHeader();?>
	<div id="wrapperMenu">
		<div id="contentLogin">
			<div id="title">Login</div>
			<form method="POST">
				<input type="text" class="inputs" name="adminUser" placeholder="Usuario">
				<input type="text" class="inputs" name="adminPass" placeholder="Password">
				<input type="submit" id="btn" name="btnAccept" value="Aceptar">
			</form>
		</div>
		<div id="alert"><?php echo $alert; ?></div>
	</div>
	<?php echo getFooter();?>
</body>
</html>