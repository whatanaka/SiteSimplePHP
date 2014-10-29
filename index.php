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

  <?php require_once('menu.php'); 

  // Lista dos arquivos validosß
  $validos = array('home.php','empresa.php', 'produtos.php', 'servicos.php', 'contato.php', 'enviar.php');

  // Se $_GET[''] esta defido e se o valor faz parte da lista dos arquivos validos
  if (isset($_GET['arquivo']) AND (array_search($_GET['arquivo'], $validos) !== false)) {
    // Pega o valor da variável $_GET['arquivo']
    $arquivo = $_GET['arquivo'];
  } else {
    // Caso contrario, mostra a pagina principal
    $arquivo = 'home.php';
  }

  if (file_exists($arquivo ) ){
    require_once($arquivo); // Inclui o conteudo do arquivo
  } else {
    //Mensagem de quando houver algum problema na exibicao dos arquivos do sistema  
    echo '<div class="container">';
    echo '  <div class="jumbotron">';
    echo '    <p>Desculpe-nos, conteúdo não disponível no momento. Por favor, tente mais tarde.</p> ';
    echo '  </div>';
    echo '</div>';
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

