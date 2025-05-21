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
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Cadastro de Usuário</span></h3>
        <hr class="featurette-divider">
        
        <div class="row">
          <div class="container"> 
            <form id="frmCadastroUsuario" method="post" action="<?= base_url() ?>Usuario/cadastrar">

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
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control" id="nome" name="nome" maxlength="70" aria-describedby="emailHelp" required="required" autofocus="autofocus">
                  <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
                </div>

                <div class="form-group col-md-6">
                  <label for="usuario">Usuário</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" maxlength="70" aria-describedby="emailHelp" required="required" autofocus="autofocus">
                  <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="senha">Senha</label>
                  <input type="password" class="form-control" id="senha" name="senha" maxlength="20" required="required">
                  <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
                </div>

               <div class="form-group col-md-6">
                  <label for="senha">Usuário Perfil</label>
                  <select id="selUsuarioPerfil" class="form-control" name="selUsuarioPerfil" required>
                    <option value="">Selecione</option>
                    <?php foreach ($listaUsuarioPerfis as $item) : ?>
                        <option value="<?= $item->id_perfil ?>"><?= $item->ds_perfil ?></option>
                    <?php endforeach ?>
                  </select>
                  <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
                </div>
             </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="celular">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" maxlength="11">                    
                </div>

                <div class="form-group col-md-6">
                  <label for="cpf">CPF do Responsável (caso o perfil seja de aluno(a))</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" aria-describedby="emailHelp" >
                    
                </div>
              </div>
              <br>
              <a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Usuario/listar">Voltar</a>
              <button type="submit" class="btn btn-info" title="Realizar cadastro">Salvar</button>
            </form>
          </div>                   
        </div>
      </div>
