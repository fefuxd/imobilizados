<?php require_once("dashboard.php"); ?>
<?php require_once("conexao/conexao.php"); ?>
<?php
    // tabela de clientes
    $tr = "SELECT * FROM item ";

    $consulta_tr = mysqli_query($conecta, $tr);
    if(!$consulta_tr) {
        die("erro no banco1");
    }
?>

<!doctype html>
<html>
	<body>
        <div id="conteudo">
  		  <div class="container-fluid no-padding inicio">
          
<h3 style="color: #337ab7; margin-left: 10px;"> Imobilizados para serem cadastrados no BRAVOS </h3>

 <table class="table table-striped table-hover"> 

            <tr>
                <th>Revenda</th>
                <th>BEM</th> 
                <th>Descrição</th> 
				<th>Excluir</th>
            </tr>

        <?php
            while($linha = mysqli_fetch_assoc($consulta_tr)) 
            {
        ?> 
        <tr onmouseover="this.style.cursor='pointer'">
            <td><?php echo utf8_encode($linha["revendaId"]) ?></td>
            <td><?php echo utf8_encode($linha["bem"]) ?></td>
            <td><?php echo utf8_encode($linha["descricao"]) ?></td>  
            <td><a title="Desativar" href="excluirBem.php?codigo=<?php echo $linha["itemId"] ?>"><i class="fa fa-times"></i></a> </td>
               
        </tr>
        <?php
        }
        ?>
    </table>                
     		</div>
       </div>







		  

        </div> 
      </div>
        
        
	</body>
    
</html>

