<?php require_once("php/conexao/conexao.php"); ?>

<?php
		
		
		
  // Cadastro de imob
	if (isset ($_POST["bem"]) ) {
		$bem				=  utf8_decode ($_POST["bem"]);
		$descricao   		=  utf8_decode ($_POST["descricao"]);
		$revenda 			=  utf8_decode ($_POST["revendas"]);
		


        $inserir          = "INSERT INTO item ";
        $inserir         .= "(bem, descricao, revendaId ) " ;
        $inserir         .= "VALUES " ;
        $inserir         .= "(UCASE('$bem'), UCASE('$descricao'), UCASE('$revenda') )";
		
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if (!$operacao_inserir )  {
            die("Erro ao cadastrar no banco");
        }
        
    }
	
 // Seleção de revendas
    $select = "SELECT codigo, descricao ";
    $select .= "FROM revenda ";
    $lista_re = mysqli_query($conecta, $select);
    if (!$lista_re){
       die("Erro no banco");   
        
    }
	
?>