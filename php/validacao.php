<?php include("php/conexao/conexao.php"); ?>
<?php

	   session_start();
	// Teste de segurança
      if (!isset ( $_SESSION["IDUSER"]) ) {
		  			session_destroy();
                    header("location:index.php");	
					}
     
	  $loginUser = $_SESSION['LOGINUSER'];
	  $dptoUser  = $_SESSION['DEPTUSER'];
	  $acesso    = $_SESSION['NIVELUSER'];
	
?>

