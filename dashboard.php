<?php require_once("conexao/conexao.php"); ?>
<?php require_once("php/validacao.php"); ?>
<?php $oiee = "/imobilizados/cadImobilizado.php" ?>
<?php $oiee2 = "/imobilizados/inicio.php" ?>
<?php $oiee3 = "/imobilizados/lista.php" ?>

<?php
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

		default:
		$rev_teste = 5;
	}
	?>
<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        
        <meta charset="utf-8">
		
		<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=1">
        <title>Sistema de Imobilizados Vecol</title>
        
        <link rel="icon" href="imagens/favicon.ico" type="image/x-icon"/>
        
        <!-- Normalize -->
        <link href="css/normalize.css" rel="stylesheet">
        
        <!-- Fontawesome -->
        <link rel="stylesheet" href="css/font-awesome-4.5.0/css/font-awesome.min.css">
        
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Pure CSS -->
        <link href="css/pure-min.css" rel="stylesheet">
        
        <!-- AMARAN (ALERT) -->
        <link rel="stylesheet" href="css/amaran.min.css">

        <!-- Estilo -->
        <link href="css/estilo.css" rel="stylesheet">
        
        <!-- Google Fonts -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		
		
		
    </head>
    
    <body>
			
        <div class="container-fluid">
            
          
            
            <div id="topo">
              
				<?php if($acesso == 1) { ?>  
                <div class="logo2"><a href="inicio.php"><img src="imagens/logo-dash.png" width="140px" height="45px" alt="Logo" >
                </a></div> <?php } else { ?> <div class="logo"><img src="imagens/logo-dash.png" width="140px" height="45px" alt="Logo" ></div> <?php } ?>
				
				
               <?php if (isset ($_GET["codigo"]) AND ($_GET["revenda"]) ) {
					$revenda = $_GET["revenda"];
				   ?>
					
					  <button type="button" id="btVoltar" onclick="window.history.go(-1)" class="btn btn-default btn-sm">
					  <span class="glyphicon glyphicon-arrow-left"></span> Voltar
					  </button>        

					  <button id="fotoBt" type="button" class="btn btn-default btn-sm">
					  <span class="glyphicon glyphicon-plus"></span> Nova Foto
					  </button>
					  	
				<?php	
					}
				   ?>
				   
				<?php if (!isset ($_GET["codigo"]) ) {
					
				   ?>
					  <form action="logout.php">
					  
					  <?php if( ($_SERVER['REQUEST_URI'] <> $oiee) AND ($_SERVER['REQUEST_URI'] <> $oiee2) AND ($_SERVER['REQUEST_URI'] == $oiee3 OR $acesso == 1  )) {  ?>
					  <button id="botaoAdd" type="button" onclick="window.location.href='cadImobilizado.php'" class="btn btn-default btn-sm">
					  <span class=" glyphicon glyphicon-plus "></span>
					  
					  <?php } ?>
					  
					   <?php if( ($_SERVER['REQUEST_URI'] == $oiee) OR ($_SERVER['REQUEST_URI'] == $oiee2)) {  ?>
					  <button type="button" id="btVoltar" onclick="window.history.go(-1)" class="btn btn-default btn-sm">
					  <span class="glyphicon glyphicon-arrow-left"></span> Voltar
					  </button> 
					  <?php } ?>
					  
					 <button type="submit" class="btn btn-default btn-sm">
					  <span class="glyphicon glyphicon-off"></span> Logout
					  
						
					  </form>
					 
					
				<?php	
			   }
				   ?>
                
            </div>
            
            <div id="lateral">
                <div>
                    <ul id="sidebar" class="nav nav-pills nav-stacked">
                        <li><a href="inicio.php"><i class="fa fa-home icone-menu"></i><br>Início</a></li>
                        <li><a href="lista.php"><i class="fa fa-wrench icone-menu"></i><br>Imobilizados</a></li>
                    </ul>
                </div>
            </div>
            
    
        </div>


    
        
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<script src="js/jquery-3.4.1.slim.min.js"></script>
	<script src="js/jquery.tablesorter.min.js"></script>
	
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
        
    <!-- AMARAN JS (ALERT) -->
    <script src="js/jquery.amaran.min.js"></script>
    <script src="js/alerts.js"></script>
        
    <!-- JQUERY MASK INPUT PLUGIN -->
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="js/mascaras.js" type="text/javascript"></script>
    
	<script>
		$("#fotoBt").click(function(){
		$("#ft_imob").trigger('click');
		});
	</script>
	
	

	
    </body>
    
</html>