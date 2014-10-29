<div class="container">
		<h2>Dados enviados com sucesso!</h2>	
		<h3>Abaixo seguem os dados que você enviou:</h3>
<?php
	 	echo '<p><strong>Nome:</strong></p>';
	 	echo '<p>'.$_POST["nome"].'</p>';
	 	echo '<p><strong>Email:</strong></p>';
		echo '<p>'.$_POST["email"].'</p>';
	 	echo '<p><strong>Assunto:</strong></p>';
		echo '<p>'.$_POST["assunto"].'</p>';
	 	echo '<p><strong>Mensagem:</strong></p>';
		echo '<p>'.$_POST["mensagem"].'</p>';
?>
</div>



