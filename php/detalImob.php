<?php

$pdo=conecta();
	if ( isset($_GET["codigo"])  ) {
	$cod = $_GET["codigo"];
	$rev = $_GET["revenda"];
	$agreg = $_GET["agregado"];
	
	$query = ("SELECT  be.REVENDA, be.BEM, be.AGREGADO, cl.NOME, be.DES_BEM, be.NUMERO_NOTA_FISCAL, be.SERIE_NOTA_FISCAL, be.FORNECEDOR, be.DTA_AQUISICAO, be.DTA_MOVIMENTO, be.VAL_ORIGINAL, be.CONTA_PATRIMONIAL, be.CENTRO_CUSTO, ce.DES_CENTRO_CUSTO, co.DES_CONTA_PATRIMONIAL, be.LOCAL, be.CALCULA_PIS, be.CALCULA_COFINS, be.DTA_PROCESSAMENTO, be.PLAQUETA FROM AFX_BEM be INNER JOIN CTB_CENTRO_CUSTO ce ON be.CENTRO_CUSTO = ce.CENTRO_CUSTO INNER JOIN AFX_CONTA_PATRIMONIAL co ON be.CONTA_PATRIMONIAL = co.CONTA_PATRIMONIAL INNER JOIN FAT_CLIENTE cl ON cl.CLIENTE = be.FORNECEDOR WHERE be.BEM = :bem and be.REVENDA = :revenda and be.AGREGADO = :agregado ;"); 
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':bem', $cod);
	$stmt->bindValue(':revenda', $rev);
	$stmt->bindValue(':agregado', $agreg);
	$stmt->execute();
	
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	foreach($result as $item){
	$revenda				 = $item["REVENDA"];
	$bem 					 = $item["BEM"];
	$agregado 				 = $item["AGREGADO"];	
	$des_bem	 			 = $item["DES_BEM"];
	$numero_nota_fiscal 	 = $item["NUMERO_NOTA_FISCAL"];
	$serie_nota_fiscal 		 = $item["SERIE_NOTA_FISCAL"];
	$fornecedor				 = $item["NOME"];
	$dta_aquisicao 			 = $item["DTA_AQUISICAO"];
	$dta_movimento 			 = $item["DTA_MOVIMENTO"];
	$val_original			 = $item["VAL_ORIGINAL"];
	$conta_patrimonial 		 = $item["DES_CONTA_PATRIMONIAL"];
	$centro_custo 			 = $item["DES_CENTRO_CUSTO"];
	$local					 = $item["LOCAL"];
	$calcula_pis 			 = $item["CALCULA_PIS"];
	$calcula_cofins 		 = $item["CALCULA_COFINS"];
	$dta_processamento		 = $item["DTA_PROCESSAMENTO"];
	$plaqueta				 = $item["PLAQUETA"];
	}
	
	

$query = ("SELECT top 1 bem, revenda, sum(VAL_ORIGINAL_CORRIGIDO - VAL_DEPR_ACUM_CORRIGIDA) as valorD FROM AFX_DEPRECIACAO WHERE BEM = :bem AND REVENDA = :revenda group by VAL_DEPR_ACUM_CORRIGIDA, VAL_ORIGINAL_CORRIGIDO, bem, revenda ORDER BY VAL_DEPR_ACUM_CORRIGIDA DESC "); 
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':bem', $cod);
	$stmt->bindValue(':revenda', $rev);
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	foreach($result as $item){
	$valorDepreciado = $item["valorD"];
	}
}

?>