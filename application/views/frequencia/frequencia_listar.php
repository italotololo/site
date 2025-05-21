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
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Frequências Cadastradas</span></h3>
        <hr class="featurette-divider">        
        

						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
							<a class="btn btn-outline-primary" href="<?= base_url() ?>Frequencia/novo">Nova Frequência</a>
						<?php else :?>
							
						<?php endif ?>	


		
		<br>
		<br>			
		<form id="frmFrequenciaPesquisa" method="post" action="<?= base_url() ?>Frequencia/pesquisar">

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

				<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>

							<div class="form-group col-md-12">
						<label for="aluno">Aluno</label>
						<select id="selAluno" class="form-control" name="selAluno">
							<option value="">Selecione</option>
							<?php foreach ($listaAlunos as $item) : ?>
								<option value="<?= $item->id_aluno ?>"><?= $item->nome ?></option>
							<?php endforeach ?>
						</select>
						<!--<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>-->
					</div>

				<?php else :?>
					
				<?php endif ?>	

			</div>

			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="disciplina">Disciplina</label>
					<select id="selDisciplina" class="form-control" name="selDisciplina">
						<option value="">Selecione</option>
						<?php foreach ($listaDisciplinas as $item) : ?>
							<option value="<?= $item->id_disciplina ?>"><?= $item->ds_disciplina ?></option>
						<?php endforeach ?>
					</select>
					<!--<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>-->
				</div>

				<div class="form-group col-md-4">
					<label for="Status">Status</label>
					<select id="selStatus" class="form-control" name="selStatus">
						<option value="">Selecione</option>
						<?php foreach ($listaStatuss as $item) : ?>
							<option value="<?= $item->id_status ?>"><?= $item->ds_status ?></option>
						<?php endforeach ?>
					</select>
					<!--<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>-->
				</div>


				<div class="form-group col-md-4">
                  <label for="data">Data</label>
                     <input type="text" onkeyup="mascaraData(this);" class="form-control" id="txtdtfrequencia" name="txtdtfrequencia" maxlength="10" placeholder="DD/MM/AAAA">
                </div>


			</div>

			<div class="form-row">
				                										

			</div>

			<!--

			-->
			<button type="submit" class="btn btn-info" title="Realizar pesquisa">Pesquisar</button>
		</form>
		<br>
		<br>   							
		<h6 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Quantidade: <?php echo " " .count($listaFrequencias);?></span></h6>
        <div class="row">
			<div class="container">
				<table class="table table-striped">
				  <tr>
					<th>Instituição</th>
					<th>Disciplina</th>					
					<th>Aluno</th>
					<th>Status</th>
					<th>Data</th>
					<th></th>
				  </tr>
				  <?php foreach($listaFrequencias as $item) : ?>
					<tr class>
					  <td><?= $item->ds_instituicao; ?></td>
					  <td><?= $item->ds_disciplina; ?></td>
					  <td><?= $item->nome; ?></td>
					  <td><?= $item->ds_status; ?></td>
					  <td><?= $item->dt_frequencia == Null ? "" : date("d/m/Y", strtotime($item->dt_frequencia)); ?></td>
					  <td>
							<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
								<a href="<?= base_url("Frequencia/selecionar/". $item->id_frequencia) ?>" title="Editar frequência" class="btn btn-primary btn-sm btn-group">Editar</a>
								<a href="<?= base_url("Frequencia/excluir/". $item->id_frequencia) ?>" title="Excluir frequência" class="btn btn-danger btn-sm btn-group" onclick="return confirm('Confirma a exclusão?');">Del</a>

						<?php else :?>
							<a href="<?= base_url("Frequencia/selecionar/". $item->id_frequencia) ?>" title="Editar frequência" class="btn btn-primary btn-sm btn-group">Visualizar</a>
						<?php endif ?>							


					  </td>
					</tr>
				<?php endforeach?>
				</table> 
			</div>                   
        </div>
	</div>

