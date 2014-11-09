<?php
// Funcao para realizar a conexao com o Banco de dados
function conexaoDB(){

	try{
		$config = include "config.php";

		if (!isset($config['db'])){
			throw new \InvalidArgumentException("Configuração do banco de dados não existe!!");
		}

		$host= (isset($config['db']['host'])) ? $config['db']['host'] : null;
		$dbname= (isset($config['db']['dbname'])) ? $config['db']['dbname'] : null;
		$user= (isset($config['db']['user'])) ? $config['db']['user'] : null;
		$password= (isset($config['db']['password'])) ? $config['db']['password'] : null;

		return new \PDO("mysql:host={$host};dbname={$dbname}",$user,$password);


	}catch(\PDOException $e){
		echo $e->getMessager()."\n";
		echo $e->getTraceString()."\n";

	}
}

// Monta e retorna um array com as opções e arquivos/templates do array
function get_arrayMenu(){
	// Numero na frente do nome da rota valida significa:
	//   1 = Aparece como item no menu principal
	//   0 = Nao aparacer como item no menu principal, mas eh uma rota valida 
	$conn = conexaoDB();
	$sql="Select * from menu";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$menu=$stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach($menu as $item){
		$array_menu[$item['validade'].$item['rota']] = $item['arquivo'];
    }

	return $array_menu;
 
}

// Checa que a rota digitada pelo usuario é válida ou não
function check_rota($caminho){
  $item_menu=get_arrayMenu();
  $menu_arquivo="";
  array_walk($item_menu,function($arquivo,$rota) use (&$menu_arquivo,$caminho) {
	if (substr($rota,1)==$caminho) {
		if (file_exists($arquivo) ){
			$menu_arquivo= $arquivo;
		} 
	}
   });
  return $menu_arquivo;

}

// Monta e retorna a parte do menu
function view_menu($item_escolhido){
	$item_menu=get_arrayMenu();
	$menu_horizontal="";
	
	array_walk($item_menu,function($arquivo,$rota) use (&$menu_horizontal,$item_escolhido) {
			if (substr($rota,0,1)=="1"){
			    if (substr($rota,1)==$item_escolhido) {
			  		$menu_horizontal.= '<li class="active"><a href="/'.substr($rota,1).'">'.substr($rota,1).'</a></li>';
			    } else {
			  		$menu_horizontal.= '<li> <a  href="/'.substr($rota,1).'">'.substr($rota,1).'</a></li>';
			    }
			}
		}
	);

	$template_conteudo = read_template("menu.temp");
	$substituir=array("###CONTEUDO###");
	$por=array("$menu_horizontal");
	$home_page= str_ireplace($substituir,$por,$template_conteudo);

	return $home_page;
}
// Monta e retona a parte correspondente da HOME
function view_home(){
	//Configura a timezone padrão a ser utilizada por todas as funções de data e hora em um script
	date_default_timezone_set('UTC');
	// Conecta-se com o banco de dados
	$conn = conexaoDB();
	$sql="Select * from post";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);

	$conteudo="";
	// Le os posts do banco de dados
	foreach($posts as $item){
		$timestamp = strtotime($item['cadastro']); // Gera o timestamp de $data_mysql
		$conteudo.='	<div class="col-md-4">
							<h2>'.$item['titulo'].'</h2>'.
							'<p>'.date('d/m/Y H:i:s', $timestamp).'</p>'.
						    '<p>'.$item['corpo'].'</p></div>'; 
    }

    // carrega o conteudo da template
	$template_conteudo = read_template("home.temp");

	// Tags a serem substituidas
	$substituir=array("###CONTEUDO###");

	// Valores que substituirao as tags acima
	$por=array("$conteudo");

	// Processo de substituicao
	$home_page= str_ireplace($substituir,$por,$template_conteudo);

	// Retorna a pagina pronta
	return $home_page;
}

// Monta e retona a parte correspondente da EMPRESA
function view_empresa(){
	// Conecta com o banco de dados
	$conn = conexaoDB();
	$sql="Select * from empresa";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$empresa=$stmt->fetch(PDO::FETCH_ASSOC);

    //carrega o conteudo do template
	$template_conteudo = read_template("empresa.temp");

	// Itens a serem substituidos
	$substituir=array("##FOTO_EMPRESA##","##DESCRICAO_EMPRESA##","##NOME_EMPRESA##",
		              "##ENDERECO1_EMPRESA##","##ENDERECO2_EMPRESA##","##CIDADE_EMPRESA##",
		              "##ESTADO_EMPRESA##","##ZIP_EMPRESA##","##TEL_EMPRESA##","##EMAIL_EMPRESA##");

	// Itens que substituirao as tags acima
	$por=array($empresa['figura'],$empresa['descricao'],$empresa['nome_empresa'],$empresa['endereco1'],
		$empresa['endereco2'],$empresa['cidade'],$empresa['estado'],$empresa['Zip'],
		$empresa['telefone'],$empresa['email']);

	// Processo de substituicao
	$home_page= str_ireplace($substituir,$por,$template_conteudo);

	// retorna a pagina pronta
	return $home_page;
}

// Monta e retorna a parte correspondente dos PRODUTOS
function view_produtos(){
	// Conecta com o banco de dados
	$conn = conexaoDB();
	$sql="Select * from produtos";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$produtos=$stmt->fetchALL(PDO::FETCH_ASSOC);
	$conteudo="";
	// apos $coluna=2 muda de linha
	$coluna=0;
	foreach($produtos as $produto){
		if ($coluna==0){			
			$conteudo.='<div class="row">';
		}
		//if ($coluna<=2) {
		$conteudo.='<div class="col-md-6">';
		$conteudo.='<img src="'.$produto['link_imagem'].'" class="img-polaroid" height="100">';  
        $conteudo.='<h2>'.$produto['titulo'].'</h2>'; 
        $conteudo.='<p>'.$produto['descricao'].'</p>';      
        $conteudo.='</div>';
		$coluna+=1;
	    if ($coluna>1)  {
	        $conteudo.='</div>';
	        $conteudo.='<div class="clearfix visible-lg"></div>';
	    	$coluna=0;
	    }
	}
	// carrega o conteudo da template
	$template_conteudo = read_template("produtos.temp");

	// Tags a serem substituidas
	$substituir=array("###CONTEUDO###");

	// Valores que substituirao as tags acima
	$por=array("$conteudo");

	// Processo de substituicao
	$home_page= str_ireplace($substituir,$por,$template_conteudo);

	// Retorna a pagina pronta
	return $home_page;
}

//Carrega o conteudo das templates das paginas 
function read_template($template_name){
	$filename = "./templates/".$template_name;
	$handle = fopen ($filename, "r");
	$conteudo = fread ($handle, filesize ($filename));
	fclose ($handle);
	return $conteudo;
}

//Pesquisa por palavras
function pesquisa($palavra_chave){
	// Conecta com o banco de dados
	$conn = conexaoDB();

	// POST-TITULO
	$sql_post_titulo="Select * from post where titulo like '%".$palavra_chave."%'";
	$stmt=$conn->prepare($sql_post_titulo);
	$stmt->execute();
	$resultados_post = $stmt->fetchALL(PDO::FETCH_ASSOC);
	foreach ($resultados_post as $post) {
		$texto = destaca_palavra($palavra_chave, $post['titulo']);
		$resultado_array[]= array("pagina"=>"home","conteudo"=>$texto);
	}
	
	// POST-CORPO
	$sql_post_corpo="Select * from post where corpo like '%".$palavra_chave."%'";
	$stmt=$conn->prepare($sql_post_corpo);
	$stmt->execute();
	$resultados_post = $stmt->fetchALL(PDO::FETCH_ASSOC);
	foreach ($resultados_post as $post) {
		$texto = destaca_palavra($palavra_chave,  $post['corpo']);
		$resultado_array[]= array("pagina"=>"home","conteudo"=>$texto);
	}

	// PRODUTOS-NOME
	$sql_produtos_nome="Select * from produtos where nome like '%".$palavra_chave."%'";
	$stmt=$conn->prepare($sql_produtos_nome);
	$stmt->execute();
	$resultados_produtos = $stmt->fetchALL(PDO::FETCH_ASSOC);
	foreach ($resultados_produtos as $produto) {
		$texto = destaca_palavra($palavra_chave, $produto['nome']);
		$resultado_array[]= array("pagina"=>"produtos","conteudo"=>$texto);
	}

	// PRODUTOS-TITULO
	$sql_produtos_titulo="Select * from produtos where titulo like '%".$palavra_chave."%'";
	$stmt=$conn->prepare($sql_produtos_titulo);
	$stmt->execute();
	$resultados_produtos = $stmt->fetchALL(PDO::FETCH_ASSOC);
	foreach ($resultados_produtos as $produto) {
		$texto = destaca_palavra($palavra_chave, $produto['titulo']);
		$resultado_array[]= array("pagina"=>"produtos","conteudo"=>$texto);
	}

	// PRODUTOS-DESCRICAO
	$sql_produtos_descr="Select * from produtos where descricao like '%".$palavra_chave."%'";
	$stmt=$conn->prepare($sql_produtos_descr);
	$stmt->execute();
	$resultados_produtos = $stmt->fetchALL(PDO::FETCH_ASSOC);
	foreach ($resultados_produtos as $produto) {
		$texto = destaca_palavra($palavra_chave, $produto['descricao']);
		$resultado_array[]= array("pagina"=>"produtos","conteudo"=>$texto);
	}

 return $resultado_array;
}
function destaca_palavra($palavra_chave,$texto){

	$texto=str_ireplace($palavra_chave, "</small><strong>".$palavra_chave."</strong><small>", $texto);
	$texto="<small>".$texto."</small>";
	return $texto;
}

?>