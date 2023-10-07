<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $opcaoProduto = $_POST['opcaoProduto'];
        $info = explode("|", $opcaoProduto);
        
        $idProduto = $info[0];
        $nomeProduto = $info[1];
        $qtdProduto = $_POST['qtdProduto'];
        $valorProduto = $info[2];

        if(!file_exists("carrinho.txt")) {
            $arqCarrinho = fopen("carrinho.txt", "w");
            fwrite($arqCarrinho, "Id;Nome;QTD;Valor;");
        } else {
            $arqCarrinho = fopen("carrinho.txt", "a");
        }

        $texto = "\n$idProduto;$nomeProduto;$qtdProduto;$valorProduto;";
        fwrite($arqCarrinho, $texto);

        fclose($arqCarrinho);

        $resposta = "ok";
    }
?>
<body>
    <?php
        if($resposta == "ok"){
            echo "<h2>Produto Adicionado ao Carrinho!</h2>";
        } else {
            echo "<h2>Falha ao Adicionar Produto!</h2>";
        }
    ?>
    <br><br>
    <a href="index.php">Voltar às Compras</a>
    <a href="listarCarrinho.php">Ver Carrinho</a>
</body>
</html>