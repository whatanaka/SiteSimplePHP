    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="index.php?arquivo=home.php">WebSiteName</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
 <?php
          $home_ativo="";
          $empresa_ativo="";
          $produtos_ativo="";
          $servicos_ativo="";
          $contato_ativo="";
          if (isset($_GET['arquivo'])) 
          {
            switch ($_GET['arquivo']) {
              case "home.php":
                $home_ativo='class="active"';
                break;
              case "empresa.php":
                $empresa_ativo='class="active"';
                break;
              case "produtos.php":
                $produtos_ativo='class="active"';
                break;
              case "servicos.php":
                $servicos_ativo='class="active"';
                break;
              case "contato.php":
                $contato_ativo='class="active"';
                break;
              default:
                $home_ativo='class="active"';
            }
          } else {
            $home_ativo='class="active"';
          }
 
          echo '<li '.$home_ativo.'><a href="index.php?arquivo=home.php">Home</a></li>';
          echo '<li '.$empresa_ativo.'><a href="index.php?arquivo=empresa.php">Empresa</a></li>';
          echo '<li '.$produtos_ativo.'><a href="index.php?arquivo=produtos.php">Produtos</a></li>';
          echo '<li '.$servicos_ativo.'><a href="index.php?arquivo=servicos.php">Serviços</a></li>';
          echo '<li '.$contato_ativo.'><a href="index.php?arquivo=contato.php">Contato</a></li>';
 

          ?>
          </ul>
       </div>
      </div>
    </nav>
