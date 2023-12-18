<?php 
	function convertorSucursales(){
		$file = fopen('CSV/sucursales.csv',"r");
		if (!file_exists('CSV/sucursales.csv')) {
			echo "No se econtro el CSV";
		}
		$sucursal = array();
		while (!feof($file)) {
			$sucursal[] = explode("|",fgets($file));
		}
		$sentencia = "";
		$db = fopen("sucursales.sql","w");
		for ($i=1; $i < count($sucursal); $i++) { 
			$sentencia .= "INSERT INTO `sucursales`(`id`, `nombre`, `ubicacion`) VALUES (".$sucursal[$i][0].",'".$sucursal[$i][1]."','".$sucursal[$i][2]."');".PHP_EOL;		
		}
		fwrite($db, $sentencia);
		return true;
	}

	if (isset($_POST["btnAccept"])) {
		convertorSucursales();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form method="POST">
		<input type="submit" name="btnAccept" value="Descargar Sucursales.sql">
	</form>
</body>
</html>