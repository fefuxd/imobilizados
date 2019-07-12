jQuery(function($){  
    
    /* CADASTRO CLIENTE */
    
   $("input[name*='clienteCep']").mask("99.999-999");
   $("input[name*='clienteCpf']").mask("999.999.999-99");
   $("input[name*='clientePis']").mask("999.99999.99-9");
   $("input[name*='clienteTelefone']").mask("(99) 9999-9999");
   $("input[name*='clienteCelular']").mask("(99) 99999-9999");
    
    /* CADASTRO JUDICIAL */
    
    $("input[name*='processoNumero']").mask("9999999-99.9999.9.99.9999");
    
    /* CADASTRO ADMINISTRATIVO */
    
});




$(function(){
     $("input[name*='valorOriginal']").maskMoney({symbol:'R$ ', 
    showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
})

$(function(){
     $("input[name*='valorDepreciado']").maskMoney({symbol:'R$ ', 
    showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
})


$(function(){
     $("input[name*='valorInicial']").maskMoney({symbol:'R$ ', 
    showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
})

