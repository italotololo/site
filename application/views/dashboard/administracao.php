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
				document.body.style.backgroundImage  = "url(<?= base_url() ?>imagens/logo_demarmitafit_trans.png)";          
				document.body.style.backgroundRepeat  = "no-repeat"
				document.body.style.backgroundPosition = "50% 350px";
			</script>
			<div class="container marketing">
				<br>
				<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Administração</span></h3>
				<hr class="featurette-divider">        
				<a class="btn btn-outline-primary" href="<?= base_url() ?>Grupo/novo">Novo grupo</a>
				<a class="btn btn-outline-primary" href="<?= base_url() ?>Pacote/novo">Novo pacote</a>
				<a class="btn btn-outline-primary" href="<?= base_url() ?>Acompanhamento/novo">Novo acompanhamento</a>
				<br>
				<br>	
				<br>
				<br>				
			</div>
