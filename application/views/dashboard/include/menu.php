<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?= base_url() ?>DashBoard/index"><!--SECRETARIA--></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				
				<li class="nav-item"> <!--active-->
				  <a class="nav-link" href="<?= base_url() ?>DashBoard/index">Home<span class="sr-only"></span></a>
				</li>
				
				<?php if(($this->session->userdata("id_perfil")) == 4) : ?> <!-- Diretor(a) -->									
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Comunicado/listar">Comunicado</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Boletim/listar">Boletim</a>
					</li>					
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Frequencia/listar">Frequência</a>
					</li>					
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Agenda/listar">Agenda</a>
					</li>										
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Usuario/listar">Usuário</a>
					</li>									
				<?php endif ?>


				<?php if(($this->session->userdata("id_perfil")) == 3) : ?> <!-- Professor(a) -->					 
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Comunicado/listar">Comunicado</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Boletim/listar">Boletim</a>
					</li>					
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Frequencia/listar">Frequência</a>
					</li>
					
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Agenda/listar">Agenda</a>
					</li>										
					

				<?php endif ?>
								
				<?php if(($this->session->userdata("id_perfil")) == 2 || ($this->session->userdata("id_perfil")) == 1) : ?> <!-- Responsavel(a) / Aluno -->
					  <a class="nav-link" href="<?= base_url() ?>Comunicado/listar">Comunicado</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Boletim/listar">Boletim</a>
					</li>					
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Frequencia/listar">Frequência</a>
					</li>											
					
					<li class="nav-item">
					  <a class="nav-link" href="<?= base_url() ?>Agenda/listar">Agenda</a>
					</li>										


				<?php endif ?>

				<li class="nav-item">
				  <a class="nav-link" href="<?= base_url() ?>Login/logout">Sair</a>
				</li>
			</ul>
			<div class="btn-outline-info my-2 my-sm-0">
				<!--Usuário logado:--> <?= $this->session->userdata("nome")." - ".$this->session->userdata("ds_perfil") ?>			
			</div>          
        </div>
    </nav>
	</header>
