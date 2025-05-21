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
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Boletins Cadastrados </span></h3>
        <hr class="featurette-divider">        
        

						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
							<a class="btn btn-outline-primary" href="<?= base_url() ?>Boletim/novo">Novo Boletim</a>
						<?php else :?>
							
						<?php endif ?>	



		<br>
		<br>			
		<form id="frmBoletimPesquisa" method="post" action="<?= base_url() ?>Boletim/pesquisar">

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

			<div class="form-group">
				<label for="disciplina">Disciplina</label>
				<select id="selDisciplina" class="form-control" name="selDisciplina">
					<option value="">Selecione</option>
					<?php foreach ($listaDisciplinas as $item) : ?>
						<option value="<?= $item->id_disciplina ?>"><?= $item->ds_disciplina ?></option>
					<?php endforeach ?>
				</select>
				<!--<small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>-->
			</div>


						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>

							<div class="form-group">
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

			<!--
			<div class="form-row">                  						
				<div class="form-group col-md-12">
					<label for="Comunicado">Descrição</label>
					<input type="text" class="form-control" id="dsComunicado" name="dsComunicado" maxlength="100">				
				</div>
			</div>
			-->
			<button type="submit" class="btn btn-info" title="Realizar pesquisa">Pesquisar</button>
		</form>
		<br>
		<br>   							
		<h6 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Quantidade: <?php echo " " .count($listaBoletims);?></span></h6>
        <div class="row">
			<div class="container">
				<table class="table table-striped">
				  <tr>
					<th>Instituição</th>
					<th>Disciplina</th>					
					<th>Aluno</th>
					<th>Nota</th>
					<!--<th>Cadastro</th>-->
					<th></th>
				  </tr>
				  <?php foreach($listaBoletims as $item) : ?>
					<tr class>
					  <td><?= $item->ds_instituicao; ?></td>
					  <td><?= $item->ds_disciplina; ?></td>
					  <td><?= $item->nome; ?></td>
					  <td><?= $item->nota; ?></td>
					  <!--<td><?= $item->dt_cadastro == Null ? "" : date("d/m/Y", strtotime($item->dt_cadastro)); ?></td>-->
					  <td>
						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>

								<a href="<?= base_url("Boletim/selecionar/". $item->id_boletim) ?>" title="Editar boletim" class="btn btn-primary btn-sm btn-group">Editar</a>
								<a href="<?= base_url("Boletim/excluir/". $item->id_boletim) ?>" title="Excluir boletim" class="btn btn-danger btn-sm btn-group" onclick="return confirm('Confirma a exclusão?');">Excluir</a>
						<?php else :?>
							<a href="<?= base_url("Boletim/selecionar/". $item->id_boletim) ?>" title="Editar boletim" class="btn btn-primary btn-sm btn-group">Visualizar</a>						
						<?php endif ?>		
					  </td>
					</tr>
				<?php endforeach?>
				</table> 
			</div>                   
        </div>
	</div>



					
