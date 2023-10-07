<!DOCTYPE html>
<html>
    <head>
        <style>
            table, th, tr, td {
                border: solid black 1px;
                border-collapse: collapse;
                text-align: center;
            }
            th{
                background-color: lightyellow;
            }
            .numberOption {
                width: 50px;
            }
        </style>
    </head>
    <body>
        <h1>Lista de Produtos</h1>
        <form action="adicionarProduto.php" method="POST">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Adicionar</th>
                </tr>
                <?php
                    $idProduto = "";
                    $nomeProduto = "";
                    $valorProduto = "";

                    $arqProdutos = fopen("produtos.txt", "r") or die("Erro ao acessar produtos!");

                    $atual = 1;
                    $linha[] = fgets($arqProdutos);

                    while(!feof($arqProdutos)){

                        $linha[] = fgets($arqProdutos);
                        $colunaDados = explode(";", $linha[$atual]);
                        $idProduto = $colunaDados[0];
                        $nomeProduto = $colunaDados[1];
                        $valorProduto = $colunaDados[2];

                        echo "<tr>";
                        echo "<td>". $idProduto . "</td>";
                        echo "<td>". $nomeProduto . "</td>";
                        echo "<td>R$". $valorProduto . "</td>";
                        echo "<td><input type='radio' name='opcaoProduto' value='$idProduto|$nomeProduto|$valorProduto'></td>";
                        echo "<tr>";
                        $atual++;
                    }
                    fclose($arqProdutos);
                ?>
            </table>
            <br>
            <label for="qtdProduto">Quantidade</label>
            <input type="number" id="qtdProduto" name="qtdProduto" value="0" class="numberOption">
            <input type="submit" value="Adicionar Produto">
        </form>
        <br>
        <a href="listarCarrinho.php">Consultar Carrinho</a>
    </body>
</html>