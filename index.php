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
        </style>
    </head>
    <body>
        <h1>Lista de Produtos</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Valor</th>
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
                    echo "<tr>";
                    $atual++;
                }
                fclose($arqProdutos);
            ?>
        </table>
        <br><br>
        <form action="adicionarProduto.php" method="POST">
            <label for="produto">Produto</label>
            <select id="idProduto" name="idProduto">
                <?php

                    $arqProdutos = fopen("produtos.txt", "r");
                    $atual = 1;
                    while(!feof($arqProdutos)){

                        $linha[] = fgets($arqProdutos);
                        $colunaDados = explode(";", $linha[$atual]);
                        $idProduto = $colunaDados[0];
                        $nomeProduto = $colunaDados[1];
                        $valorProduto = $colunaDados[2];
        
                        echo "<option value='$idProduto'>". $nomeProduto . "</option>";
                        $atual++;
                    }
                    fclose($arqProdutos);
                ?>
            </select>
            <br><br>
            <label for="qtdProduto">Quantidade</label>
            <input type="number" id="qtdProduto" name="qtdProduto">
            <br><br>
            <input type="submit" value="Adicionar Produto">
        </form>
        <br>
        <a href="listarCarrinho.php">Consultar Carrinho</a>
    </body>
</html>