<?php 
	include 'tools.php';
	$producto = 1451;
	$productos = query("SELECT * FROM `burgerKong__productos` WHERE `id` = $producto",true);
	if(!isset($_SESSION['carrito'])){
		$_SESSION['carrito'] = array();	
	}
	getCart($_SESSION['carrito'],$productos);

?>