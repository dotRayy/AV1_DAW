<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <style>
         table, th, tr, td {
            border: solid black 1px;
            border-collapse: collapse;
            text-align: center;
            padding: 5px;
            padding-left: 30px;
            padding-right: 30px;
        }
        th{
            background-color: lightyellow;
        }
        table {
            margin:auto;
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
                $valorTotal = 0;

                $arqCarrinho = fopen("carrinho.txt", "r") or die("Erro ao acessar carrinho!");
                $linha[] = fgets($arqCarrinho);

                $atual = 1;
                while(!feof($arqCarrinho)){

                    $linha[] = fgets($arqCarrinho);
                    $colunaDados = explode(";", $linha[$atual]);
                    $idProduto = $colunaDados[0];
                    $nomeProduto = $colunaDados[1];
                    $qtdProduto = $colunaDados[2];
                    $valorProduto = $colunaDados[3];
                    $valorTotal += $valorProduto * $qtdProduto;

                    echo "<tr>";
                    echo "<td>". $idProduto . "</td>";
                    echo "<td>". $nomeProduto . "</td>";
                    echo "<td>". $qtdProduto . "</td>";
                    echo "<td>R$". $valorProduto . "</td>";
                    echo "<td><a href='removerProduto.php?idProduto=$idProduto' class='linkRemover' data-nome='$nomeProduto'>Remover</a></td>";
                    echo "<tr>";
                    $atual++;
                }
                fclose($arqCarrinho);
                ?>
                <tr><td>Total: </td><td colspan="4">R$<?php echo $valorTotal;?></td></tr>
        </table>
        <br>
        <a href="index.php">Voltar às Compras</a>

        <script>
            const linksRemover = document.querySelectorAll('.linkRemover');

            linksRemover.forEach(link => {
                link.addEventListener('click', function (event) {
                    const nomeProduto = this.getAttribute('data-nome');
                    const confirmacao = confirm(`Tem certeza que deseja remover o produto "${nomeProduto}"?`);

                    if (!confirmacao) {
                        event.preventDefault();
                    }
                });
            });
        </script>
</body>
</html>