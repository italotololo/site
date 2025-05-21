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

						<?php if(($this->session->userdata("id_perfil")) == 4) : ?>
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Editar Agenda</span></h3>

						<?php else :?>							
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Visualizar Agenda</span></h3>

						<?php endif ?>	


		
		<hr class="featurette-divider">		
		<div class="row">
			<div class="container"> 
				<form id="frmEditarAgenda" method="post" action="<?= base_url() ?>Agenda/editar">
					<input type="hidden" id="hdnIdAgenda" name="hdnIdAgenda" value="<?= $dadosAgenda[0]->id_agenda; ?>">
					<div class="form-group">
					</div>

					

						<?php if(($this->session->userdata("id_perfil")) == 4) : ?>
							
							<div class="form-group">
									<label for="instituicao">Instituição</label>
										<select id="selInstituicao" name="selInstituicao" class="form-control">
										<option value='0'>Selecione</option>
										<?php
											foreach ($listaInstituicoes as $item){
											$selected = $dadosAgenda[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
											echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
											}      
										?>
										</select>
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
								</div>


								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="nome">Agenda</label>
										<input type="text" class="form-control" id="dsAgenda" name="dsAgenda" value="<?= $dadosAgenda[0]->ds_agenda;?>" maxlength="100" aria-describedby="emailHelp" required="required" autofocus="autofocus">
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>				
									</div>

									<div class="form-group col-md-6">
										<label for="data">Data</label>
											<input type="text" onkeyup="mascaraData(this);" class="form-control" id="txtdtagenda" name="txtdtagenda" value="<?= $dadosAgenda[0]->dt_agenda == Null ? "" : date("d/m/Y", strtotime($dadosAgenda[0]->dt_agenda)); ?>" maxlength="10" placeholder="DD/MM/AAAA" required>
											<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
									</div>
								</div>

					<br>
					
					<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Agenda/listar">VOLTAR</a>
												
							<button type="submit" class="btn btn-info" title="Realizar alteração">SALVAR</button>

						<?php else :?>							
							
							<div class="form-group">
									<label for="instituicao">Instituição</label>
										<select disabled="disabled" id="selInstituicao" name="selInstituicao" class="form-control">
										<option value='0'>Selecione</option>
										<?php
											foreach ($listaInstituicoes as $item){
											$selected = $dadosAgenda[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
											echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
											}      
										?>
										</select>
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
								</div>


								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="nome">Agenda</label>
										<input readonly="readonly" type="text" class="form-control" id="dsAgenda" name="dsAgenda" value="<?= $dadosAgenda[0]->ds_agenda;?>" maxlength="100" aria-describedby="emailHelp" required="required" autofocus="autofocus">
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>				
									</div>

									<div class="form-group col-md-6">
										<label for="data">Data</label>
											<input readonly="readonly" type="text" onkeyup="mascaraData(this);" class="form-control" id="txtdtagenda" name="txtdtagenda" value="<?= $dadosAgenda[0]->dt_agenda == Null ? "" : date("d/m/Y", strtotime($dadosAgenda[0]->dt_agenda)); ?>" maxlength="10" placeholder="DD/MM/AAAA" required>
											<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
									</div>
								</div>

					<br>
					
					<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Agenda/listar">VOLTAR</a>
												




						<?php endif ?>	





				</form>
			</div>                   
		</div>
	</div>
