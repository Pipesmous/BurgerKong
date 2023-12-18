<?php 
	function convertorSucursales(){
		$file = fopen('CSV/productos.csv',"r");
		if (!file_exists('CSV/productos.csv')) {
			echo "No se econtro el CSV";
		}
		$productos = array();
		while (!feof($file)) {
			$productos[] = explode("|",fgets($file));
		}
		$sentencia = "";
		$db = fopen("productos.sql","w");
		for ($i=1; $i < count($productos); $i++) { 
			$sentencia .= "INSERT INTO `productos`(`id`, `idCategoria`, `titulo`, `subtitulo`, `imagenMenu`, `imagenDescripcion`, `precio`, `fechaCreacion`) VALUES (".$productos[$i][0].",".$productos[$i][1].",'".$productos[$i][2]."','".$productos[$i][3]."','".$productos[$i][4]."','".$productos[$i][5]."',".$productos[$i][6].",'".$productos[$i][7]."');".PHP_EOL;		
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
		<input type="submit" name="btnAccept" value="Descargar Productos.sql">
	</form>
</body>
</html>