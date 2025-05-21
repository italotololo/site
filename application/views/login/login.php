<?php defined('BASEPATH') OR exit ('No direct script access allowed'); ?>
<div class="container">
  <?php  if($this->session->flashdata("danger")) : ?>
		<p class="alert alert-danger"><?= $this->session->flashdata("danger") ?></p>
	<?php endif ?>
	
	<h4 class="form-signin-heading text-center">PONFAES</h4>
	<h5 class="form-signin-heading text-center">A ponte que transforma educação em parceria</h5>
	<br>
  <div class="text-center">
    <img src="<?= base_url("imagens/fotologoponfaes.png") ?>"  width="20%" height="20%" title="Ponfaes">
  </div>
  <br>
  
  <h4 class="form-signin-heading text-center"><!--Login--></h4>
  <div class="form-signin">
    <?php
      echo form_open("Login/autenticar");

      echo form_input(array(
        "name" => "usuario",
        "id" => "usuario",
        "class" => "form-control",
        "maxlength" => "70",
        "placeholder"=> "Usuário",
        "required" => "required",
        "autofocus" => "autofocus"  
      ));
?>

<h2 style="padding-bottom:5px;"></h2>

<?php
      echo form_password(array(
        "name" => "senha",
        "id" => "senha",
        "class" => "form-control",
        "maxlength" => "20",
        "placeholder"=> "Senha",
        "required" => "required"
      ));
    ?>

<!-- Lembrar senha comentado

    <div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me"> Lembrar senha
      </label>
    </div>
-->    
<h2 style="padding-bottom:5px;"></h2>

	<?php	
      echo form_button(array(
        "class" => "btn btn-lg btn-info btn-block",
        "type" => "submit",
        "content" => "Entrar"
      ));

		  echo form_close();
	?>
  </div>    
</div>