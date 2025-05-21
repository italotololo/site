<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="<?= base_url() ?>js/popper.min.js.js"></script>
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?= base_url() ?>js/holder.min.js.js"></script>
     <script src="<?= base_url() ?>js/formatar.js"></script>
  </body>
</html>
<script>
/* nao mostrou o resultado html da model para fazer o dropdwn em cascata
	$(document).ready(function(){
		$('#selCodGrupo').change(function(){
			var country_id = $('#selCodGrupo').val();
			$.ajax({
				url:"<?php echo base_url(); ?>Pedido/listarPacote/" + encodeURIComponent(country_id),
				method:"POST",
				data:{cod_grupo:country_id},
				success:function(data)
				{
					alert(data);
					$('#selCodPacote').html(data);
				}
			});		
		});													
	});
*/
</script>

