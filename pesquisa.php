<div class="container">
<?php

	echo "<h1>Pesquisa</h1>";
	echo "<p>Resultado sobre: <strong>".$_POST["chave"]."</strong></p>";
	$resultados = pesquisa($_POST["chave"]);
?>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Link</th>
      <th>Local</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	$contador=0;
  	foreach ($resultados as $item) {
  		echo "<tr>";
  		$contador+=1;
      	echo "<td>".$contador."</td>";
		echo "<td><a href=http://".$_SERVER['HTTP_HOST']."/".$item['pagina'].">".$item['pagina']."</td>";
		echo "<td>".$item['conteudo']."</td>";
    	echo "</tr>";
	}
?>
  </tbody>
</table> 
</div>