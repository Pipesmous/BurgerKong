<?php  
	include 'dbTools.php';

	function getHeader(){
		return file_get_contents('template/header.html');
	}

	function getFooter(){
		return file_get_contents('template/footer.html');
	}

	function getMenu(){
		$producto = $_GET['producto'];
		$productos = query("SELECT * FROM `burgerKong__productos` WHERE `id` = $producto",true);
		
		for ($i=0; $i < count($productos); $i++) { 
			echo "
			<div id='wrapperDetalle'>
				<div class='productoDetalle'>
					<div class='tituloDetalle'>".$productos[$i]['titulo']."</div>
					<div class='imgDetalle'><img src=".$productos[$i]['imagenDescripcion']."></div>
					<div class='subtituloDetalle'>".$productos[$i]['subtitulo']."</div>
					<div class='precioDetalle'>Precio: ".$productos[$i]['precio']."</div>
					<div class='dateDetalle'>Fecha de Creacion: ".$productos[$i]['fechaCreacion']."</div>
				</div>
				<div id='goToCarrito'>
				<form method='POST'>				
					<input type='submit' name='btnCarrito' value='Agregar al Carrito'>
				</form>
				</div>
			</div>
			";
		}
	}

	function getCategorias($sucursal){
		$categorias = query("SELECT * FROM `burgerKong__categorias`",true);
		echo "<div class='contentCategorias'>";
			for ($i=0; $i < count($categorias); $i++) { 
				echo "
					<div class='categoria'>
						<a href='menu.php?sucursal=".$sucursal."&categoria=".$categorias[$i]["id"]."'>
						".$categorias[$i]["nombre"]."
						</a>
					</div>"
					;
			}

		if (getAllCant($_SESSION['carrito']) == 0) {
			echo "<a href='carrito.php?sucursal=".$_GET['sucursal']."' id='cart'>Ver Carrito(0) <img id='cssCart' src='./style/img/cart.svg'></a>";
		}else{
			echo "<a href='carrito.php?sucursal=".$_GET['sucursal']."' id='cart'>Ver Carrito(".getAllCant($_SESSION['carrito']).") <img id='cssCart' src='./style/img/cart.svg'></a>";
		}
		
		echo '</div>';
	}

	function getProducto($prod){
		$idProd = $prod['id'];
		$producto = query("SELECT * FROM burgerKong__productos WHERE id = $idProd",false)[0];
		$html = file_get_contents('template/producto.html');
		$html = str_replace("{{ID}}", $prod['id'], $html);
		$html = str_replace("{{TITULO}}", $producto['titulo'], $html);
		$html = str_replace("{{IMG}}", $producto['imagenMenu'], $html);
		$html = str_replace("{{CANTPROD}}", $prod['cant'], $html);
		$html = str_replace("{{PRECIO}}", $producto['precio'], $html);
		return $html;
	}

	function getPrecio($prod){
		$idProd = $prod['id'];
		$producto = query("SELECT * FROM burgerKong__productos WHERE id = $idProd",false)[0];
		$precio = floatval($producto['precio']);
		return $precio;
	}

	function getTotalCart($total){
		$html = file_get_contents('template/totalCart.html');
		$html = str_replace("{{TOTAL}}", $total, $html);
		return $html;
	}

	function ifMostOne($prod){
		$idProd = $prod['id'];
		$producto = query("SELECT * FROM burgerKong__productos WHERE id = $idProd",false)[0];
		$totalProd = 0;
		for ($i=0; $i < $prod['cant']; $i++) {
			$precio = floatval($producto['precio']);
			$totalProd += $precio;
		}
		return $totalProd;
	}

	function isInCart($cart,$id){
		for ($i=0; $i < count($cart); $i++) { 
			if ($cart[$i]['id'] == $id) {
				return $i;
			}
		}
		return -1;
	}

	function getAllCant($cart){
		$cant = 0;
		for ($i=0; $i < count($cart); $i++) {
			if ($cart[$i]['cant'] == 0) {
				break;
			}
			$cant += $cart[$i]['cant'];
		}
		return $cant;
	}

	function getCardTicket($cart){
		// var_dump($cart);
		$total = 0;
		for ($i=0; $i < count($cart); $i++) { 
			$total += ifMostOne($cart[$i]);
		}
		echo '
			<div id="ticket">
				<div id="contentTotal">
					<div id="title">Total:</div><div id="total">'.$total.'</div>
				</div>
				<div id="contentInfoClient">
					<form method="POST">
						<input type="text" id="nameClient" name="nameClient" placeholder="Nombre" required>
						<input type="text" id="surnameClient" name="surnameClient" placeholder="Apellido" required>
						<input type="number" id="dniClient" name="dniClient" placeholder="DNI" >
						<input type="number" id="telClient" name="telClient" placeholder="Telefono" required>
						<input type="text" id="dirClient" name="dirClient" placeholder="Direccion" required>
						<input type="text" id="emailClient" name="emailClient" placeholder="Email" required>
						<input type="text" id="passClient" name="passClient" placeholder="Password" required>
						Credito <input type="radio" id="metodoPago" name="metodoPago" value="1" required>
						Debito <input type="radio" id="metodoPago" name="metodoPago" value="2" required>
						<input type="submit" id="btnClient" name="btnClient" value="Confirmar">
					</form>
				</div>
				<div id="infoTicket">';
				for ($i=0; $i < count($cart); $i++) { 
					$prod = getProdTicket($cart[$i]);
					echo '<div class="prod">';
						echo '<div class="nameProd">'.$prod[0].'</div>';
						echo '<div class="contentImg"><img class="imgProd" src="'.$prod[1].'" alt=""></div>';
						echo '<div class="precioProd">'.$prod[2].'</div>';
					echo '</div>';
				}

		echo '	</div>
			</div>
		';
		return $total;
	}

	function getProdTicket($prod){
		$idProd = $prod['id'];
		$producto = query("SELECT * FROM burgerKong__productos WHERE id = $idProd",false)[0];
		$infoProd[] = $producto['titulo']; 
		$infoProd[] = $producto['imagenMenu']; 
		$infoProd[] = $producto['precio']; 
		return $infoProd;
	}

	function makeClient($name,$surname,$dni,$tel,$dir,$email,$pass){
		$client = query("SELECT * FROM `burgerKong__clientes` WHERE email = '$email'",true);
		if ($client == null) {
			query("INSERT INTO `burgerKong__clientes`(`nombre`, `apellido`, `dni`, `telefono`, `direccion`,`email`, `password`)
			VALUES ('$name','$surname','$dni','$tel','$dir','$email','$pass')",true);
			return true;
		}
		return false;
	}

	function makeTicket($idClient,$sucursal,$cart,$metodo){
		$total = 0;
		for ($i=0; $i < count($cart); $i++) { 
			$total += ifMostOne($cart[$i]);
		}
		if ($metodo == 1) {
			$metodo = 'Credito';
		}
		if ($metodo == 2) {
			$metodo = 'Debiito';
		}
		query("INSERT INTO `burgerKong__tickets`(`idCliente`, `FK_ID_SUCURSAL` , `metodoPago`, `totalCompra`) VALUES ('".$idClient[0]['id']."','".$sucursal."','".$metodo."','".$total."')",true);
	}

	function getLastTicket(){
		return query("SELECT `id` FROM `burgerKong__tickets` ORDER BY id DESC LIMIT 1 ",true);
	}

	function validateAccount($email, $pass){
		$users = query('SELECT * FROM `burgerKong__admins` WHERE 1',true);
		for ($i=0; $i < count($users); $i++) { 
			if ($users[$i]['user'] == $email and $users[$i]['password'] == $pass) {
				return $users[$i];
			}
		}
		return false;
	}

	function getSucursal($idAdmin){
		$idSucursal = query("SELECT `FK_ID_SUCURSAL` FROM `burgerKong__admins` WHERE id = '".$idAdmin."' ",true);
		$infoSucursal = query("SELECT * FROM `burgerKong__sucursales` WHERE id = '".$idSucursal[0]['FK_ID_SUCURSAL']."' ",true);
		return $infoSucursal;	
	}

	function infoSucursal($idSucursal){
		$montoTickets = query("SELECT totalCompra FROM `burgerKong__tickets` WHERE FK_ID_SUCURSAL = '".$idSucursal."' ",true);
		$montoTickets = getTotalCompras($montoTickets);

		$promTickets = query("SELECT id FROM `burgerKong__tickets` WHERE FK_ID_SUCURSAL = '".$idSucursal."' ",true);
		$promTickets = count($promTickets);

		$array['monto'] = $montoTickets;
		$array['promedio'] = $promTickets;

		return $array;
	}

	function getTotalCompras($monto){
		$total = 0;
		for ($i=0; $i < count($monto); $i++) {
			$intMonto = $monto[$i]['totalCompra'];
			$total += $intMonto;
		}
		return $total;
	}

	function makeProducto($idSucursal,$name,$subtitle,$precio,$img,$categoria){
		$newProduct = query("INSERT INTO `burgerKong__productos`(`idCategoria`, `FK_ID_SUCURSAL`, `titulo`, `subtitulo`, `imagenMenu`, `imagenDescripcion`, `precio`) VALUES (".$categoria.",".$idSucursal.",'".$name."','".$subtitle."','".$img."','".$img."',".$precio.")",true);
		return $newProduct;
	}

	function modProducto($idProd,$titulo,$subtitulo,$precio,$img,$categoria){
		if ($img == null) {
			query('UPDATE `burgerKong__productos` SET 
			`idCategoria`="'.$categoria.'",
			`titulo`= "'.$titulo.'",
			`subtitulo`="'.$subtitulo.'",
			`precio`= "'.$precio.'"
			WHERE `id` = "'.$idProd.'" ',true);
			return true;
		}
		query('UPDATE `burgerKong__productos` SET 
			`idCategoria`="'.$categoria.'",
			`titulo`= "'.$titulo.'",
			`subtitulo`="'.$subtitulo.'",
			`imagenMenu`="'.$img.'",
			`imagenDescripcion`="'.$img.'",
			`precio`= "'.$precio.'"
			WHERE `id` = "'.$idProd.'" ',true);
		return false;
	}
?>