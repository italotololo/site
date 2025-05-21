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
        <?php endif ?>
        <br>
      </div>

      <!-- Cadastro de usuario
      ================================================== -->
      <!-- . -->

      <div class="container marketing">
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">CADASTRO DE USUÁRIO PERFIL</span></h3>
        <hr class="featurette-divider">
        
        <div class="row">
          <div class="container"> 
            <form id="frmCadastroUsuarioPerfil" method="post" action="<?= base_url() ?>UsuarioPerfil/cadastrar">
              <div class="form-group">
                <label for="nome">USUÁRIO PERFIL</label>
                <input type="text" class="form-control" id="desUsuarioPerfil" name="desUsuarioPerfil" maxlength="20" aria-describedby="emailHelp" required="required" autofocus="autofocus">
                <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
              </div>
                           
              <div class="form-group">
                <label for="observacao">OBSERVAÇÃO</label>
                <input type="text" class="form-control" id="observacao" name="observacao" maxlength="100">
              </div>
              
              <br>
              <a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>UsuarioPerfil/listar">VOLTAR</a>
              <button type="submit" class="btn btn-info" title="Realizar cadastro">SALVAR</button>
            </form>
          </div>                   
        </div>
      </div>
