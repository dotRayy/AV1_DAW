<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $busca = $_POST['idProduto'];
        $qtdProduto = $_POST['qtdProduto'];

        $arqProdutos = fopen("produtos.txt", "r") or die("Erro ao abrir arquivo!");
        $atual = 1;
                
        while(!feof($arqProdutos)){

            $linha[] = fgets($arqProdutos);
            $colunaDados = explode(";", $linha[$atual]);
            $idProduto = $colunaDados[0];
            print($idProduto);
            if($idProduto == $busca){
                $nomeProduto = $colunaDados[1];
                $valorProduto = $colunaDados[2];
                break;
            }
            $atual++;
        }
            fclose($arqProdutos);

            $texto = "\n".$idProduto.";".$nomeProduto.";".$qtdProduto.";".$valorProduto.";";

            if(!file_exists("carrinho.txt")) {
                $arqCarrinho = fopen("carrinho.txt", "w");
                $cabecalho = "Id;Nome;QTD;Valor;";
                fwrite($arqCarrinho, $cabecalho);
            } else {
                $arqCarrinho = fopen("carrinho.txt", "a");
            }
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
</body>
</html>