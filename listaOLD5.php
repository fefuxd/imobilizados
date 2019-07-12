<?php require_once("index.php"); ?>

<?php

	$acesso = 0;
	
	// Pegar ip do usuário pra descobrir qual filial está
	$ip = $_SERVER['REMOTE_ADDR'];
	$rest = substr($ip, 6,-3);
	
	switch($rest){
		case "231.":
		$rev_teste = 1;
		break;
		
		case "92":
		$rev_teste = 4;
		break;
		
		case "93":
		$rev_teste = 2;
		break;
		
		case "18":
		$rev_teste = 5;
		break;	
	}
	
	
	// Conectar no banco
	$pdo=conecta();
	
	
	
	
	
	
	
if($acesso < 1) {
	
	// Contador de Itens do SELECT da revenda selecionada
	
	$var2 = $rev_teste;
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
	
	
	
	// Consulta os itens da tabela CONTA PATRIMONIAL para popular o select(form) 
	
		$var1 = $rev_teste;
		$query = ("SELECT REVENDA, CONTA_PATRIMONIAL, DES_CONTA_PATRIMONIAL FROM AFX_CONTA_PATRIMONIAL WHERE REVENDA like :rev "); 
		$stmt3 = $pdo->prepare($query);
		$stmt3->bindValue(':rev', '%' . $var1 . '%', PDO::PARAM_STR);
		$stmt3->execute();
	
	// ----------------------- FIM DA CONSULTA PARA O FORM ---------
	
	
	// Consulta os itens da tabela CENTRO DE CUSTO para popular o select(form) 
	
		$var1 = $rev_teste;
		$query = ("SELECT REVENDA, CENTRO_CUSTO, DES_CENTRO_CUSTO FROM CTB_CENTRO_CUSTO WHERE REVENDA like :rev "); 
		$stmt4 = $pdo->prepare($query);
		$stmt4->bindValue(':rev', '%' . $var1 . '%', PDO::PARAM_STR);
		$stmt4->execute();
	
	// ----------------------- FIM DA CONSULTA PARA O FORM ---------
	
	
	$var1 = $rev_teste;@	
	$var2 = $_GET["bemdesc"];@
	$var3 = $_GET["bemdesc"];@
	$var4 = $_GET["contaPatrimonial"];@
	$var5 = $_GET["centroCusto"];@


	$query = (" SELECT  bem.bem, LEFT(bem.des_bem,20) as des_bem, bem.revenda, bem.CONTA_PATRIMONIAL FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :rev  AND ( bem.des_bem LIKE :bd OR bem.bem LIKE :bd2 ) AND CONTA_PATRIMONIAL like :cp AND CENTRO_CUSTO like :cc AND
	baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null
	ORDER BY bem "); 
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':rev' , '%' . $var1 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd'  , '%' . $var2 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd2' , '%' . $var3 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cp'  , '%' . $var4 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cc'  , '%' . $var5 . '%' , PDO::PARAM_STR);
	$stmt->execute();	
	
	
	
	
	// ------------------------ FIM DA CONSULTA GERAL ----------------------
	
	
}
	
	
	
	
	
	
	
	
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


	$query = (" SELECT  bem.bem, LEFT(bem.des_bem,20) as des_bem, bem.revenda, bem.CONTA_PATRIMONIAL FROM AFX_BEM bem 
	LEFT JOIN AFX_BAIXA baixa
	ON bem.BEM = baixa.BEM and bem.REVENDA = baixa.REVENDA and bem.AGREGADO = baixa.AGREGADO
	LEFT JOIN AFX_TRANSFERENCIA tr
	on bem.BEM = tr.BEM and bem.REVENDA = tr.REVENDA and bem.AGREGADO = tr.AGREGADO
	WHERE bem.revenda LIKE :rev  AND ( bem.des_bem LIKE :bd OR bem.bem LIKE :bd2 ) AND CONTA_PATRIMONIAL like :cp AND CENTRO_CUSTO like :cc AND
	baixa.BEM is null and baixa.REVENDA is null and baixa.AGREGADO is null and tr.BEM is null and tr.AGREGADO is null and tr.REVENDA is null
	ORDER BY bem "); 
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':rev' , '%' . $var1 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd'  , '%' . $var2 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':bd2' , '%' . $var3 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cp'  , '%' . $var4 . '%' , PDO::PARAM_STR);
	$stmt->bindValue(':cc'  , '%' . $var5 . '%' , PDO::PARAM_STR);
	$stmt->execute();	
	}
	
	
	
	// ------------------------ FIM DA CONSULTA GERAL ----------------------
}
?>
<!doctype html>

<html>



<script type='text/javascript'>

(function()
{
if( window.localStorage )
{
if( !localStorage.getItem( 'firstLoad' ) )
{
localStorage[ 'firstLoad' ] = true;
window.location.reload();
}
else
localStorage.removeItem( 'firstLoad' );
}
})();

</script>
	
	<body>
											<!-- CONTADOR DE ITENS --> 
		<div id="conteudo">
			<div class="container-fluid no-padding"> 
				<div class="header">
					<div class="titulo-box-texto" >
						
						<?php 	
							if( $acesso == 0 ){ ?>
								<h5><strong>Quantidade de itens: <?php echo $number_of_rows ?> em <?php if ( $rev_teste == 1 ) { echo "Piracicaba"; }
								   if ( $rev_teste == 2 ) { echo "Botucatu"; }
								   if ( $rev_teste == 3 ) { echo "São Manuel"; }
								   if ( $rev_teste == 4 ) { echo "Lençóis Paulista"; }
								   if ( $rev_teste == 5 ) { echo "Jaú"; }
								   if ( $rev_teste == 6 ) { echo "Ibitinga"; }  ?> </h5></strong>
					   <?php } ?>
					   
					   
					   <?php 	
							if( isset($_GET["revenda"]) && $acesso == 1 )  { ?>
								
								<h5><strong>Quantidade de itens: <?php echo $number_of_rows ?> em <?php if ( ($_GET["revenda"]) == 1 ) { echo "Piracicaba"; }
								   if ( ($_GET["revenda"]) == 2 ) { echo "Botucatu"; }
								   if ( ($_GET["revenda"]) == 3 ) { echo "São Manuel"; }
								   if ( ($_GET["revenda"]) == 4 ) { echo "Lençóis Paulista"; }
								   if ( ($_GET["revenda"]) == 5 ) { echo "Jaú"; }
								   if ( ($_GET["revenda"]) == 6 ) { echo "Ibitinga"; }  ?> </h5></strong>
					   <?php } else { ?>
					   <?php if( !isset($_GET["revenda"]) && $acesso == 1 ) { ?>
								   <h5> Selecione uma revenda para começar  </h5>	</strong>
					   <?php } } ?>
					   
					   
					   
					   
					</div>
				</div>
										<!-- FIM DO CONTADOR --> 

										<!-- FILTROS DE PESQUISA -->
										
        <div class="busca-header">
			<form class="form-inline" role="form" action="lista.php" method="get">
			
				<div class="form-group">
				
					<label for="revenda">Pesquisar</label>  
					
					<?php if($acesso > 0) { ?>
					
					
					<select class="form-control" name="revenda"  onchange="this.form.submit();" >
                           <option value="<?php echo $_GET["revenda"]; ?>" selected>
						   
					<?php 	
						   if(isset($_GET["revenda"]) ) { 
						   if ( ($_GET["revenda"]) == 1 ) { echo "Piracicaba"; }
						   if ( ($_GET["revenda"]) == 2 ) { echo "Botucatu"; }
						   if ( ($_GET["revenda"]) == 3 ) { echo "São Manuel"; }
						   if ( ($_GET["revenda"]) == 4 ) { echo "Lençóis Paulista"; }
						   if ( ($_GET["revenda"]) == 5 ) { echo "Jaú"; }
						   if ( ($_GET["revenda"]) == 6 ) { echo "Ibitinga"; }
						   } else {  ?> Revenda <?php } ?> </option>
                            <?php
								$linha2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								foreach($linha2 as $listar2){
                            ?>
                            <option value="<?php echo $listar2["REVENDA"]; ?>"> <?php echo utf8_encode($listar2["RAZAO_SOCIAL"]);?> </option>   
								<?php } ?>
					</select>
					<?php } ?>
				
			
			
			
					<select class="form-control" name="contaPatrimonial" id="contaPatrimonial" onchange="this.form.submit();" <?php if(!isset($_GET["revenda"])  ) { ?> hidden  <?php } ?>  >
							<option disabled selected value="">Conta Patrimonial</option>
							<?php
							$linha3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

							foreach($linha3 as $listar3){
							?>
								<option value="<?php echo $listar3["CONTA_PATRIMONIAL"]; ?>"> <?php echo utf8_encode($listar3["DES_CONTA_PATRIMONIAL"]);?> </option>

							<?php } ?>    
					</select>
						<script>
							$("#contaPatrimonial").val("<?php echo isset($_GET["contaPatrimonial"]) ? $_GET["contaPatrimonial"] : ''?>");
						</script>
					
					<select class="form-control" name="centroCusto" id="centroCusto" onchange="this.form.submit();" <?php if(!isset($_GET["revenda"]) ) { ?> hidden  <?php } ?>  >
							<option disabled selected value="">Centro de Custo</option>
							<?php
							$linha4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

							foreach($linha4 as $listar4){
							?>
								<option value="<?php echo $listar4["CENTRO_CUSTO"]; ?>"> <?php echo utf8_encode($listar4["DES_CENTRO_CUSTO"]);?> </option>

							<?php } ?>    
					</select>
						<script>
							$("#centroCusto").val("<?php echo isset($_GET["centroCusto"]) ? $_GET["centroCusto"] : ''?>");
						</script>		
						
				</div>
				
					<div class="form-group">
						<input class="form-control" type="text" name="bemdesc" value="" id="bemdesc" placeholder="BEM ou Descrição" <?php if(!isset($_GET["revenda"]) ) { ?> hidden  <?php } ?> >
						<button id="pesquisar" class="btn btn-default" type="submit" <?php if(!isset($_GET["revenda"]) ) { ?> hidden  <?php } ?>><i class="fa fa-search"></i></button>
					</div>
				 
            </form>  
        </div>
			</div>
					
			
									<!-- FIM DOS FILTROS DE PESQUISA -->

									<!-- INICIO DA TABELA COM OS RESULTADOS -->

	<?php
		if($acesso >= 0 ){
			$linha = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$contaLinha = $stmt->rowCount();
			if($contaLinha >= 0) {
	?>
	<table  class="table table-striped table-hover"> 
            <tr>
                <th>BEM</th>
				<th>Descrição</th>
				<th><img src="imagens/camera.png" height="16px" width="18px"  ></th>
            </tr>
	<?php
		foreach($linha as $listar){
			$bem = $listar["bem"];
			$des_bem = utf8_encode($listar["des_bem"]);
			
		if($acesso == 0) {	
		$revenda = $rev_teste;
			} 
	else 	{
		$revenda= $_GET["revenda"];
			}
	?>  
			<tr onmouseover="this.style.cursor='pointer'" onclick="document.location = 'detalheImob.php?codigo=<?php echo $bem."&revenda=".$revenda; ?>';">
            <td><?php echo $bem; ?></td>   
			<td><?php echo $des_bem; ?></td>
			<td><?php $arquivo = 'img/' . $bem . $revenda . '.jpg';
					if (file_exists($arquivo)) {
					echo "<img src='imagens/right.png' height='18px' width='18px' >";
					} else {
					echo "<img src='imagens/wrong.png' height='18px' width='18px' >";
					}  ?></td>
			</tr>
		
	<?php } } else { echo "Sem registro"; }	} ?>
           
    </table>  

    </div>

	</body>
	
	
	
</html>
<?php $pdo = null; ?>
