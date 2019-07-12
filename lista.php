<?php require_once("dashboard.php"); ?>
<?php require_once("php/lista.php"); ?>


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
								   if ( $rev_teste == 6 ) { echo "Ibitinga"; }  ?> </br>no departamento <?php echo $dptoUser; ?> </h5> </strong>
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
				
			
			
			
					<select class="form-control" name="contaPatrimonial" id="contaPatrimonial" <?php if($acesso == 0) { ?> style="width: 80%; text-align: center; float: center;
			  position: center; margin-left: 3px;" <?php } ?> onchange="this.form.submit();" <?php if(!isset($_GET["revenda"]) AND $acesso <> 0  ) { ?> hidden  <?php } ?>  >
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
										
					
					<?php if ($acesso == 1) { ?>
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
					<?php } ?>
					
				</div>
				
					<div class="form-group">
						<input class="form-control" type="text" name="bemdesc" value="" id="bemdesc" placeholder="BEM ou Descrição" <?php if(!isset($_GET["revenda"]) AND $acesso <> 0  ) { ?> hidden  <?php } ?> >
						<button id="pesquisar" class="btn btn-default" type="submit" <?php if(!isset($_GET["revenda"]) ) { ?> hidden  <?php } ?>><i class="fa fa-search"></i></button>
						<a  href="lista.php"> Limpar filtro</a>
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
	<table  class="table table-striped table-hover ordena"> 
		<thead>
            <tr>
                <th>Bem</th>
				<th>Descrição</th>
				<th><img src="imagens/camera.png" height="16px" width="18px"  ></th>
            </tr>
		</thead>
	<?php
		foreach($linha as $listar){
			$bem = $listar["bem"];
			$des_bem = utf8_encode($listar["des_bem"]);
			$agreg = $listar["AGREGADO"];
			
		if($acesso == 0) {	
		$revenda = $rev_teste;
			} 
	else 	{
		$revenda= $_GET["revenda"];
			}
	?>  
			<tr onmouseover="this.style.cursor='pointer'" onclick="document.location = 'detalheImob.php?codigo=<?php echo $bem."&revenda=".$revenda."&agregado=".$agreg; ?>';">
            <td><?php echo $bem."-".$agreg; ?></td>   
			<td><?php echo utf8_decode($des_bem); ?></td>
			<td><?php $arquivo = 'img/' . $bem . $revenda . $agreg . '.jpg';
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
	
<script>
$(function(){
	$('.ordena').tablesorter();
});
</script>	
	
</html>
<?php $pdo = null; ?>
