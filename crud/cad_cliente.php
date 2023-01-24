<?php 
require("../conn.php");

  $cnpj = $_POST['cnpj'];
  $company_name = $_POST['razaosocial'];

if(empty($cnpj) || empty($company_name)){
	echo "<h5 align=center>Você precisa preencher todos os campos</h5>";
	die;
}else {

	$cad_cliente = $pdo->prepare("INSERT INTO customer (cnpj, company_name) VALUES (:cnpj, :company_name)");
	$cad_cliente->execute(array(
		':cnpj' => $cnpj,
		':company_name' => $company_name,
	));

	echo "<script>Swal.fire(
		'Bom trabalho!',
		'Cliente cadastrado com sucesso!',
		'success'
  )</script>";
  

}

?>