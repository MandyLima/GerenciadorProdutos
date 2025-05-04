<?php
session_start();  // inicia sessao

include("Produto.php"); 

$nome = $codigo = $categoria = $tipo = $estoque = $preco = "";
$produto = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
    $nome = $_POST["txtNome"] ?? '';
    $codigo = $_POST["txtCodigo"] ?? '';
    $categoria = $_POST["txtCategoria"] ?? '';
    $tipo = $_POST["txtTipo"] ?? '';
    $estoque = isset($_POST["txtEstoque"]) ? (int)$_POST["txtEstoque"] : 0;
    $preco = isset($_POST["txtPreco"]) ? (float)$_POST["txtPreco"] : 0.0;  

    if ($tipo === 'Físico') {
        $produto = new ProdutoFisico($nome, $codigo, $categoria, $estoque, $preco);
    } elseif ($tipo === 'Digital') {
        $produto = new ProdutoDigital($nome, $codigo, $categoria, $estoque, $preco);
    }

    $_SESSION['produto'] = $produto;

    echo "Produto cadastrado com sucesso!<br>";
    echo "Produto armazenado na sessão: " . $produto->getNome();  
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>Gerenciador de Produtos</h1>    
    <form action="#" method="post">
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="txtNome" class="form-control" value="<?= htmlspecialchars($nome) ?>">
        </div>

        <div class="mb-3">
            <label>Código:</label>
            <input type="text" name="txtCodigo" class="form-control" value="<?= htmlspecialchars($codigo) ?>">
        </div>

        <div class="mb-3">
            <label>Categoria:</label>
            <input type="text" name="txtCategoria" class="form-control" value="<?= htmlspecialchars($categoria) ?>">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <select class="form-select" id="tipo" name="txtTipo">
                <option disabled <?= $tipo == "" ? "selected" : "" ?>>Selecione uma opção...</option>
                <option value="Físico" <?= $tipo === "Físico" ? "selected" : "" ?>>Físico</option>
                <option value="Digital" <?= $tipo === "Digital" ? "selected" : "" ?>>Digital</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Estoque:</label>
            <input type="number" name="txtEstoque" class="form-control" value="<?= htmlspecialchars($estoque) ?>">
        </div>

        <div class="mb-3">
            <label>Preço:</label>
            <input type="text" name="txtPreco" class="form-control" value="<?= htmlspecialchars($preco) ?>">
        </div>

        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
    </form>

    <br>

    <?php
    if ($produto) {
        echo "<h3>Produto Cadastrado:</h3>";
        $produto->exibirProduto();
    }
    ?>
</body>
</html>
