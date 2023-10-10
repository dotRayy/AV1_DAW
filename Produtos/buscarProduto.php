<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de Produto</title>
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
    <h1>Resultado da Busca</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Valor</th>
            <th colspan="2">Opção</th>
            <?php

                $idProduto = "";
                $nomeProduto = "";
                $valorProduto = "";

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $idBusca = $_POST['idBusca'];
                    $nomeBusca = $_POST['nomeBusca'];
                    $arqProdutos = fopen("produtos.txt", "r") or die("Erro ao acessar produtos!");
                    $linha[] = fgets($arqProdutos);

                    $atual = 1;
                    while(!feof($arqProdutos)){
                        $linha[] = fgets($arqProdutos);
                        $colunaDados = explode(";", $linha[$atual]);
                        $idProduto = $colunaDados[0];
                        $nomeProduto = $colunaDados[1];
                        $valorProduto = $colunaDados[2];

                        if ((!empty($idBusca) && $idProduto == $idBusca) || 
                        (!empty($nomeBusca) && stripos($nomeProduto, $nomeBusca) !== false)) {
                            echo "<tr>";
                            echo "<td>". $idProduto . "</td>";
                            echo "<td>". $nomeProduto . "</td>";
                            echo "<td>R$". $valorProduto . "</td>";
                            echo "<td><a href='alterarProduto.php?idProduto=$idProduto'>Alterar</a></td>";
                            echo "<td><a href='excluirProduto.php?idProduto=$idProduto' class='linkExcluir' data-nome='$nomeProduto'>Excluir</a></td>";
                            echo "<tr>";
                        }
                        $atual++;
                    }
                    fclose($arqProdutos);
                }

            ?>
        </tr>
    </table>
    <a href="index.php" style="font-size: large;">Voltar ao Início</a>
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