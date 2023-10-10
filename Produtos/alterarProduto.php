<?php

$idProduto = "";
$nomeProduto = "";
$valorProduto = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $busca = $_GET['idProduto'];

    $arqProdutos = fopen("produtos.txt", "r") or die ("Erro ao abrir o arquivo");

    $atual = 0;
    while (!feof($arqProdutos)) {
        $linha = fgets($arqProdutos);
        $colunaDados = explode(";", $linha);
        $idProduto = $colunaDados[0];

        if ($idProduto == $busca) {
            $nomeProduto = $colunaDados[1];
            $valorProduto = $colunaDados[2];
            break;
        }
        $atual++;
    }

    fclose($arqProdutos);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Produto</title>
    <style>
    form{
        border: solid;
        padding: 5px;
        background-color: lightblue;
        text-align: center;
    }
    </style>
</head>
<body>
    <h1>Alterar Produto</h1>
    <hr>
    <form action="alterar.php" method="POST">

            <label for="idProduto">ID:</label>
            <input type="number" id="idProduto" name="idProduto" value="<?php echo $idProduto; ?>" style="width: 70px; color: gray;"
            <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 
                    echo "readonly";
                } 
            ?>>

            <label for="novoNome">Nome do Produto:</label>
            <input type="text" id="novoNome" name="novoNome" value="<?php echo $nomeProduto; ?>" style="width: 600px;">

            <label for="novoValor">Valor (R$):</label>
            <input type="number" id="novoValor" name="novoValor" step="0.01" value="<?php echo $valorProduto; ?>" style="width: 70px;">
            <br><br>
            <input type="submit" value="Enviar">
            <br>

    </form>
    <a href="index.php">Voltar ao Início</a>
</body>
</html>