<?php require_once("php/indexPHP.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=1">
	<title>Sistema de Imobilizados Vecol - Login</title>
    
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon"/>
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/login.css" />
	
    <!-- AMARAN (ALERT) -->
    <link rel="stylesheet" href="css/amaran.min.css">
      
    
</head>
<body>
	<section id="logo">
		<a href="#"><img src="imagens/logo-dashOLD.png" width="240px" height="100px" alt="" /></a>
	</section>
	
	<section class="container">
		<section class="row">
			<form class="form-horizontal" action="index.php" method="post" role="login">
				<div class="form-group">
					<label>Usuário</label>
					<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuário" value="" required="required" />
				</div>
				
				<div class="form-group">
					<label>Senha</label>
					<input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" />
				</div>
			
				<div class="form-group">
					<button type="submit" class="btn btn-lg btn-block btn-primary">Entrar no sistema</button>
                
				</div>             
			</form>
		</section>
	</section>
    
    
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/index.js"></script>
	<script src="js/bootstrap.min.js"></script>
   
</body>
</html>
<?php
    // Fechar conexao
    mysqli_close($conecta);
?>