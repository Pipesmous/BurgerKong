<?php 
	function convertorSucursales(){
		$file = fopen('CSV/categorias.csv',"r");
		if (!file_exists('CSV/categorias.csv')) {
			echo "No se econtro el CSV";
		}
		$categorias = array();
		while (!feof($file)) {
			$categorias[] = explode("|",fgets($file));
		}
		$sentencia = "";
		$db = fopen("categorias.sql","w");
		for ($i=1; $i < count($categorias); $i++) { 
			$sentencia .= "INSERT INTO `categorias`(`id`, `nombre`, `fechaCreacion`) VALUES (".$categorias[$i][0].",'".$categorias[$i][1]."','".$categorias[$i][2]."');".PHP_EOL;		
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
		<input type="submit" name="btnAccept" value="Descargar categorias.sql">
	</form>
</body>
</html>