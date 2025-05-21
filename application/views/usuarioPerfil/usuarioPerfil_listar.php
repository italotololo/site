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
      <!-- Listagem de usuario
      ================================================== -->
      <!-- . -->
      <div class="container marketing">
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">LISTAGEM DE USUÁRIO PERFIL</span></h3>
        <hr class="featurette-divider">
        
        <a class="btn btn-outline-primary" href="<?= base_url() ?>UsuarioPerfil/novo" >NOVO USUÁRIO PERFIL</a>
        <br>
        <br>
        <div class="row">
          <div class="container">          
            <table class="table table-striped">
              <tr>
                <th>CÓDIGO</th>
                <th>PERFIL</th>
                <th>OBSERVAÇÃO</th>
                <th></th>
              </tr>
              <?php foreach($listaUsuariosPerfil as $item) : ?>
                <tr>
                  <td><?= $item->cod_usuario_perfil; ?></td>                  
                  <td><?= $item->des_usuario_perfil; ?></td>
                  <td><?= $item->observacao; ?></td>
                  <td>
                    <a href="<?= base_url("UsuarioPerfil/selecionar/". $item->cod_usuario_perfil) ?>" title="Editar usuário perfil" class="btn btn-primary btn-sm btn-group">VISUALIZAR</a>
                    <a href="<?= base_url("UsuarioPerfil/excluir/". $item->cod_usuario_perfil) ?>" title="Excluir usuário perfil" class="btn btn-danger btn-sm btn-group" onclick="return confirm('Confirma a exclusão?');">EXCLUIR</a>
                  </td>
                </tr>
            <?php endforeach?>
            </table> 
          </div>                   
        </div>
      </div>
