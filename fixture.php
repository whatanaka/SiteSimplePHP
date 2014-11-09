<?php

require_once('functions.php'); 

////////////////////////////////////////
///// CONEXAO COM O DB
///////////////////////////////////////
echo "#### Executando Fixture ####</br>";

$conn = conexaoDB();


////////////////////////////////////////
///// REMOVENDO TABELAS
///////////////////////////////////////
echo "Removendo tabela empresa";
$conn->query("DROP TABLE IF EXISTS empresa;");
echo " - OK</br>";

echo "Removendo tabela menu";
$conn->query("DROP TABLE IF EXISTS menu;");
echo " - OK</br>";

echo "Removendo tabela post";
$conn->query("DROP TABLE IF EXISTS post;");
echo " - OK</br>";

echo "Removendo tabela produtos";
$conn->query("DROP TABLE IF EXISTS produtos;");
echo " - OK</br>";


////////////////////////////////////////
///// CRIANDO TABELAS
///////////////////////////////////////

echo "Criando tabela empresa";
$conn->query("CREATE TABLE empresa (
  id int(11) NOT NULL AUTO_INCREMENT,
  figura varchar(200) NOT NULL,
  descricao blob NOT NULL,
  nome_empresa varchar(200) NOT NULL,
  endereco1 varchar(200) NOT NULL,
  endereco2 varchar(200) DEFAULT NULL,
  cidade varchar(200) DEFAULT NULL,
  estado varchar(200) DEFAULT NULL,
  Zip varchar(45) DEFAULT NULL,
  telefone varchar(11) DEFAULT NULL,
  email varchar(200) DEFAULT NULL,
  PRIMARY KEY (id)) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;");
echo " - OK</br>";

echo "Criando tabela menu";
$conn->query("CREATE TABLE menu (
  id int(11) NOT NULL AUTO_INCREMENT,
  rota varchar(45) NOT NULL,
  validade varchar(45) NOT NULL DEFAULT '1',
  arquivo varchar(45) NOT NULL,
  PRIMARY KEY (id)) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;");
echo " - OK</br>";

echo "Criando tabela post";
$conn->query("CREATE TABLE post (
  id int(11) NOT NULL AUTO_INCREMENT,
  cadastro datetime NOT NULL,
  autor varchar(45) DEFAULT NULL,
  status int(11) NOT NULL DEFAULT '1',
  titulo varchar(45) NOT NULL,
  corpo text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;");
echo " - OK</br>";

echo "Criando tabela produtos";
$conn->query("CREATE TABLE produtos (
  id int(11) NOT NULL,
  codigo varchar(45) NOT NULL,
  nome varchar(45) NOT NULL,
  link_imagem varchar(45) NOT NULL,
  titulo varchar(100) NOT NULL,
  descricao blob NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
echo " - OK</br>";


////////////////////////////////////////
///// INSERINDO DADOS NAS TABELAS
///////////////////////////////////////
echo "Inserindo dados na tabale empresa";
$smt = $conn->prepare("INSERT INTO empresa VALUES (1,'images/empresa.jpg','ULorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et odio quis augue ultricies viverra et et ex. Nullam vehicula tortor eget velit blandit, ultrices elementum sem eleifend. Vestibulum sit amet diam mattis, vulputate eros aliquet, accumsan massa. Fusce scelerisque, purus id viverra cursus, arcu arcu dignissim sapien, in congue ligula odio eget nunc. Proin vitae mauris aliquam, aliquet magna eu, aliquet felis. Sed interdum risus ante, sed interdum justo rhoncus at. Proin tristique tempor placerat. Donec accumsan consectetur nulla vitae elementum. Suspendisse potenti. Etiam placerat id massa ultricies elementum.\nAenean porttitor mauris eu lectus venenatis vestibulum. Curabitur ut nisi faucibus, vehicula lectus a, rhoncus est. Ut erat nunc, lobortis vel scelerisque a, suscipit vel ex. Cras tempor euismod metus, a porta augue molestie porttitor. Cras at quam ex. Aliquam vitae tristique massa. Pellentesque iaculis enim porttitor sem ultricies dignissim. Morbi eleifend hendrerit justo. Aliquam nec cursus lorem. Aenean volutpat purus a aliquet vulputate. Donec sit amet velit nec leo pretium gravida dapibus id odio. Aliquam facilisis vel velit a interdum.\n','Site Simples PHP, Inc.','Avenida XXXXXXXXX, 000\n\n','Enterprise Valley','Work City','Job State','999-9999','11122233','email@email.com');");
$smt->execute();
echo " - OK</br>";

echo "Inserindo dados na tabale menu";
$smt = $conn->prepare("INSERT INTO menu VALUES (1,'home','1','./templates/home.temp'),(2,'empresa','1','./templates/empresa.temp'),(3,'produtos','1','./templates/produtos.temp'),(4,'servicos','1','servicos.php'),(5,'contato','1','contato.php'),(6,'enviar','0','enviar.php'),(7,'pesquisa','0','pesquisa.php'),(8,'fixture','0','fixture.php');");
$smt->execute();
echo " - OK</br>";


echo "Inserindo dados na tabale post";
$smt = $conn->prepare("INSERT INTO post VALUES (1,'2014-11-01 12:22:05',NULL,1,'Curabitur dictum elementum pellentesque. Sed.','Sed pharetra quam nec accumsan tempor. Sed sollicitudin fringilla molestie. Aliquam vehicula convallis justo, sed blandit ligula faucibus vitae. Sed pulvinar, quam sit amet aliquet commodo, est tortor sollicitudin arcu, sit amet posuere tellus magna et leo. Nunc blandit ac ex ut fringilla. Vivamus eu dictum nulla. Aliquam suscipit, eros suscipit ultrices euismod, nisi est luctus magna, vel aliquet lacus tellus a tellus. Vestibulum tempus fringilla ipsum, ac efficitur lorem ultricies sed. Curabitur imperdiet sem non magna dignissim dignissim. Proin volutpat malesuada placerat. Nulla vitae purus eget metus malesuada dictum. Proin mollis, augue eu faucibus fringilla, arcu neque elementum lectus, vitae ultrices urna enim id ipsum.'),(2,'2014-10-15 23:59:00',NULL,1,'Integer vel odio vestibulum, auctor.','Integer sed orci tincidunt, faucibus leo et, venenatis tellus. Nullam interdum cursus euismod. Nullam posuere quam diam, vel pellentesque tellus scelerisque a. Ut eu finibus metus. Proin ullamcorper mattis posuere. Sed erat elit, hendrerit sed purus a, tincidunt volutpat ligula. Cras et risus elementum, hendrerit sem id, mollis urna. Praesent condimentum sit amet dui et cursus. Integer vehicula ex et ipsum commodo, id blandit eros pharetra. Interdum et malesuada fames ac ante ipsum primis in faucibus.'),(3,'2014-01-20 20:00:55',NULL,1,'Vestibulum ante ipsum primis in.','Aenean elementum, eros ut bibendum eleifend, sapien lorem pulvinar arcu, vel fringilla ex turpis ac libero. Praesent non congue lacus, consequat vestibulum justo. Donec id quam et tellus maximus rhoncus ut vel tellus. Duis commodo eleifend purus non volutpat. Proin varius lorem at massa rutrum varius. Nam sit amet risus accumsan, tincidunt eros et, sodales nulla. Fusce eleifend ut magna in faucibus. Aenean eget augue lectus. Sed et sodales purus. Curabitur egestas mattis massa id tempus. Mauris at lorem vel nisl vestibulum sagittis. Nunc lorem tellus, tincidunt in velit in, faucibus ultrices neque. Proin sed ligula id ligula lobortis eleifend vitae at sapien. Suspendisse nec elit elit. Phasellus fringilla velit quis ipsum malesuada facilisis. Curabitur placerat arcu eu scelerisque sagittis.');");
$smt->execute();
echo " - OK</br>";


echo "Inserindo dados na tabale produtos";
$smt = $conn->prepare("INSERT INTO produtos VALUES (1,'0001','Bio-Matic Fingerprint Door Lock ','images/produto1.jpg','iTouchless Bio-Matic Fingerprint Door Lock For Right Hand Door','Donec justo risus, varius ac nisi tincidunt, iaculis euismod tortor. Suspendisse bibendum ligula a nulla porttitor cursus. Donec tincidunt nisl non rhoncus congue. Nam at sem quis diam cursus sagittis laoreet sit amet ipsum. Etiam justo diam, tristique sed est non, elementum iaculis risus. Aliquam tempus elementum mi, nec sodales mauris commodo vel. Sed vitae tempus ligula, vitae sollicitudin diam. Morbi cursus maximus diam. Nam porta, magna quis laoreet tincidunt, turpis ipsum egestas mauris, non vulputate massa felis sed ligula.'),(2,'0002','BackJoy’s Pillow & Chair','images/produto2.png','Every Startup Founders’ Sweet Dream: BackJoy’s Pillow & Chair','Morbi convallis velit sed dolor elementum, sollicitudin consequat turpis tempor. Integer auctor arcu non turpis faucibus convallis. Nam ut ipsum elit. Nunc sed erat ante. Integer molestie neque lacus, nec luctus ipsum lobortis quis. Praesent in dolor efficitur, dictum mauris hendrerit, faucibus urna. Phasellus sed efficitur metus. Suspendisse quis aliquet sem. Vivamus non fringilla leo.'),(3,'0003','RECON JET','images/produto3.jpg','RECON JET','Proin sed scelerisque elit. Sed nec commodo massa, id fringilla neque. Pellentesque bibendum dui augue, in vulputate velit tincidunt a. Suspendisse sed risus ut tortor pharetra finibus a eu orci. Donec fermentum, nibh ut porttitor hendrerit, arcu metus convallis enim, eu laoreet risus nisl vitae augue. Integer tincidunt tristique mi, vel commodo ante. Nam quis posuere elit. Ut eget urna at metus accumsan fringilla. Fusce vitae tortor mauris. Phasellus viverra et enim quis commodo. Integer vitae accumsan metus. Etiam rhoncus dui sed quam vehicula venenatis. Proin posuere ipsum in eros posuere, vel tincidunt magna lobortis.'),(4,'0004','Future Smartphones','images/produto4.jpeg','Future Smartphones Transform Into Trendy Wristwatches','Nulla eu felis id odio consequat pellentesque rutrum eu purus. Ut at dolor lorem. Pellentesque non purus leo. Maecenas euismod, libero ut ullamcorper molestie, arcu tellus pulvinar risus, id congue augue est ac velit. Nam sagittis ante semper ligula egestas blandit. Mauris eleifend purus mollis enim interdum aliquam. Cras porttitor eu augue in suscipit. Quisque in cursus ante, non imperdiet felis. Sed lacus velit, tincidunt id nulla eu, elementum interdum mauris. Morbi nec neque nibh. Sed sed turpis vel mi eleifend euismod sed vitae purus. Aenean rhoncus metus ante, ut aliquet dui fermentum blandit. Nullam eu convallis tortor. Praesent sollicitudin urna tortor, nec hendrerit erat pellentesque eget.');");
$smt->execute();
echo " - OK</br>";


////////////////////////////////////////
///// FIM
///////////////////////////////////////
echo "#### CONCLUIDO ####\n";


