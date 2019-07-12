<head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<?php require_once("php/conexao/conexao.php"); ?>
<?php
        // Adicionar variave de sessao
        
    
    if ( isset( $_POST["usuario"]  ) ) {
         $usuario = $_POST["usuario"];
         $senha   = $_POST["senha"];
       
        $login = "SELECT * ";
        $login .= "FROM users ";
        $login .= "WHERE name = '{$usuario}' and password = '{$senha}' ";
        
        $acesso = mysqli_query($conecta, $login);
        
        if ( !$acesso ) {
            die ("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        if ( empty($informacao)  ) {
            $mensagem = "Usuário ou senha incorreto";
        } else {
            
			session_start();
			$_SESSION['IDUSER']	       =   $informacao['id'];
     	    $_SESSION['LOGINUSER']     =   $informacao['name'];
     	    $_SESSION['NIVELUSER']     =   $informacao['acesso'];
			$_SESSION['DEPTUSER']	   =   $informacao['departamento'];
			

			if (!isset ( $_SESSION["IDUSER"]) ) {
		  			session_destroy();
                    '<script type="text/JavaScript">
							alert("Erro interno");
							location.href="index.php"
			  		</script>';	
	  } else {
		echo '<script type="text/JavaScript">					
							location.href="lista.php"
			  </script>';
		}	
			}
        }


?>