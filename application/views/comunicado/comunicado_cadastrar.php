<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <main role="main">
	<div class="container marketing">
		<?php if($this->session->flashdata("sucesso")) : ?>
			<br>
			<p class="alert alert-success"><?= $this->session->flashdata("sucesso") ?></p>
		<?php endif ?>
		<?php if($this->session->flashdata("erro")) : ?>
			<br>
			<p class="alert alert-danger"><?= $this->session->flashdata("erro") ?></p>
			<br>
		<?php endif ?>
	</div>
	<div class="container marketing">	        
        <br>
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Cadastro de comunicado</span></h3>
        <hr class="featurette-divider">
		<a class="btn btn-outline-primary" href="<?= base_url() ?>Comunicado/listar" >Pesquisar comunicado</a>
		<br>
		<br>
        <div class="row">
          <div class="container"> 
				<form id="frmComunicadoCadastro" method="post" action="<?= base_url() ?>Comunicado/cadastrar">
					
				<div class="form-group">
                	<label for="instituicao">Instituição</label>
					<select id="selInstituicao" class="form-control" name="selInstituicao" required>
						<option value="">Selecione</option>
						<?php foreach ($listaInstituicoes as $item) : ?>
							<option value="<?= $item->id_instituicao ?>"><?= $item->ds_instituicao ?></option>
						<?php endforeach ?>
					</select>
					<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
              	</div>

				
					<div class="form-row">	
						<div class="form-group col-md-12">
							<label for="nome">Comunicado</label>
							<input type="text" class="form-control" id="dsComunicado" name="dsComunicado" maxlength="100" aria-describedby="emailHelp" required="required" autofocus="autofocus">
							<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>										
						</div>					
					</div>
					<br>
					<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Comunicado/novo">LIMPAR</a>
					<button type="submit" class="btn btn-info" title="Realizar cadastro">SALVAR</button>
				</form>
			</div>                   
        </div>
	</div>
