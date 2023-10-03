<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, tr, td {
            border: solid black 1px;
            border-collapse: collapse;
            text-align: center;
        }
        th{
            background-color: lightyellow;
        }
    </style>
</head>
<body>
<h1>Lista de Produtos</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>Opção</th>
            </tr>
            <?php
                $idProduto = "";
                $nomeProduto = "";
                $valorProduto = "";

                $arqCarrinho = fopen("carrinho.txt", "r") or die("Erro ao acessar carrinho!");

                $atual = 1;
                $linha[] = fgets($arqCarrinho);

                while(!feof($arqCarrinho)){

                    $linha[] = fgets($arqCarrinho);
                    $colunaDados = explode(";", $linha[$atual]);
                    $idProduto = $colunaDados[0];
                    $nomeProduto = $colunaDados[1];
                    $qtdProduto = $colunaDados[2];
                    $valorProduto = $colunaDados[3];

                    echo "<tr>";
                    echo "<td>". $idProduto . "</td>";
                    echo "<td>". $nomeProduto . "</td>";
                    echo "<td>". $qtdProduto . "</td>";
                    echo "<td>R$". $valorProduto . "</td>";
                    echo "<td><input type='submit' value='Remover' href='removerProduto.php?idProduto=$idProduto'></td>";
                    echo "<tr>";
                    $atual++;
                }
                fclose($arqCarrinho);
            ?>
        </table>
</body>
</html>