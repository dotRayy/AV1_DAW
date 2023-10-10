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
    <h1>Cadastrar Produto</h1>
    <hr>
    <form action="cadastrar.php" method="POST">

            <label for="idProduto">ID:</label>
            <input type="number" id="idProduto" name="idProduto" style="width: 70px;">

            <label for="nomeProduto">Nome do Produto:</label>
            <input type="text" id="nomeProduto" name="nomeProduto" style="width: 500px;">

            <label for="valorProduto">Valor (R$):</label>
            <input type="number" id="valorProduto" name="valorProduto" step="0.01" placeholder="29,99" style="width: 70px;">
            <br><br>
            <input type="submit" value="Enviar">
            <br>

    </form>
    <a href="index.php">Voltar ao Início</a>
</body>
</html>