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
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Comunicados Cadastrados</span></h3>
        <hr class="featurette-divider">        


						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
							        <a class="btn btn-outline-primary" href="<?= base_url() ?>Comunicado/novo">Novo Comunicado</a>
						<?php else :?>
							
						<?php endif ?>	


		<br>
		<br>			
		<form id="frmComunicadoPesquisa" method="post" action="<?= base_url() ?>Comunicado/pesquisar">

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
					<label for="Comunicado">Comunicado</label>
					<input type="text" class="form-control" id="dsComunicado" name="dsComunicado" maxlength="100">				
				</div>
			</div>
			<button type="submit" class="btn btn-info" title="Realizar pesquisa">Pesquisar</button>
		</form>
		<br>
		<br>   							
		<h6 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Quantidade: <?php echo " " .count($listaComunicados);?></span></h6>
        <div class="row">
			<div class="container">
				<table class="table table-striped">
				  <tr>
					<th>Comunicado</th>	
					<th>Data</th>				
					<th></th>
				  </tr>
				  <?php foreach($listaComunicados as $item) : ?>
					<tr class>					  
					  <td><?= $item->ds_comunicado; ?></td>					  
					  <td><?= $item->dt_cadastro == Null ? "" : date("d/m/Y", strtotime($item->dt_cadastro)); ?></td>
					  <td>

						<?php if(($this->session->userdata("id_perfil")) == 4 || ($this->session->userdata("id_perfil")) == 3) : ?>
							<a href="<?= base_url("Comunicado/selecionar/". $item->id_comunicado) ?>" title="Editar comunicado" class="btn btn-primary btn-sm btn-group" >Editar</a>
							<a href="<?= base_url("Comunicado/excluir/". $item->id_comunicado) ?>" title="Excluir comunicado" class="btn btn-danger btn-sm btn-group" onclick="return confirm('Confirma a exclusão?');">Excluir</a>
						<?php else :?>
							<a href="<?= base_url("Comunicado/selecionar/". $item->id_comunicado) ?>" title="Editar comunicado" class="btn btn-primary btn-sm btn-group" >Visualizar</a>
						<?php endif ?>							
					  </td>
					</tr>
				<?php endforeach?>
				</table> 
			</div>                   
        </div>
	</div>
