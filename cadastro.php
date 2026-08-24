<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Corrigido a versão do W3.CSS para 4 -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Madereira e Cia Ltda</title>
</head>
<body>
    <div class="w3-container w3-theme-l4">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitização e prevenção contra XSS
            $nome = htmlspecialchars($_POST["txtNome"] ?? '');
            
            // Tratamento do valor numérico (converte vírgula para ponto e força float)
            $valorCompraRaw = str_replace(',', '.', $_POST["txtValorCompra"] ?? '0');
            $valorCompra = (float)$valorCompraRaw;
            
            $formaPagamento = $_POST["cmbPag"] ?? '';
            $desconto = 0;

            if ($formaPagamento == "cartaoCredito") {
                $desconto = 0;
                $mensagem = "Olá $nome, sua compra de R$ " . number_format($valorCompra, 2, ',', '.') . " foi realizada com cartão de crédito. Não há desconto.";
            } elseif ($formaPagamento == "boleto") {
                $desconto = $valorCompra * 0.08;
                $mensagem = "Olá $nome, sua compra de R$ " . number_format($valorCompra, 2, ',', '.') . " foi realizada com boleto. Seu desconto é de R$ " . number_format($desconto, 2, ',', '.') . ".";
            } elseif ($formaPagamento == "deposito") {
                $desconto = $valorCompra * 0.1;
                $mensagem = "Olá $nome, sua compra de R$ " . number_format($valorCompra, 2, ',', '.') . " foi realizada com depósito. Seu desconto é de R$ " . number_format($desconto, 2, ',', '.') . ".";
            } else {
                $mensagem = "Forma de pagamento inválida.";
            }

            // Sintaxe do echo corrigida
            echo "<h4>Compra realizada com sucesso</h4><br>";
            echo "<p>" . $mensagem . "</p>";
        }   
        ?>
    </div>
</body>
</html>