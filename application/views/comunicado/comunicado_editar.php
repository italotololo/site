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

						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Editar Comunicado</span></h3>

						<?php else :?>							
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Visualizar Comunicado</span></h3>

						<?php endif ?>	


		<hr class="featurette-divider">		
		<div class="row">
			<div class="container"> 
				<form id="frmComunicadoEditar" method="post" action="<?= base_url() ?>Comunicado/editar">
					<input type="hidden" id="hdnIdComunicado" name="hdnIdComunicado" value="<?= $dadosComunicado[0]->id_comunicado; ?>">
					<div class="form-group">
					</div>
						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
							<div class="form-group">
								<label for="instituicao">Instituição</label>
									<select id="selInstituicao" name="selInstituicao" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaInstituicoes as $item){
										$selected = $dadosComunicado[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
										echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="nome">Comunicado</label>
									<input type="text" class="form-control" id="dsComunicado" name="dsComunicado" value="<?= $dadosComunicado[0]->ds_comunicado;?>" maxlength="100" aria-describedby="emailHelp" required="required" autofocus="autofocus">
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>				
								</div>
							</div>		
						<br>
						<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Comunicado/listar">VOLTAR</a>					
						<button type="submit" class="btn btn-info" title="Realizar alteração">SALVAR</button>
							

						<?php else :?>							
							<div class="form-group">
								<label for="instituicao">Instituição</label>
									<select disabled="disabled" id="selInstituicao" name="selInstituicao" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaInstituicoes as $item){
										$selected = $dadosComunicado[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
										echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="nome">Comunicado</label>
									<input readonly="readonly" type="text" class="form-control" id="dsComunicado" name="dsComunicado" value="<?= $dadosComunicado[0]->ds_comunicado;?>" maxlength="100" aria-describedby="emailHelp" required="required" autofocus="autofocus">
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>				
								</div>
							</div>

						<br>
						<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Comunicado/listar">VOLTAR</a>					

						<?php endif ?>							
						
				</form>
			</div>                   
		</div>
	</div>




