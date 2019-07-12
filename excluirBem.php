 <?php require_once("php/conexao/conexao.php"); ?>
 
 <?php
      if ( isset($_GET["codigo"]) ) {
		 $seila = $_GET["codigo"];
	   
        $tr3 = "delete from item WHERE itemId = {$seila} ";
	
	   	
    $consulta_tr3 = mysqli_query($conecta, $tr3);
    if(!$consulta_tr3) {
        die("erro no banco");

    } 
   }
           
			if(isset($consulta_tr3)  ){
				
			?>	
	 						<script type="text/JavaScript">
							alert("Registro Excluido");
							location.href="inicio.php";
							</script>
							
                            
                            <?php	
			}
			?>