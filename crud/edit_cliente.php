<?php 
require("../conn.php");

$cnpj = $_POST['cnpj'];
$company_name = $_POST['razaosocial'];
$cliente = $_POST['cliente'];


if(empty($cnpj) || empty($company_name)){
	echo "Voce precisa preencher todos os campos";

	die;
} else {

	$update = $pdo->prepare("UPDATE customer SET cnpj = :cnpj, company_name = :company_name WHERE id = :cliente");
	$update->execute(array(
		':cnpj' => $cnpj,
		':company_name' => $company_name,
		':cliente' => $cliente ,
		

	));

	echo "<h4 align='center' style='color:green'>Editado com sucesso</h4>";
}

?>