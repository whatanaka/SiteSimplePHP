<!DOCTYPE html>
<html>
  <head>
    <title>Site Simples PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/SiteSimplesPHP.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
      <script src="bootstrap/js/respond.min.js"></script>
    <![endif]--> 
  </head>

  <body>

<?php 
  require_once('functions.php'); 
  
  //parse_url — Interpreta uma URL e retorna os seus componentes
  $rota=parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

  //separa o caminho pelo "/"
  $caminho=explode("/",$rota['path']);

  //seleciona o item de interesse
  /// Caso caminho for vazio, substituir por "home"
  $item =($caminho[1]=="") ? 'home':$caminho[1];

  $arquivo_existe = check_rota($item);
  if ($arquivo_existe != "") {
      require_once('menu.php'); 
      require_once($arquivo_existe); // Inclui o conteudo do arquivo
  } else {
      http_response_code(404);
      require_once("404.php");
  }
?>

<!-- Rodape -->
<div class="footer">
    <div class="container">
      <p class="text-center">Todos os direitos reservados - &copy; <?php date_default_timezone_set('UTC');echo date("Y");?></p>
    </div>
  </div>
  <script src="bootstrap/js/jquery-1.10.2.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

