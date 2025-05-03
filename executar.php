<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['txtCodigo'];
    $acao = $_POST['txtAcao'];
    $qtde = $_POST['txtQtde'];


    if ($acao === 'aumentar') {
        echo "Aumentando estoque do produto código <strong>$codigo</strong> em <strong>$qtde unidades</strong>.";
    } elseif ($acao === 'desconto') {
        echo "Aplicando desconto de <strong>$qtde%</strong> no produto código <strong>$codigo</strong>.";
    } else {
        echo "Ação inválida ou não selecionada.";
    }


}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form2</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h1>Gerenciador de Produtos</h1>    
    <form action="#" method="post">
        <label>Código do Produto:</label>
        <input type="text" name="txtCodigo"><br>
        
        <div class="mb-3">
                <label for="acao" class="form-label">Ação:</label>
                <select class="form-select" id="acao" name="txtAcao">
                    <option selected disabled>Selecione uma ação...</option>
                    <option value="1">Adicionar Estoque</option>
                    <option value="2">Reduzir Estoque</option>
                    <option value="3">Consultar Estoque</option>
                    <option value="4">Exibir Produto</option>
                    <option value="5">Calcular imposto</option>
                    <option value="6">Aplicar Desconto</option>
            </select>
        </div>
        <label>Quantidade/Percentual</label>
        <input type="text" name="txtQtde"><br>
        <input type="submit" name="Executar Ação" value="Executar Ação">

    </body>
</html>

