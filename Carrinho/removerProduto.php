<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $arqCarrinho = fopen("carrinho.txt", "r") or die("Falha ao acessar carrinho!");
        $arqTemp = fopen("temp.txt", "w");
        $idBusca = $_GET['idProduto'];
        $linha[] = fgets($arqCarrinho);

        fwrite($arqTemp, "Id;Nome;QTD;Valor;");

        $atual = 0;
        while (($linha = fgets($arqCarrinho)) !== false) {
            $colunaDados = explode(";", $linha);
            $idProduto = $colunaDados[0];

            if ($idBusca != $idProduto) {
                $nomeProduto = $colunaDados[1];
                $qtdProduto = $colunaDados[2];
                $valorProduto = $colunaDados[3];

                fwrite($arqTemp, "\n$idProduto;$nomeProduto;$qtdProduto;$valorProduto;");
            }
            $atual++;
        }

        copy("temp.txt", "carrinho.txt");
        fclose($arqCarrinho);
        fclose($arqTemp);
        unlink("temp.txt");
        
        $resposta = "ok";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Produto</title>
</head>
<body>
    <?php
        if($resposta == "ok") {
            echo "<h2>Produto Removido do Carrinho!</h2>";
        } else {
            echo "<h2>Falha ao Remover Produto!</h2>";
        }
    ?>
    <a href="listarCarrinho.php">Voltar ao Carrinho</a>
</body>
</html>