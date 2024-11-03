<?php
session_start();

// inicia 
if (!isset($_SESSION['conversion_history'])) {
    $_SESSION['conversion_history'] = [];
}

// valida entrada
function validateInput($value) {
    return is_numeric($value) && $value > 0;
}

// Limpa hist
if (isset($_POST['clear_history'])) {
    $_SESSION['conversion_history'] = [];
}

if (isset($_POST['convert'])) {
    $amount = str_replace(['.', ','], ['', '.'], $_POST['amount']);
    $exchange_rate = str_replace(['.', ','], ['', '.'], $_POST['exchange_rate']);
    $from_currency = $_POST['from_currency'];
    $to_currency = $_POST['to_currency'];

    if (validateInput($amount) && validateInput($exchange_rate)) {
        $converted_amount = $amount * $exchange_rate;
        $formatted_converted_amount = number_format($converted_amount, 2, ',', '.');
        $formatted_amount = number_format($amount, 2, ',', '.');
        
        // histórico
        $conversion_record = [
            'amount' => $formatted_amount,
            'from_currency' => $from_currency,
            'to_currency' => $to_currency,
            'exchange_rate' => number_format($exchange_rate, 2, ',', '.'),
            'converted_amount' => $formatted_converted_amount
        ];
        $_SESSION['conversion_history'][] = $conversion_record;
    } else {
        echo "<p>Por favor, insira valores numéricos positivos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // máscara de moeda no valor
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, "");
            value = (value / 100).toFixed(2) + "";
            value = value.replace(".", ",");
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            input.value = value;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="converter">
            <h1>Conversor de Moedas</h1>
            <form method="POST" action="">
                <label for="amount">Valor:</label>
                <input type="text" name="amount" id="amount" onkeyup="formatCurrency(this)" required style="color: black;">
                
                <label for="from_currency">De:</label>
                <select name="from_currency" id="from_currency">
                    <option value="USD">Dólar (USD)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="BRL">Real (BRL)</option>
                    <option value="GBP">Libra Esterlina (GBP)</option>
                    <option value="JPY">Iene Japonês (JPY)</option>
                </select>

                <label for="to_currency">Para:</label>
                <select name="to_currency" id="to_currency">
                    <option value="USD">Dólar (USD)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="BRL">Real (BRL)</option>
                    <option value="GBP">Libra Esterlina (GBP)</option>
                    <option value="JPY">Iene Japonês (JPY)</option>
                </select>

                <label for="exchange_rate">Taxa de Câmbio:</label>
                <input type="text" name="exchange_rate" id="exchange_rate" placeholder="Exemplo: 5,25" onkeyup="formatCurrency(this)" required style="color: black;">

                <button type="submit" name="convert">Converter</button>
            </form>

            <?php
            if (isset($formatted_converted_amount)) {
                echo "<p>Valor convertido de $from_currency para $to_currency: $formatted_converted_amount</p>";
            }
            ?>
        </div>
        <div class="history">
            <h2>Histórico de Conversões</h2>
            <?php if (!empty($_SESSION['conversion_history'])): ?>
                <ul>
                    <?php foreach ($_SESSION['conversion_history'] as $record): ?>
                        <li>
                            <?= "{$record['amount']} {$record['from_currency']} para {$record['to_currency']} com taxa {$record['exchange_rate']} - Valor: {$record['converted_amount']}" ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <form method="POST" action="">
                    <button type="submit" name="clear_history">Limpar Histórico</button>
                </form>
            <?php else: ?>
                <p>Nenhuma conversão realizada ainda.</p>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <p>Desenvolvido por Vinícius da Veiga</p>
        </div>
    </footer>

</body>
</html>
