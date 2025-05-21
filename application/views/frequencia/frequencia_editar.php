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
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Editar Frequência</span></h3>

						<?php else :?>							
							<h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Visualizar Frequência</span></h3>

						<?php endif ?>	
		
		<hr class="featurette-divider">		
		<div class="row">
			<div class="container"> 
				<form id="frmFrequenciaEditar" method="post" action="<?= base_url() ?>Frequencia/editar">
					<input type="hidden" id="hdnIdFrequencia" name="hdnIdFrequencia" value="<?= $dadosFrequencia[0]->id_frequencia; ?>">
					<div class="form-group">
					</div>

							

						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
							

									<div class="form-group">
								<label for="instituicao">Instituição</label>
									<select id="selInstituicao" name="selInstituicao" class="form-control">
									<option value='0'>Selecione</option>
									<?php
										foreach ($listaInstituicoes as $item){
										$selected = $dadosFrequencia[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
										echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
										}      
									?>
									</select>
									<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
							</div>

							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="disciplina">Disciplina</label>
										<select id="selDisciplina" name="selDisciplina" class="form-control">
										<option value='0'>Selecione</option>
										<?php
											foreach ($listaDisciplinas as $item){
											$selected = $dadosFrequencia[0]->id_disciplina == $item->id_disciplina ? 'selected=selected': '';
											echo "<option value='{$item->id_disciplina}' {$selected}>{$item->ds_disciplina}</option>";
											}      
										?>
										</select>
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
								</div>


								<div class="form-group col-md-6">
									<label for="aluno">Aluno</label>
										<select id="selAluno" name="selAluno" class="form-control">
										<option value='0'>Selecione</option>
										<?php
											foreach ($listaAlunos as $item){
											$selected = $dadosFrequencia[0]->id_aluno == $item->id_aluno ? 'selected=selected': '';
											echo "<option value='{$item->id_aluno}' {$selected}>{$item->nome}</option>";
											}      
										?>
										</select>
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
								</div>


							</div>

							<div class="form-row">

								<div class="form-group col-md-6">
									<label for="aluno">Status</label>
										<select id="selStatus" name="selStatus" class="form-control">
										<option value='0'>Selecione</option>
										<?php
											foreach ($listaStatuss as $item){
											$selected = $dadosFrequencia[0]->id_status == $item->id_status ? 'selected=selected': '';
											echo "<option value='{$item->id_status}' {$selected}>{$item->ds_status}</option>";
											}      
										?>
										</select>
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
								</div>

								<div class="form-group col-md-6">
									<label for="data">Data</label>
										<input type="text" onkeyup="mascaraData(this);" class="form-control" id="txtdtfrequencia" name="txtdtfrequencia" value="<?= $dadosFrequencia[0]->dt_frequencia == Null ? "" : date("d/m/Y", strtotime($dadosFrequencia[0]->dt_frequencia)); ?>" maxlength="10" placeholder="DD/MM/AAAA" required>
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
								</div>

							</div>	

							<br>			
							<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Frequencia/listar">VOLTAR</a>
							<button type="submit" class="btn btn-info" title="Realizar alteração">SALVAR</button>
						<?php else :?>							
							


							<div class="form-group">
									<label for="instituicao">Instituição</label>
										<select disabled="disabled" id="selInstituicao" name="selInstituicao" class="form-control">
										<option value='0'>Selecione</option>
										<?php
											foreach ($listaInstituicoes as $item){
											$selected = $dadosFrequencia[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
											echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
											}      
										?>
										</select>
										<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
								</div>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="disciplina">Disciplina</label>
											<select disabled="disabled" id="selDisciplina" name="selDisciplina" class="form-control">
											<option value='0'>Selecione</option>
											<?php
												foreach ($listaDisciplinas as $item){
												$selected = $dadosFrequencia[0]->id_disciplina == $item->id_disciplina ? 'selected=selected': '';
												echo "<option value='{$item->id_disciplina}' {$selected}>{$item->ds_disciplina}</option>";
												}      
											?>
											</select>
											<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
									</div>


									<div class="form-group col-md-6">
										<label for="aluno">Aluno</label>
											<select disabled="disabled" id="selAluno" name="selAluno" class="form-control">
											<option value='0'>Selecione</option>
											<?php
												foreach ($listaAlunos as $item){
												$selected = $dadosFrequencia[0]->id_aluno == $item->id_aluno ? 'selected=selected': '';
												echo "<option value='{$item->id_aluno}' {$selected}>{$item->nome}</option>";
												}      
											?>
											</select>
											<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
									</div>


								</div>

								<div class="form-row">

									<div class="form-group col-md-6">
										<label for="aluno">Status</label>
											<select disabled="disabled" id="selStatus" name="selStatus" class="form-control">
											<option value='0'>Selecione</option>
											<?php
												foreach ($listaStatuss as $item){
												$selected = $dadosFrequencia[0]->id_status == $item->id_status ? 'selected=selected': '';
												echo "<option value='{$item->id_status}' {$selected}>{$item->ds_status}</option>";
												}      
											?>
											</select>
											<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
									</div>

									<div class="form-group col-md-6">
										<label for="data">Data</label>
											<input readonly="readonly" type="text" onkeyup="mascaraData(this);" class="form-control" id="txtdtfrequencia" name="txtdtfrequencia" value="<?= $dadosFrequencia[0]->dt_frequencia == Null ? "" : date("d/m/Y", strtotime($dadosFrequencia[0]->dt_frequencia)); ?>" maxlength="10" placeholder="DD/MM/AAAA" required>
											<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
									</div>

								</div>	

							<br>			
							<a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Frequencia/listar">VOLTAR</a>
							

						<?php endif ?>	
				</form>
			</div>                   
		</div>
	</div>
