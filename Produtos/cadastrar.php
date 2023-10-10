<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $idProduto = $_POST['idProduto'];
        $nomeProduto = $_POST['nomeProduto'];
        $valorProduto = str_replace(',', '.', $_POST['valorProduto']);

        if(!file_exists("produtos.txt")) {
            $arqProdutos= fopen("produtos.txt", "w");
            fwrite($arqProdutos, "Id;Nome;Valor;");
        } else {
            $arqProdutos= fopen("produtos.txt", "r+");
            $linha[] = fgets($arqProdutos);
            $atual = 0;

            while(!feof($arqProdutos)) {

                $linha[] = fgets($arqProdutos);
                $colunaDados = explode(";", $linha[$atual]);
                $idBusca = $colunaDados[0];

                if($idBusca == $idProduto) {
                    fclose($arqProdutos);
                    echo "ID de produto já existente
                    <br>
                    <a href='cadastrarProduto.php'>Voltar</a>";
                    die();
                }
                $atual++;
            }
        }

        $texto = "\n$idProduto;$nomeProduto;$valorProduto;";
        fwrite($arqProdutos, $texto);

        fclose($arqProdutos);

        $resposta = "ok";
    }
?>
<body>
    <?php
        if($resposta == "ok"){
            echo "<h2>Produto Cadastrado com sucesso!</h2>";
        } else {
            echo "<h2>Falha ao Cadastrar Produto!</h2>";
        }
    ?>
    <br><br>
    <a href="cadastrarProduto.php">Cadastrar Outro Produto</a>
    <br><br>
    <a href="index.php">Voltar ao Início</a>
</body>
</html>