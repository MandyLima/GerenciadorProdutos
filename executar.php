<?php
include_once 'Produto.php'; 
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['txtAcao']) && isset($_POST['txtCodigo']) && isset($_POST['txtQtde'])) {
        $acao = $_POST['txtAcao']; 
        $codigo = $_POST['txtCodigo'];
        $quantidade = floatval($_POST['txtQtde']); 

        if (!isset($_SESSION['produto'])) {
            echo "Erro: Produto não encontrado na sessão.<br>";
            exit; 
        }

        $produto = $_SESSION['produto']; 

        switch ($acao) {
            case 1: 
                echo "Adicionando {$quantidade} unidades ao estoque do produto com código {$codigo}.<br>";
                $produto->adicionarEstoque($quantidade); 
                break;

            case 2: 
                echo "Reduzindo {$quantidade} unidades do estoque do produto com código {$codigo}.<br>";
                $produto->reduzirEstoque($quantidade); 
                break;

            case 3: 
                echo "Estoque do produto com código {$codigo}: {$produto->consultarEstoque()} unidades.<br>";
                break;

            case 4:
                echo "Exibindo informações do produto com código {$produto->getCodigo()}:<br>";
                $produto->exibirProduto(); 
                break;

            case 5:
                echo "Calculando imposto do produto com código {$codigo}: R$ " . number_format($produto->calcularImposto(), 2, ',', '.') . "<br>";
                break;

            case 6:
                $percentual = floatval($quantidade); 
                echo "Aplicando um desconto de {$percentual}% no preço do produto com código {$codigo}.<br>";
                
                $novoPreco = $produto->getPreco();  
                $novoPrecoComDesconto = $produto->aplicarDesconto($novoPreco, $percentual); 
                
                echo "Novo preço com desconto: R$ " . number_format($novoPrecoComDesconto, 2, ',', '.') . "<br>";
                break;

            default:
                echo "Ação inválida!<br>";
                break;
        }
    } else {
        echo "Erro: Todos os campos são obrigatórios!<br>";
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

