<?php

interface Funcoes {
    public function adicionarEstoque($quantidade);
    public function reduzirEstoque($quantidade);
    public function consultarEstoque();
    public function exibirProduto();
    public function calcularImposto();
}

abstract class Produto implements Funcoes {
    protected $nome;
    protected $codigo;
    protected $categoria;
    protected $tipo;
    protected $estoque;
    protected $preco;

    public function __construct($_nome, $_codigo, $_categoria, $_estoque, $_preco) {
        $this->nome = $_nome;
        $this->codigo = $_codigo;
        $this->categoria = $_categoria;
        $this->estoque = $_estoque;
        $this->preco = (float) str_replace(',', '.', $_preco);
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;  
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function adicionarEstoque($quantidade) {
        $this->estoque += $quantidade;
    }

    public function reduzirEstoque($quantidade) {
        if ($quantidade > $this->estoque) {
            echo "Erro: Estoque insuficiente. Operação cancelada.<br>";
        } else {
            $this->estoque -= $quantidade;
            echo "Estoque reduzido. <br>";
        }
    }

    public function consultarEstoque() {
        return $this->estoque;
    }

    public function exibirProduto() {
        echo "Nome: {$this->nome}<br>";
        echo "Código: {$this->codigo}<br>";
        echo "Categoria: {$this->categoria}<br>";
        echo "Tipo: {$this->tipo}<br>";
        echo "Estoque: {$this->estoque}<br>";
        echo "Preço: R$ " . number_format($this->preco, 2, ',', '.') . "<br>";
    }

    abstract public function calcularImposto();
}

trait Desconto {
    public function aplicarDesconto($valor, $percentual) {
        return $valor - ($valor * ($percentual / 100));
    }
}

class ProdutoFisico extends Produto {
    use Desconto;

    public function __construct($_nome, $_codigo, $_categoria, $_estoque, $_preco) {
        parent::__construct($_nome, $_codigo, $_categoria, $_estoque, $_preco);
        $this->tipo = 'fisico';
    }

    public function calcularImposto() {
        return $this->preco * 0.10; // 10% de imposto
    }

    public function exibirProduto() {
        parent::exibirProduto();
        echo "Imposto: R$ " . number_format($this->calcularImposto(), 2, ',', '.') . "<br>";
    }
}

class ProdutoDigital extends Produto {
    use Desconto;

    public function __construct($_nome, $_codigo, $_categoria, $_estoque, $_preco) {
        parent::__construct($_nome, $_codigo, $_categoria, $_estoque, $_preco);
        $this->tipo = 'digital';
    }

    public function calcularImposto() {
        return $this->preco * 0.05; // 5% de imposto
    }

    public function exibirProduto() {
        parent::exibirProduto();
        echo "Imposto: R$ " . number_format($this->calcularImposto(), 2, ',', '.') . "<br>";
    }
}

?>
