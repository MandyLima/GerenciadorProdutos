<?php
   $nome = $codigo = $categoria = $tipo = $estoque = $preco = "";
   $estoque = isset($_POST["txtEstoque"]) ? (int)$_POST["txtEstoque"] : 0;
   
   // Verifica se algum botão foi pressionado
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST["aumentar"])) {
           $estoque++;
       } elseif (isset($_POST["diminuir"])) {
           $estoque = max(0, $estoque - 1);
       } elseif (isset($_POST["cadastrar"])) {
           $nome = $_POST["txtNome"];
           $codigo = $_POST["txtCodigo"];
           $categoria = $_POST["txtCategoria"];
           $tipo = $_POST["txtTipo"];
           $preco = $_POST["txtPreco"];
       }
   }
?>



<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <h1>Gerenciador de Produtos</h1>    
    <form action="#" method="post">
        <label>Nome:</label>
        <input type="text" name="txtNome"><br>
        
        <label>Codigo:</label>
        <input type="text" name="txtCodigo"><br>
       
        <label>Categoria:</label>
        <input type="text" name="txtCategoria"><br>

        <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <select class="form-select" id="tipo" name="txtTipo">
                    <option selected disabled>Selecione uma ação...</option>
                    <option value="Físico">Físico</option>
                    <option value="Digital">Digital</option>
                </select>
            </div>

        <label>Estoque:</label>
        <input type="text" name="txtEstoque"><br>


        <label>Preço:</label>
        <input type="text" name="txtPreco" value="<?= htmlspecialchars($preco) ?>"><br>

        <input type="submit" name="cadastrar" value="Cadastrar">

    </form>
    <br>
</body>
</html>
 
<?php
 include("Produto.php");
 $produto = new Produto($nome, $codigo, $categoria,$tipo, $estoque, $preco);
 $produto->exibirProduto();
 ?>