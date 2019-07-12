<?php require_once("dashboard.php"); ?>
<?php require_once("php/detalImob.php"); ?>

<!doctype html>
<html>

	

 	<body>
    	<div id="conteudo">
   		<div class="container-fluid no-padding">
            
            <div style="height: 40px;" class="header">
                <div class="titulo-box-texto">
                    
                    <h5 style="margin-top: 5px;">Informações de <strong><?php echo utf8_encode($des_bem) ?></strong></h5>
                </div>

                
            </div>
            
           
		   
		   
		   <div class="panel panel-default"> 
              <div class="panel-heading">Dados do Imobilizado</div>
              <div class="panel-body">
                    <div class="container-fluid col-md-10">
                    
                    <div class="row">
						 <div class="col-md-12">
                            <span class="indiceEntrada">DESCRIÇÃO: </span><span class="indiceValor"><?php echo utf8_encode($des_bem) ?></span>
                        </div>
                    </div>
                    
                    
                    
                    <div class="row">
                        <div class="col-md-4">
                            <span class="indiceEntrada">BEM: </span><span class="indiceValor"><?php echo utf8_encode($bem) ?></span>
                        </div>
                        <div class="col-md-4">
                            <span class="indiceEntrada">AGREGADO: </span><span class="indiceValor"><?php echo utf8_encode($agregado) ?></span>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <span class="indiceEntrada">NÚMERO DA NF: </span><span class="indiceValor"><?php echo utf8_encode($numero_nota_fiscal) ?> - <?php echo utf8_encode($serie_nota_fiscal) ?> </span>
                        </div>

                        <div class="col-md-4">
                            <span class="indiceEntrada">FORNECEDOR: </span><span class="indiceValor"><?php echo utf8_encode($fornecedor) ?></span>
                        </div>
						
						<div class="col-md-4">
                            <span class="indiceEntrada">REVENDA: </span><span class="indiceValor"><?php 
						   if ( $revenda == 1 ) { echo "PIRACICABA"; }
						   if ( $revenda == 2 ) { echo "BOTUCATU"; }
						   if ( $revenda == 3 ) { echo "SÃO MANUEL"; }
						   if ( $revenda == 4 ) { echo "LENÇÓIS PAULISTA"; }
						   if ( $revenda == 5 ) { echo "JAÚ"; }
						   if ( $revenda == 6 ) { echo "IBITINGA"; }  ?>
						   </span>
                        </div>
                    </div>
                    
                    <div class="row">                    
                        <div class="col-md-4">
                            <span class="indiceEntrada">VALOR ORIGINAL: </span><span class="indiceValor"><?php echo 'R$ ' . number_format($val_original, 2, ',', '.'); ?></span>
                        </div>

                        <div class="col-md-4">
                            <span class="indiceEntrada">CONTA PATRIMONIAL: </span><span class="indiceValor"><?php echo utf8_encode($conta_patrimonial) ?></span>
                        </div>

                        <div class="col-md-4">
                            <span class="indiceEntrada">CENTRO DE CUSTO: </span><span class="indiceValor"><?php echo utf8_encode( $centro_custo) ?></span>
                        </div>
                    </div>
                    
					
                    <div class="row">	
                        <div class="col-md-4">
                            <span class="indiceEntrada">VALOR RESIDUAL: </span><span class="indiceValor"><?php echo 'R$ ' . number_format($valorDepreciado, 2, ',', '.'); ?></span>
                        </div>
                        <div class="col-md-4">
                            <span class="indiceEntrada">CALCULO DO PIS? </span><span class="indiceValor"><?php echo utf8_encode( $calcula_pis) ?></span>
                        </div>		
                        <div class="col-md-4">
                            <span class="indiceEntrada">CALCULO COFINS? </span><span class="indiceValor"><?php echo utf8_encode( $calcula_cofins) ?></span>               
                        </div>						
                    </div>
                    
                    	
					<div class="row">
                        <div class="col-md-4">
                            <span class="indiceEntrada">DATA DE AQUISIÇÃO: </span><span class="indiceValor"><?php if(is_null($dta_aquisicao)){
                                $dta_aquisicao = 'NULL';
                            } else { echo date("d/m/y",  strtotime($dta_aquisicao))  ?> <?php } ?></span>
                        </div>

                        <div class="col-md-4">
                            <span class="indiceEntrada">DATA DO MOVIMENTO: </span><span class="indiceValor"><?php if(is_null($dta_movimento)){
                            $dta_movimento = 'NULL';
                            } else { echo date("d/m/y",  strtotime($dta_movimento))  ?> <?php } ?></span>
                        </div>
						
						<div class="col-md-4">
                            <span class="indiceEntrada">DATA DE PROCESSAMENTO: </span><span class="indiceValor"><?php if(is_null($dta_processamento)){
                                $dta_processamento = 'NULL';
                            } else { echo date("d/m/y",  strtotime($dta_processamento))  ?> <?php } ?></span>
                        </div>
                    </div>
					<div class="row">
						
						<div class="col-md-3">
                            <span class="indiceEntrada">LOCAL: </span><span class="indiceValor"><?php echo utf8_encode($local) ?></span>
                        </div>
					</div>
                </div> 
                  
			
  
				 <!-- FOTO IMOB -->
                  <div class="container-fluid col-md-2">
                      <div class="detalheFoto"><img src="<?php echo 'img/' . utf8_encode($bem). utf8_encode($revenda). utf8_encode($agreg). ".jpg" ?>" onerror="if (this.src != 'error.jpg') this.src = 'imagens/no-image-icon-15.png'; " class="img-responsive"  alt="<?php echo "NO IMAGE" ?>">
                      </div>
					  <form class="form-horizontal" action="detalheImob.php?codigo=<?php echo $bem."&revenda=".$revenda."&agregado=".$agreg; ?>" method="post" enctype='multipart/form-data' hidden>
					  <input type="file" value="Alterar Foto"  accept="image/*" capture="camera" id="ft_imob" name="ft_imob" onchange="this.form.submit();" hidden required>
					  <button type="submit" >Inserir</button>
					  </form>
                  </div>
                  <!-- FOTO IMOB -->
				  
				  <?php

				$ft_imob   = (isset($_POST['ft_imob'])) ? $_POST['ft_imob'] : '';
				
				// FAZ UPLOAD DA FOTO 
				if(isset($_FILES['ft_imob']) && $_FILES['ft_imob']['size'] > 0):  
				
					if(is_uploaded_file($_FILES['ft_imob']['tmp_name'])):
						$ft_imob = $bem . $revenda . $agreg.  '.jpg';    
						?>
						<script>$('#btVoltar').attr('onclick','window.history.go(-2)'); </script>						
						<?php
						if (!move_uploaded_file($_FILES['ft_imob']['tmp_name'], 'img/'.$ft_imob)):  
							echo "Houve um erro ao gravar arquivo na pasta de destino!";  
						endif;  
					endif;  
				endif;

				?>
				
				
		   
		 
		</div>
		</div>		 
         
 	</body>
</html>