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
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Agendas Cadastradas</span></h3>
        <hr class="featurette-divider">        
        

						<?php if(($this->session->userdata("id_perfil")) == 4) : ?>
							<a class="btn btn-outline-primary" href="<?= base_url() ?>Agenda/novo">Nova Agenda</a>					
						<?php else :?>
							
						<?php endif ?>	


		<br>
		<br>			
		<form id="frmAgendaPesquisa" method="post" action="<?= base_url() ?>Agenda/pesquisar">

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
				<div class="form-group col-md-6">
					<label for="Agenda">Agenda</label>
					<input type="text" class="form-control" id="dsAgenda" name="dsAgenda" maxlength="100">				
				</div>
				<div class="form-group col-md-6">
                  <label for="data">Data</label>
                     <input type="text" onkeyup="mascaraData(this);" class="form-control" id="txtdtagenda" name="txtdtagenda" maxlength="10" placeholder="DD/MM/AAAA">
                </div>
			</div>



			<button type="submit" class="btn btn-info" title="Realizar pesquisa">Pesquisar</button>
		</form>
		<br>
		<br>   							
		<h6 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Quantidade: <?php echo " " .count($listaAgendas);?></span></h6>
        <div class="row">
			<div class="container">
				<table class="table table-striped">
				  <tr>
					<th>Agenda</th>
					<th>Data</th>					
					<th></th>
				  </tr>
				  <?php foreach($listaAgendas as $item) : ?>
					<tr class>					  
					  <td><?= $item->ds_agenda; ?></td>					  
					  <td><?= $item->dt_agenda == Null ? "" : date("d/m/Y", strtotime($item->dt_agenda)); ?></td>
					  <td>

						<?php if(($this->session->userdata("id_perfil")) == 4) : ?>
								<a href="<?= base_url("Agenda/selecionar/". $item->id_agenda) ?>" title="Editar agenda" class="btn btn-primary btn-sm btn-group">Editar</a>
								<a href="<?= base_url("Agenda/excluir/". $item->id_agenda) ?>" title="Excluir agenda" class="btn btn-danger btn-sm btn-group" onclick="return confirm('Confirma a exclusão?');">Excluir</a>

						<?php else :?>
							<a href="<?= base_url("Agenda/selecionar/". $item->id_agenda) ?>" title="Editar agenda" class="btn btn-primary btn-sm btn-group">Visualizar</a>
						<?php endif ?>	

					  </td>
					</tr>
				<?php endforeach?>
				</table> 
			</div>                   
        </div>
	</div>

						
