<?php 
	session_start();
	include 'libs/tools.php';
	if (empty($_SESSION['idAdmin'])) {
		header('Location: sucursales.php');
	}
	$sucursal = getSucursal($_SESSION['idAdmin']);
	$productos = query("SELECT * FROM `burgerKong__productos` WHERE `id` = '".$_GET['editar']."' ",true);
	$categorias = query("SELECT * FROM `burgerKong__categorias` WHERE 1",true);
	// var_dump($productos);
	var_dump($_FILES);
	if (isset($_POST['btnSubmit'])) {
		if ($_FILES['imgProd']['name'] != '') {
			$date = date("Ymd_H");
			$imgTxt = explode('.', $_FILES['imgProd']['name']);
			$imgTxt = $sucursal[0]['id'].'_'.$_POST['titulo'].'_'.$date.'.'.$imgTxt[1];
			$nameImg = $_FILES['imgProd']['name'];
			$typeImg = $_FILES['imgProd']['type'];
			$sizeImg = $_FILES['imgProd']['size'];
			var_dump($imgTxt);
			if (!((strpos($typeImg, "png") || strpos($typeImg, "jpg") || strpos($typeImg, "jpeg")) && ($sizeImg < 100000))) {
		   		echo 'El archivo debe ser .png o .jpg';
			}else{
		   		if (move_uploaded_file($_FILES['imgProd']['tmp_name'],  "./style/img/".$imgTxt)){
					modProducto($_GET['editar'],$_POST['titulo'],$_POST['subtitulo'],$_POST['precio'],$imgTxt,$_POST['categorias']);
					header('Location: listar_producto.php');
		   		}else{
		      		echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
		   		}
			}
		}else{
			modProducto($_GET['editar'],$_POST['titulo'],$_POST['subtitulo'],$_POST['precio'],null,$_POST['categorias']);
			header('Location: listar_producto.php');
		}
	}
	if (isset($_POST['btnCancelar'])) {
		header('Location: panel.php');
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Burger Kong | Panel</title>
 	<link rel="stylesheet" href="style/styleCrearProducto.css">
 </head>
 <body>
 		<?php echo getHeader();?>
 		<div id="wrapper">
 			<div class="midWrapper">
 				<div id="titleWelcome">Editar producto</div>
 				<div id="contentForm">
				 	<?php 
						echo '<form method="POST" enctype="multipart/form-data">
									 		<input type="text" class="inputForm" name="titulo" value="'.$productos[0]['titulo'].'" placeholder="Titulo">
									 		<input type="text" class="inputForm" name="subtitulo" value="'.$productos[0]['subtitulo'].'" placeholder="Subitulo">
									 		<input type="number" class="inputForm" name="precio" value="'.$productos[0]['precio'].'" placeholder="Precio">
									 		<input type="hidden" name="MAX_FILE_SIZE" value="100000">
									 		<input type="file" class="inputFileForm" name="imgProd">
									 		<select name="categorias">';
										 		for ($i=0; $i < count($categorias); $i++) { 
										 			echo '<option value="'.$categorias[$i]['id'].'">'.$categorias[$i]['nombre'].'</option>';
										 		}
						echo 	'			</select>
									 		<input type="submit" id="btnSubmit" name="btnSubmit" value="Aceptar">
									 		<input type="submit" id="btnCancelar" name="btnCancelar" value="Cancelar">
									 	</form>	';
					?>
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

