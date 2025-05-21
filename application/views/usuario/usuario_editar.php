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

      <!-- Editar usuario
      ================================================== -->
      <!-- . -->

      <div class="container marketing">
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Editar Usuário</span></h3>
        <hr class="featurette-divider">
        
        <div class="row">
          <div class="container"> 
            <form id="frmCadastroUsuario" method="post" action="<?= base_url() ?>Usuario/editar">
              <input type="hidden" id="hdnCodUsuario" name="hdnCodUsuario" value="<?= $dadosUsuario[0]->id_usuario; ?>">
              
              <div class="form-group">
                <label for="instituicao">Instituição</label>
                    <select id="selInstituicao" name="selInstituicao" class="form-control">
                      <option value='0'>Selecione</option>
                      <?php
                        foreach ($listaInstituicoes as $item){
                          $selected = $dadosUsuario[0]->id_instituicao == $item->id_instituicao ? 'selected=selected': '';
                          echo "<option value='{$item->id_instituicao}' {$selected}>{$item->ds_instituicao}</option>";
                        }      
                      ?>
                    </select>
                    <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
              </div>
              
              <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $dadosUsuario[0]->nome;?>" maxlength="70" aria-describedby="emailHelp" required="required" autofocus="autofocus">
                    <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
                  </div>
                                              
                  <div class="form-group col-md-6">
                    <label for="nome">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $dadosUsuario[0]->usuario;?>" maxlength="70" aria-describedby="emailHelp" required="required" autofocus="autofocus">
                    <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
                  </div>
              </div>



              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="senha">Celular</label>
                  <input type="text" class="form-control" id="celular" name="celular" value="<?= $dadosUsuario[0]->celular;?>" maxlength="11">
                </div>
               <div class="form-group col-md-6">
                  <label for="senha">Usuário Perfil</label>
                    <select id="selUsuarioPerfil" name="selUsuarioPerfil" class="form-control">
                      <option value='0'>Selecione</option>
                      <?php
                        foreach ($listaUsuarioPerfis as $item){
                          $selected = $dadosUsuario[0]->id_perfil == $item->id_perfil ? 'selected=selected': '';
                          echo "<option value='{$item->id_perfil}' {$selected}>{$item->ds_perfil}</option>";
                        }      
                      ?>
                    </select>
                    <small id="emailHelp" class="form-text text-muted">Campo obrigatório</small>
                </div>
             </div>

                <div class="form-row">
                  <label for="cpf">CPF do Responsável (caso o perfil seja de aluno(a))</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $dadosUsuario[0]->cpf;?>" maxlength="11" aria-describedby="emailHelp" >
                    
                </div>


              <br>
              <a class="btn btn-secondary" title="Voltar para tela anterior" href="<?= base_url() ?>Usuario/listar">Voltar</a>
              <button type="submit" class="btn btn-info" title="Realizar alteração">Salvar</button>
            </form>
          </div>                   
        </div>
      </div>
