<?php
 
class Produto {
    private $nome;
    private $codigo;
    private $categoria;
    private $tipo;
    private $estoque;
    private $preco;
 
    public function __construct($_nome, $_codigo, $_categoria,$_tipo, $_estoque, $_preco){
        //o _ é para diferenciar do atributo
        $this->nome = $_nome;
        $this->codigo = $_codigo;
        $this->categoria = $_categoria;
        $this->tipo = $_tipo;
        $this->estoque = $_estoque;
        $this->preco = (float) str_replace(',', '.', $_preco);    }
 
    public function setNome($_nome){
        $this->nome = $_nome;
    }
 
    public function getNome(){
        return $this->nome; //pode usar echo como return
    }
 
    public function setCodigo($_codigo){ //Set pra introduzir valor no atributo privado
        $this->codigo = $_codigo;
    }
 
    public function getCodigo(){ //Get para capturar valor de um atributo privado
        return $this->codigo;
    }
 
    public function setCategoria($_categoria){
        $this->categoria = $_categoria;
    }
 
    public function getCategoria(){
        return $this->categoria;
    }

    public function setTipo($_tipo){
        $this->tipo = $_tipo;
    }
 
    public function getTipo(){
        return $this->tipo;
    }
 
    public function setEstoque($_estoque){
        $this->estoque = $_estoque;
    }
 
    public function getEstoque(){
        return $this->estoque;
    }
   
    public function setPreco($_preco){
        $this->preco = (float) str_replace(',', '.', $_preco);
    }
 
    public function getPreco(){
        return $this->preco;
    }

    public function adicionarEstoque($quantidade) {
        $this->estoque += $quantidade;
    }
 
    public function reduzirEstoque($quantidade) {
        if ($this->estoque >= $quantidade) {
            $this->estoque -= $quantidade;
        } else {
            echo "Estoque invalido";
        }
    }
 
    public function consultarEstoque() {
        return $this->estoque;
    }
    
 
    public function exibirProduto() {
        echo "<h3>Informações do Produto:</h3>";
        echo "Nome: {$this->nome}<br>";
        echo "Código: {$this->codigo}<br>";
        echo "Categoria: {$this->categoria}<br>";
        echo "Tipo: {$this->tipo}<br>";
        echo "Estoque Atual: {$this->estoque}<br>";
        echo "Preço Unitário: R$ " . number_format($this->preco, 2, ',', '.') . "<br>";
    }
 
    
}
trait Desconto {
    public function aplicarDesconto($valor, $percentual){
        return $valor - ($valor * ($percentual/100));
    }
 }

class ProdutoFisico extends Produto {
    use Desconto;

    private $peso;

    public function __construct($nome, $codigo, $categoria, $estoque, $preco, $peso) {
        parent::__construct($nome, $codigo, $categoria, $estoque, $preco);
        $this->peso = $peso;
    }

    public function getPrecoComImposto() {
        $valorImposto = $this->preco * 0.10; // 10% de imposto
        return $this->preco + $valorImposto;
    }

    public function getPrecoComDesconto($percentualDesconto) {
        return $this->aplicarDesconto($this->getPrecoComImposto(), $percentualDesconto);
    }

    public function exibirProduto() {
        parent::exibirProduto();
        echo "Peso: {$this->peso} kg<br>";
        echo "Preço com imposto (10%): R$ " . number_format($this->getPrecoComImposto(), 2, ',', '.') . "<br>";
        echo "Preço com desconto: R$ " . number_format($this->getPrecoComDesconto(5), 2, ',', '.') . "<br>";//aplicando com a trait
    }
}

class ProdutoDigital extends Produto{

    public function getPrecoComImposto(){
        $valorImposto = $this->preco*0.5;
        return $this->preco + $valorImposto;
    }
    public function getPrecoComDesconto($percentualDesconto) {
        return $this->aplicarDesconto($this->getPrecoComImposto(), $percentualDesconto);
    }
    public function exibirProduto() {
        parent::exibirProduto();
        echo "Preço com imposto (5%): R$ " . number_format($this->getPrecoComImposto(), 2, ',', '.') . "<br>";
        echo "Preço com desconto: R$ " . number_format($this->getPrecoComDesconto(5), 2, ',', '.') . "<br>";//aplicando com a trait
    }



}








?>