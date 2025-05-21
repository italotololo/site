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
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Editar Boletim</span></h3>

						<?php else :?>							
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Visualizar Boletim</span></h3>

						<?php endif ?>	
		
		<hr class="featurette-divider">		
		<div class="row">
			<div class="container"> 
				<form id="frmBoletimEditar" method="post" action="<?= base_url() ?>Boletim/editar">
					<input type="hidden" id="hdnIdBoletim" name="hdnIdBoletim" value="<?= $dadosBoletim[0]->id_boletim; ?>">
					<div class="form-group">
					</div>

					

					<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
						

						<div class="form-group">
								<label for="instituicao">Instituição</label>
									<select id="selInstituicao" name="selInstituicao" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaInstituicoes as $item){
										$selected = $dadosBoletim[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
										echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>

							<div class="form-group">
								<label for="disciplina">Disciplina</label>
									<select id="selDisciplina" name="selDisciplina" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaDisciplinas as $item){
										$selected = $dadosBoletim[0]->id_disciplina == $item->id_disciplina ? 'selected=selected': '';
										echo "<option value='{$item->id_disciplina}' {$selected}>{$item->ds_disciplina}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>

							<div class="form-group">
								<label for="aluno">Aluno</label>
									<select id="selAluno" name="selAluno" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaAlunos as $item){
										$selected = $dadosBoletim[0]->id_aluno == $item->id_aluno ? 'selected=selected': '';
										echo "<option value='{$item->id_aluno}' {$selected}>{$item->nome}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>

							<div class="form-row">	
								<div class="form-group col-md-12">
									<label for="nota">Nota</label>
									<input type="text" class="form-control" id="txtnota" name="txtnota" maxlength="4" value="<?= $dadosBoletim[0]->nota; ?>" aria-describedby="emailHelp" required="required" autofocus="autofocus">
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>										
								</div>					
							</div>

											</br>
					<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Boletim/listar">VOLTAR</a>
					<button type="submit" class="btn btn-info" title="Realizar alteração">SALVAR</button>
									
									
					<?php else :?>							
						
						<div class="form-group">
								<label for="instituicao">Instituição</label>
									<select disabled="disabled" id="selInstituicao" name="selInstituicao" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaInstituicoes as $item){
										$selected = $dadosBoletim[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
										echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>

							<div class="form-group">
								<label for="disciplina">Disciplina</label>
									<select disabled="disabled" id="selDisciplina" name="selDisciplina" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaDisciplinas as $item){
										$selected = $dadosBoletim[0]->id_disciplina == $item->id_disciplina ? 'selected=selected': '';
										echo "<option value='{$item->id_disciplina}' {$selected}>{$item->ds_disciplina}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>

							<div class="form-group">
								<label for="aluno">Aluno</label>
									<select disabled="disabled" id="selAluno" name="selAluno" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaAlunos as $item){
										$selected = $dadosBoletim[0]->id_aluno == $item->id_aluno ? 'selected=selected': '';
										echo "<option value='{$item->id_aluno}' {$selected}>{$item->nome}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>

							<div class="form-row">	
								<div class="form-group col-md-12">
									<label for="nota">Nota</label>
									<input readonly="readonly" type="text" class="form-control" id="txtnota" name="txtnota" maxlength="4" value="<?= $dadosBoletim[0]->nota; ?>" aria-describedby="emailHelp" required="required" autofocus="autofocus">
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>										
								</div>					
							</div>

				</br>
					<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Boletim/listar">VOLTAR</a>
					
					<?php endif ?>	

					
					
				</form>
			</div>                   
		</div>
	</div>
