<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
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
            background-color: lightblue;
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
                <th>Valor</th>
                <th colspan="2">Opção</th>
            </tr>
            <?php
                $idProduto = "";
                $nomeProduto = "";
                $valorProduto = "";

                $arqProdutos = fopen("produtos.txt", "r") or die("Erro ao acessar produtos!");
                $linha[] = fgets($arqProdutos);

                $atual = 1;
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
                    echo "<td><a href='alterarProduto.php?idProduto=$idProduto'>Alterar</a></td>";
                    echo "<td><a href='excluirProduto.php?idProduto=$idProduto' class='linkExcluir' data-nome='$nomeProduto'>Excluir</a></td>";
                    echo "<tr>";
                    $atual++;
                }
                fclose($arqProdutos);
                ?>
                
                <tr><td colspan="5"><a href="cadastrarProduto.php" style="font-size: large;">Cadastrar Novo Produto</a></td></tr>
        </table>
        <h2>Buscar um produto</h2>
        <form action="buscarProduto.php" method="POST">
            <label for="idBusca">ID:</label>
            <input type="number" id="idBusca" name="idBusca" style="width: 70px;">

            <label for="nomeBusca">Nome do Produto:</label>
            <input type="text" id="nomeBusca" name="nomeBusca" style="width: 400px;">

            <input type="submit" value="Buscar">
        </form>
        <script>
            const linksExcluir = document.querySelectorAll('.linkExcluir');

            linksExcluir.forEach(link => {
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