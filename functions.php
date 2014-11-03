<?php
function get_arrayMenu(){
	// Numero na frente do nome da rota valida significa:
	//   1 = Aparece como item no menu principal
	//   0 = Nao aparacer como item no menu principal, mas eh uma rota valida 
	$array_menu = array( "1home" => "home.php",
			             "1empresa" => "empresa.php",
			             "1produtos" => "produtos.php",
			             "1servicos" => "servicos.php",
			             "1contato" => "contato.php",
			             "0enviar" => "enviar.php"
	                   );
	return $array_menu;
 
}

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

function cria_menu_horizontal($item_escolhido){
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
   });
  return $menu_horizontal;

}
?>