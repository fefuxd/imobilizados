<?php

	
	// Conectar no banco
	$pdo=conecta();
	

	if($acesso < 1) {
	
	// Contador de Itens do SELECT da revenda selecionada
	// Contador do Departamento ADMINISTRACAO
	
	if($dptoUser == "ADMINISTRACAO"){
	$centroDeCusto = "500";
	$var2 = $rev_teste;
	
	$sql = "SELECT count(bem.bem) as conte FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :contador AND bem.CENTRO_CUSTO LIKE :cc 
	AND baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null	"; 
	$result = $pdo->prepare($sql); 
	$result->bindValue(':contador', '%' . $var2 . '%', PDO::PARAM_STR);
	$result->bindValue(':cc', '%' . $centroDeCusto . '%', PDO::PARAM_STR);
	$result->execute(); 
	$number_of_rows = $result->fetchColumn();
	}
	
	
	
	
	// Contador do Departamento VENDAS - CORP - SEMINOVOS - FI
	
	if($dptoUser == "VENDAS"){
	$centroDeCustoNovos  = "100";
	$centroDeCustoCorp   = "101";
	$centroDeCustoUsados = "200";
	$centroDeCustoFi	 = "600";
	$var2 = $rev_teste;
	
	$sql = "SELECT count(bem.bem) as conte FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :contador AND (bem.CENTRO_CUSTO LIKE :cc OR bem.CENTRO_CUSTO LIKE :cc2 OR bem.CENTRO_CUSTO LIKE :cc3 OR bem.CENTRO_CUSTO LIKE :cc4) 
	AND baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null	"; 
	$result = $pdo->prepare($sql); 
	$result->bindValue(':contador', '%' . $var2 . '%', PDO::PARAM_STR);
	$result->bindValue(':cc', '%'  . $centroDeCustoNovos . '%', PDO::PARAM_STR);
	$result->bindValue(':cc2', '%' . $centroDeCustoCorp . '%', PDO::PARAM_STR);
	$result->bindValue(':cc3', '%' . $centroDeCustoUsados . '%', PDO::PARAM_STR);
	$result->bindValue(':cc4', '%' . $centroDeCustoFi . '%', PDO::PARAM_STR);
	$result->execute(); 
	$number_of_rows = $result->fetchColumn();
	}
	
	
	// Contador do Departamento PECAS
	
	if($dptoUser == "PECAS"){
	$centroDeCusto = "300";
	$var2 = $rev_teste;
	
	$sql = "SELECT count(bem.bem) as conte FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :contador AND bem.CENTRO_CUSTO LIKE :cc 
	AND baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null	"; 
	$result = $pdo->prepare($sql); 
	$result->bindValue(':contador', '%' . $var2 . '%', PDO::PARAM_STR);
	$result->bindValue(':cc', '%' . $centroDeCusto . '%', PDO::PARAM_STR);
	$result->execute(); 
	$number_of_rows = $result->fetchColumn();
	}
	
	
	// Contador do Departamento AT - FUNILARIA - ACESSORIOS
	
	if($dptoUser == "AT"){
	$centroDeCustoAt  = "400";
	$centroDeCustoFunilaria   = "401";
	$centroDeCustoAcessorios = "301";
	
	$var2 = $rev_teste;
	
	$sql = "SELECT count(bem.bem) as conte FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :contador AND (bem.CENTRO_CUSTO LIKE :cc OR bem.CENTRO_CUSTO LIKE :cc2 OR bem.CENTRO_CUSTO LIKE :cc3) 
	AND baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null	"; 
	$result = $pdo->prepare($sql); 
	$result->bindValue(':contador', '%' . $var2 . '%', PDO::PARAM_STR);
	$result->bindValue(':cc', '%'  . $centroDeCustoAt . '%', PDO::PARAM_STR);
	$result->bindValue(':cc2', '%' . $centroDeCustoFunilaria . '%', PDO::PARAM_STR);
	$result->bindValue(':cc3', '%' . $centroDeCustoAcessorios . '%', PDO::PARAM_STR);
	
	$result->execute(); 
	$number_of_rows = $result->fetchColumn();
	}
	
	
	//FIM DOS CONTADORES
	
	
	
	
	// Consulta os itens da tabela CONTA PATRIMONIAL para popular o select(form) 
	
		$var1 = $rev_teste;
		$query = ("SELECT REVENDA, CONTA_PATRIMONIAL, DES_CONTA_PATRIMONIAL FROM AFX_CONTA_PATRIMONIAL WHERE REVENDA like :rev "); 
		$stmt3 = $pdo->prepare($query);
		$stmt3->bindValue(':rev', '%' . $var1 . '%', PDO::PARAM_STR);
		$stmt3->execute();
	
	// ----------------------- FIM DA CONSULTA PARA O FORM ---------
	
	
	
	
	// INICIO DA CONSULTA GERAL NA TABELA PARA A REVENDA ADMINISTRACAO
	
	if($dptoUser == "ADMINISTRACAO"){
	
	$var1 = $rev_teste;@	
	$var2 = $_GET["bemdesc"];@
	$var3 = $_GET["bemdesc"];@
	$var4 = $_GET["contaPatrimonial"];@
	$centroCustoAdm = "500";


	$query = (" SELECT  bem.bem, LEFT(bem.des_bem,20) as des_bem, bem.revenda, bem.CONTA_PATRIMONIAL, bem.AGREGADO FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :rev  AND ( bem.des_bem LIKE :bd OR bem.bem LIKE :bd2 ) AND CONTA_PATRIMONIAL like :cp AND CENTRO_CUSTO like :cc AND
	baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null
	ORDER BY des_bem "); 
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':rev' , '%' . $var1 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd'  , '%' . $var2 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd2' , '%' . $var3 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cp'  , '%' . $var4 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cc'  , '%' . $centroCustoAdm . '%' , PDO::PARAM_STR);
	$stmt->execute();	
	
	}
	
	
	// INICIO DA CONSULTA GERAL NA TABELA PARA A REVENDA VENDAS
	
	if($dptoUser == "VENDAS"){
	
	$var1 = $rev_teste;@	
	$var2 = $_GET["bemdesc"];@
	$var3 = $_GET["bemdesc"];@
	$var4 = $_GET["contaPatrimonial"];@
	$centroDeCustoNovos  = "100";
	$centroDeCustoCorp   = "101";
	$centroDeCustoUsados = "200";
	$centroDeCustoFi	 = "600";


	$query = (" SELECT  bem.bem, LEFT(bem.des_bem,20) as des_bem, bem.revenda, bem.CONTA_PATRIMONIAL, bem.AGREGADO FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :rev  AND ( bem.des_bem LIKE :bd OR bem.bem LIKE :bd2 ) AND CONTA_PATRIMONIAL like :cp AND (CENTRO_CUSTO
	like :cc OR bem.CENTRO_CUSTO LIKE :cc2 OR bem.CENTRO_CUSTO LIKE :cc3 OR bem.CENTRO_CUSTO LIKE :cc4) 
	AND	baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null
	ORDER BY des_bem "); 
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':rev' , '%' . $var1 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd'  , '%' . $var2 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd2' , '%' . $var3 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cp'  , '%' . $var4 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cc', '%'  . $centroDeCustoNovos . '%', PDO::PARAM_STR);
	$stmt->bindValue(':cc2', '%' . $centroDeCustoCorp . '%', PDO::PARAM_STR);
	$stmt->bindValue(':cc3', '%' . $centroDeCustoUsados . '%', PDO::PARAM_STR);
	$stmt->bindValue(':cc4', '%' . $centroDeCustoFi . '%', PDO::PARAM_STR);
	$stmt->execute();	
	
	}
	
	
	// INICIO DA CONSULTA GERAL NA TABELA PARA A REVENDA PECAS
	
	if($dptoUser == "PECAS"){
	
	$var1 = $rev_teste;@	
	$var2 = $_GET["bemdesc"];@
	$var3 = $_GET["bemdesc"];@
	$var4 = $_GET["contaPatrimonial"];@
	$centroCustoPecas = "300";


	$query = (" SELECT  bem.bem, LEFT(bem.des_bem,20) as des_bem, bem.revenda, bem.CONTA_PATRIMONIAL, bem.AGREGADO FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :rev  AND ( bem.des_bem LIKE :bd OR bem.bem LIKE :bd2 ) AND CONTA_PATRIMONIAL like :cp AND CENTRO_CUSTO like :cc AND
	baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null
	ORDER BY des_bem "); 
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':rev' , '%' . $var1 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd'  , '%' . $var2 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd2' , '%' . $var3 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cp'  , '%' . $var4 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cc'  , '%' . $centroCustoPecas . '%' , PDO::PARAM_STR);
	$stmt->execute();	
	
	}	



	// INICIO DA CONSULTA GERAL NA TABELA PARA A REVENDA AT
	
	if($dptoUser == "AT"){
	
	$var1 = $rev_teste;@	
	$var2 = $_GET["bemdesc"];@
	$var3 = $_GET["bemdesc"];@
	$var4 = $_GET["contaPatrimonial"];@
	$centroDeCustoAt  = "400";
	$centroDeCustoFunilaria   = "401";
	$centroDeCustoAcessorios = "301";


	$query = (" SELECT  bem.bem, LEFT(bem.des_bem,20) as des_bem, bem.revenda, bem.CONTA_PATRIMONIAL, bem.AGREGADO FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :rev  AND ( bem.des_bem LIKE :bd OR bem.bem LIKE :bd2 ) AND CONTA_PATRIMONIAL like :cp AND (CENTRO_CUSTO
	like :cc OR bem.CENTRO_CUSTO LIKE :cc2 OR bem.CENTRO_CUSTO LIKE :cc3) 
	AND	baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null
	ORDER BY des_bem "); 
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':rev' , '%' . $var1 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd'  , '%' . $var2 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd2' , '%' . $var3 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cp'  , '%' . $var4 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cc', '%'  . $centroDeCustoAt . '%', PDO::PARAM_STR);
	$stmt->bindValue(':cc2', '%' . $centroDeCustoFunilaria . '%', PDO::PARAM_STR);
	$stmt->bindValue(':cc3', '%' . $centroDeCustoAcessorios . '%', PDO::PARAM_STR);
	$stmt->execute();	
	
	}
	
	// FIM DAS CONSULTAS GERAIS POR REVENDA DO ACESSO = 0
	
}
	

	// INICIO DAS CONSULTAS PARA ACESSO = 1
	
	if ($acesso > 0) {	
	
	// Contador de Itens do SELECT da revenda selecionada
	if ( isset($_GET["revenda"])  ) {
	$var2 = $_GET["revenda"];
	$sql = "SELECT count(bem.bem) as conte FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :contador
	AND baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null	"; 
	$result = $pdo->prepare($sql); 
	$result->bindValue(':contador', '%' . $var2 . '%', PDO::PARAM_STR);
	$result->execute(); 
	$number_of_rows = $result->fetchColumn();
	}
	
	// ----------------- FIM DO CONTADOR ------------------------
	
		
	// Consulta os itens da tabela CONTA PATRIMONIAL para popular o select(form) 
	if ( isset($_GET["revenda"]) ) {
		$var1 = $_GET["revenda"];
		$query = ("SELECT REVENDA, CONTA_PATRIMONIAL, DES_CONTA_PATRIMONIAL FROM AFX_CONTA_PATRIMONIAL WHERE REVENDA like :rev "); 
		$stmt3 = $pdo->prepare($query);
		$stmt3->bindValue(':rev', '%' . $var1 . '%', PDO::PARAM_STR);
		$stmt3->execute();
	}
	// ----------------------- FIM DA CONSULTA PARA O FORM ---------
	
	
	// Consulta os itens da tabela CENTRO DE CUSTO para popular o select(form) 
	if ( isset($_GET["revenda"]) ) {
		$var1 = $_GET["revenda"];
		$query = ("SELECT REVENDA, CENTRO_CUSTO, DES_CENTRO_CUSTO FROM CTB_CENTRO_CUSTO WHERE REVENDA like :rev "); 
		$stmt4 = $pdo->prepare($query);
		$stmt4->bindValue(':rev', '%' . $var1 . '%', PDO::PARAM_STR);
		$stmt4->execute();
	}
	// ----------------------- FIM DA CONSULTA PARA O FORM ---------
	
	
	// Consulta os itens da tabela REVENDA para popular o select(form)
	$stmt2=$pdo->prepare("SELECT REVENDA, RAZAO_SOCIAL FROM GER_REVENDA");
	$stmt2->execute();
	
	// -----------------------FIM DA CONSULTA PARA O FORM------------
	
	// CONSULTA GERAL COM TODOS OS FILTROS
	
	
	if ( isset($_GET["revenda"])  ) {
	
	$var1 = $_GET["revenda"];@	
	$var2 = $_GET["bemdesc"];@
	$var3 = $_GET["bemdesc"];@
	$var4 = $_GET["contaPatrimonial"];@
	$var5 = $_GET["centroCusto"];@



	$query = (" SELECT  bem.bem, LEFT(bem.des_bem,20) as des_bem, bem.revenda, bem.CONTA_PATRIMONIAL, bem.AGREGADO FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :rev  AND ( bem.des_bem LIKE :bd OR bem.bem LIKE :bd2 ) AND CONTA_PATRIMONIAL like :cp AND CENTRO_CUSTO like :cc AND
	baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null
	ORDER BY des_bem "); 
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':rev' , '%' . $var1 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd'  , '%' . $var2 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd2' , '%' . $var3 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cp'  , '%' . $var4 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cc'  , '%' . $var5 . '%' , PDO::PARAM_STR);
	$stmt->execute();	
	}
	
	
	
	// ------------------------ FIM DA CONSULTA GERAL PARA ACESSO = 1 ----------------------
}
?>