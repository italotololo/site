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
        <h3 class="featurette-heading"><!--First featurette heading. --><span class="text-muted">Listagem de Usuários</span></h3>
        <hr class="featurette-divider">
        
        <a class="btn btn-outline-primary" href="<?= base_url() ?>Usuario/novo" >Novo Usuário</a>
        <br>
        <br>
        <div class="row">
          <div class="container">          
            <table class="table table-striped">
              <tr>
                <th>Código</th>
                <th>Usuário</th>
                <th>Perfil</th>
                <th></th>
              </tr>
              <?php foreach($listaUsuarios as $item) : ?>
                <tr class>
                  <td><?= $item->id_usuario; ?></td>
                  <td><?= $item->usuario; ?></td>
                  <td><?= $item->ds_perfil; ?></td>
                  <td>
                    <a href="<?= base_url("Usuario/selecionar/". $item->id_usuario) ?>" title="Editar usuário" class="btn btn-primary btn-sm btn-group">Editar</a>
                    <a href="<?= base_url("Usuario/excluir/". $item->id_usuario) ?>" title="Excluir usuário" class="btn btn-danger btn-sm btn-group" onclick="return confirm('Confirma a exclusão?');">Excluir</a>
                  </td>
                </tr>
            <?php endforeach?>
            </table> 
          </div>                   
        </div>
      </div>
