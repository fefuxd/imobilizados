<?php require_once("dashboard.php"); ?>
<?php require_once("php/cadImob.php"); ?>

<!doctype html>
<html>

	<body>
        <div id="conteudo">
  		  <div class="container-fluid no-padding">  
        
        <div style="height: 40px;" class="header">
            <div class="titulo-box-texto">
                <h5 style="margin-top: 5px;" class="titulo-texto"><strong>Cadastro de Imobilizados<strong></h5>
            </div>
        </div>
               

        <form class="form-horizontal" enctype='multipart/form-data' action="cadImobilizado.php" method="post">
         
          <div class="form-group">
            <div class="col-md-1">
             
              <input type="text" name="bem" class="form-control" style="width:99%;" placeholder="BEM" required>
            </div> 
		  </div>
		  <div class="form-group">
            <div class="col-md-7">
              
              <input type="text" name="descricao" style="width:99%;" class="form-control" placeholder="Descrição">
            </div>
			</div>
          
		  
		  
		<div class="form-group">		  
         <div class="col-md-4">
              
			  <?php if ($acesso == 1) { ?>
              <select class="form-control" style="width:99%;" name="revendas" required>
                            <option value="" disabled selected>Revenda</option>
                            <?php
                                while($linha = mysqli_fetch_assoc($lista_re) ){ 
                                   ?>
                            <option value="<?php echo $linha["codigo"]; ?>">
                                <?php echo utf8_encode($linha["descricao"]);    ?>
                            </option>   
                            <?php
                                }                               
                            ?>
                </select>
				</div>
          </div>
			 <?php } else { ?>
			 <select class="form-control" style="width:99%;" name="revendas" hidden>
                            <option value="<?php echo $rev_teste; ?>" selected><?php if ( $rev_teste == 1 ) { echo "Piracicaba"; }
								   if ( $rev_teste == 2 ) { echo "Botucatu"; }
								   if ( $rev_teste == 3 ) { echo "São Manuel"; }
								   if ( $rev_teste == 4 ) { echo "Lençóis Paulista"; }
								   if ( $rev_teste == 5 ) { echo "Jaú"; }
								   if ( $rev_teste == 6 ) { echo "Ibitinga"; }  ?></option>
                            
                </select>
            
			 <?php } ?>
		  
		  
          <div class="form-group">
            <div class="col-md-3">
              <button id="fotoBt2" name="fotoBt2" type="button" style="height:30px;" class="btn btn-default"><i class="fa fa-camera"></i> Capturar Foto</button>
              <button type="submit" style="height:30px;" class="btn btn-primary">Cadastrar</button>
            </div>
          </div>
		  
		  
				<input type="file" value="Alterar Foto"  accept="image/*" capture="camera" id="ft_imob2" name="ft_imob2" hidden required>
					
					 
		  
				 <?php
					
						$ft_imob2   = (isset($_POST['ft_imob2'])) ? $_POST['ft_imob2'] : '';
						// FAZ UPLOAD DA FOTO 
				if(isset($_FILES['ft_imob2']) && $_FILES['ft_imob2']['size'] > 0):  
				
					if(is_uploaded_file($_FILES['ft_imob2']['tmp_name'])):
						$ft_imob2 = $bem . $revenda . '.jpg';    
						?>
						<script>$('#btVoltar').attr('onclick','window.history.go(-2)'); </script>						
						<?php
						if (!move_uploaded_file($_FILES['ft_imob2']['tmp_name'], 'img/'.$ft_imob2)):  
							echo "Houve um erro ao gravar arquivo na pasta de destino!";  
						endif;  
					endif;  
				endif;
						
						if(isset($operacao_inserir)){
						
						?>
                        <!-- ALERT INICIO -->
                        <script type="text/JavaScript">
							$(function(){
                                $.amaran({
                                    'theme'     :'colorful',
                                    'content'   :{
                                        bgcolor:'#27ae60',
                                        color:'#fff',
                                        message:'Imobilizado cadastrado com sucesso!',
                                    },
                                    'afterEnd'      :function()
                                    {
                                        window.history.go(-2)
                                    }
                                });
                            });
				        </script>
                        <!-- ALERT FIM -->
						<?php	
							}
						?>
		
              
		</form> 

        </div>
     </div>
        
	</body> 
</html>
<script>
		$("#fotoBt2").click(function(){
		$("#ft_imob2").trigger('click');
		});
	</script>
<?php
    // Fechar conexao
    mysqli_close($conecta);
?>