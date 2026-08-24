<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Madeira e Cia Ltda.</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
        <style>
        .campo {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .campo label {
            width: 150px;
            font-weight: bold;
        }

        .campo input, .campo select {
            flex: 1;
            padding: 8px;
            max-width: 300px;
        }
        </style>
    </head>
    <body>
        <div class="w3-display-container">
            <img src="banner.png" alt="madeiras" style="width:100%" class="w3-opacity">
            <div class="w3-display-middle w3-large" style="text-shadow:1px 1px 0 #444">
                <h1>Madeireira e Cia Ltda</h1>
                <p>O melhor lugar para comprar madeiras!</p>
            </div>
        </div>

        <div class="w3-container w3-padding-16">
            <!-- Formulario para coleta dos dados -->
            <form method="POST" action="">
                <div class="campo">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="campo">
                    <label for="valorCompra">Valor da Compra:</label>
                    <input type="number" step="0.01" id="valorCompra" name="valorCompra" required>
                </div>

                <div class="campo">
                    <label for="formaPagamento">Pagamento:</label>
                    <select id="formaPagamento" name="formaPagamento" required>
                        <option value="cartaoCredito">Cartão de Crédito</option>
                        <option value="boleto">Boleto (8% desc.)</option>
                        <option value="deposito">Depósito (10% desc.)</option>
                    </select>
                </div>

                <button type="submit" class="w3-button w3-blue">Calcular</button>
            </form>

            <br>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $valorCompra = (float) $_POST["valorCompra"];
    $formaPagamento = $_POST["formaPagamento"];
    $desconto = 0;

    if ($formaPagamento == "cartaoCredito") {
        $desconto = 0;
        $valorFinal = $valorCompra;
        $mensagem = "Olá $nome, sua compra de R$ " . number_format($valorCompra, 2, ',', '.') . " foi realizada com cartão de crédito. Não há desconto. Total: R$ " . number_format($valorFinal, 2, ',', '.');
    } elseif ($formaPagamento == "boleto") {
        $desconto = $valorCompra * 0.08;
        $valorFinal = $valorCompra - $desconto;
        $mensagem = "Olá $nome, sua compra de R$ " . number_format($valorCompra, 2, ',', '.') . " teve desconto de R$ " . number_format($desconto, 2, ',', '.') . " (8%). Valor final: R$ " . number_format($valorFinal, 2, ',', '.');
    } elseif ($formaPagamento == "deposito") {
        $desconto = $valorCompra * 0.10;
        $valorFinal = $valorCompra - $desconto;
        $mensagem = "Olá $nome, sua compra de R$ " . number_format($valorCompra, 2, ',', '.') . " teve desconto de R$ " . number_format($desconto, 2, ',', '.') . " (10%). Valor final: R$ " . number_format($valorFinal, 2, ',', '.');
    } else {
        $mensagem = "Forma de pagamento inválida.";
    }

    echo "<div class='w3-panel w3-green w3-padding'>$mensagem</div>";
}
?>
        </div>
    </body>
</html>
