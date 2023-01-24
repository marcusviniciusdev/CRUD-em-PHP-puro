<?php
require("conn.php");

if(isset($_GET['cliente']))
{
    $cliente = $_GET['cliente'];

}else{
    header("Location?index.php");
}

$tabela = $pdo->prepare("SELECT * FROM customer WHERE id = :clientes");
$tabela->bindParam(':clientes', $cliente);
$tabela->execute();
$restabela = $tabela->rowCount();
$rowtabela = $tabela->fetch(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Cadastro de Cliente</title>
</head>
<body>

<div class="container">

    <h1 align="Center">Atualização de Dados</h1>

    <form action="crud/edit_cliente.php" method="POST" id="formulario">
        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <label>Cnpj</label>
                <input type="text" name="cnpj" id="cnpj" value=<?= $rowtabela['cnpj'] ?> class="form-control">
            </div>
            <div class="col-md-6 offset-md-3">
                <label>Razão Social</label>
                <input type="text" name="razaosocial" id="razaosocial" value=<?= $rowtabela['company_name'] ?> class="form-control">
            </div>
            <div class="col-md-6 offset-md-3 mt-4">
                <input type="submit" value="Editar" class="btn btn-success">
                <a href="tabela.php" class="btn btn-primary">Visualizar Clientes</a>
                <input type="hidden" name="cliente" value="<?= $rowtabela['ID']?>" class="form-control">
            </div>
        </div>
    </form>
    <div id="linkResultado"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!-- <script src="js/jquery/arquivojquery.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
<script>
jQuery('#formulario').submit(function(event){
      event.preventDefault();
      var dados = jQuery(this).serialize();
      
       jQuery.ajax({
        type: "POST",
        url:"CRUD/edit_cliente.php",
        data: dados,
        success: function(data)
        {
         $("#linkResultado").html(data);   
        }
      });
      return false;
    });

</script>
</body>
</html>