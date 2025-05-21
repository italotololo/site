<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">
	<body>
		<main role="main">
		  <div id="myCarousel" class="carousel slide" data-ride="carousel">
			<?php if($this->session->flashdata("success")) : ?>
				<br>
				<p class="alert alert-success"><?= $this->session->flashdata("success") ?></p>
			<?php endif ?> 
			<br>
			<br>							
			<!--<h5 class="form-signin-heading text-center">Controle de Pedidos</h5>-->
		
			<script type="text/javascript">

				document.body.style.backgroundImage  = "url(<?= base_url() ?>imagens/fotologoponfaes_2.png)";          
				document.body.style.backgroundRepeat  = "no-repeat"
				document.body.style.backgroundPosition = "50% 80px";
			</script>