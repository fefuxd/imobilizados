
<?php
 function conecta(){
try {
    $pdo = new PDO("sqlsrv:Server=10.10.0.1; Database=BRAVOS", "cnp", "");

} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}
	return $pdo;

 }
?>