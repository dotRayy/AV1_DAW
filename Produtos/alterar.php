<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $arqProdutos = fopen("produtos.txt", "r") or die("Falha ao acessar produtos!");
        $arqTemp = fopen("temp.txt", "w");
        $idBusca = $_POST['idProduto'];
        $novoNome = $_POST['novoNome'];
        $novoValor = str_replace(',', '.', $_POST['novoValor']);
        $linha[] = fgets($arqProdutos);

        fwrite($arqTemp, "Id;Nome;Valor;");

        $atual = 0;
        while (($linha = fgets($arqProdutos)) !== false) {
            $colunaDados = explode(";", $linha);
            $idProduto = $colunaDados[0];

            if ($idBusca != $idProduto) {
                $nomeProduto = $colunaDados[1];
                $valorProduto = $colunaDados[2];

                fwrite($arqTemp, "\n$idProduto;$nomeProduto;$valorProduto;");
            } else {
                fwrite($arqTemp, "\n$idProduto;$novoNome;$novoValor;");
            }
            $atual++;
        }

        copy("temp.txt", "produtos.txt");
        fclose($arqProdutos);
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
            echo "<h2>Produto Excluído!</h2>";
        } else {
            echo "<h2>Falha ao Excluir Produto!</h2>";
        }
    ?>
    <a href="index.php">Voltar ao Início</a>
</body>
</html>