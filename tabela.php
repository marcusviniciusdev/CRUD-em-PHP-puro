<?php
require("conn.php");

$tabela = $pdo->prepare("SELECT * FROM customer ORDER BY ID ASC");
$tabela->execute();
$restabela = $tabela->rowCount();
$rowtabela = $tabela->fetchALL();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
      rel="stylesheet">
    <title>Tabela de Produtos</title>
</head>
<body>

<div class="container">
	<br>
	<h1 align="center">Tabela de Clientes</h1>
	<br>
  <?php if($restabela > 0) { ?>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">ID do Cliente</th>
      <th scope="col">Cnpj</th>
      <th scope="col">Razão Social</th>
      <th scope="col">Ações</th>
     
    </tr>
  </thead>
  <tbody>
    <?php 
    $num = 1;
    foreach ($rowtabela as $linha) {
    
    ?>
    <tr>
      <th><?= $linha['ID'] ?></th>
      <td><?= $linha['cnpj'] ?></td>
      <td><?= $linha['company_name'] ?></td>
      
      <td>
        <a href="edit_tabela.php?cliente=<?=$linha['ID']?>" class="material-icons text-warning">edit</a>
        <a id="<?= $linha['ID']  ?>" class="material-icons text-danger deletar">delete</a>

      </td>
    </tr>
    <?php 
    $num++;
    } 
    ?>
  </tbody>
</table>
<?php }else {?>
    <div class="alert alert-primary" role="alert">Nenhum cliente cadastrado :(</div>
<?php } ?>
</div>
    <div class="form-group">
<div class="container">
      <a href="index.php" class="btn btn-primary float-left">Cadastrar Cliente</a>
</div>

<div id="linkResultado"></div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

$(document).on('click','.deletar', function(){
    var cliente = $(this).attr('ID'); 

      Swal.fire({
        title: "Você deseja deletar o Cliente?",
        text: "Você não poderá recuperar após a exclusão",
        icon:"warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText:"Sim, Deletar!"
      }).then((result) =>{
      if(result.isConfirmed){
            jQuery.ajax({
            type: "POST",
            url:"CRUD/delet_cliente.php",
            data: {cliente:cliente},
            success: function(data)
            {
            $("#linkResultado").html(data);   
            }
      });
      Swal.fire(
        'Deletado',
        'Atualizando...',
        'success'
      )
     }
    });

      

    });


</script>

</body>
</html>