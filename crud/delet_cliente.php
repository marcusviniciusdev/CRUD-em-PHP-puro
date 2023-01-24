<?php 
require("../conn.php");

$cliente= $_POST['cliente'];

if(empty($cliente)){
	echo "Erro";
	header("Location: ../index.php?err");
}else{

	$deleta = $pdo->prepare("DELETE FROM customer WHERE id = :deleta");
	$deleta->execute(array(
		':deleta' => $cliente
	));

	echo "<script>setTimeout(function(){ window.location.href = 'tabela.php?deletado';},500);</script>";

}


?>