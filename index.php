<?php
session_start();

if (!isset($_SESSION['conversion_history'])) {
    $_SESSION['conversion_history'] = [];
}

// taxas de câmbio fixas
$exchange_rates = [
    'USD_BRL' => 5.70,
    'EUR_BRL' => 6.20,
    'GBP_BRL' => 7.50,
    'JPY_BRL' => 0.05,
    'BRL_USD' => 0.18,
    'BRL_EUR' => 0.16,
    'BRL_GBP' => 0.13,
    'BRL_JPY' => 20.00,
    'USD_EUR' => 0.88,
    'USD_GBP' => 0.74,
    'USD_JPY' => 114.00,
    'EUR_USD' => 1.14,
    'GBP_USD' => 1.36,
    'JPY_USD' => 0.0088,
];

function validateInput($value) {
    return is_numeric($value) && $value > 0;
}

function converterMoeda($amount, $exchange_rate) {
    return $amount * $exchange_rate;
}

if (isset($_POST['clear_history'])) {
    $_SESSION['conversion_history'] = [];
}

if (isset($_POST['convert'])) {
    $amount = str_replace(['.', ','], ['', '.'], $_POST['amount']);
    $from_currency = $_POST['from_currency'];
    $to_currency = $_POST['to_currency'];
    $exchange_key = "{$from_currency}_{$to_currency}";
    $use_custom_rate = isset($_POST['use_custom_rate']);
    $custom_exchange_rate = str_replace(['.', ','], ['', '.'], $_POST['exchange_rate']);

    if ($use_custom_rate && validateInput($custom_exchange_rate)) {
        $exchange_rate = $custom_exchange_rate;
    } elseif (isset($exchange_rates[$exchange_key])) {
        $exchange_rate = $exchange_rates[$exchange_key];
    } else {
        echo "<p>Não há taxa de câmbio disponível para essas moedas.</p>";
        $exchange_rate = null;
    }

    if (validateInput($amount) && $exchange_rate) {
        $converted_amount = converterMoeda($amount, $exchange_rate);
        $formatted_converted_amount = number_format($converted_amount, 2, ',', '.');
        $formatted_amount = number_format($amount, 2, ',', '.');
        $conversion_record = [
            'amount' => $formatted_amount,
            'from_currency' => $from_currency,
            'to_currency' => $to_currency,
            'exchange_rate' => number_format($exchange_rate, 2, ',', '.'),
            'converted_amount' => $formatted_converted_amount
        ];
        $_SESSION['conversion_history'][] = array_map(fn($item) => $item, $conversion_record);
    } else {
        echo "<p>Por favor, insira um valor válido e selecione moedas compatíveis para conversão.</p>";
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
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, "");
            value = (value / 100).toFixed(2) + "";
            value = value.replace(".", ",");
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            input.value = value;
        }

        function toggleCustomRate() {
            const customRateField = document.getElementById("customRateField");
            const useCustomRate = document.getElementById("use_custom_rate").checked;
            customRateField.style.display = useCustomRate ? "block" : "none";
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

                <label>
                    <input type="checkbox" name="use_custom_rate" id="use_custom_rate" onclick="toggleCustomRate()">
                    Usar taxa de câmbio personalizada
                </label>

                <div id="customRateField" style="display: none;">
                    <label for="exchange_rate">Taxa de Câmbio:</label>
                    <input type="text" name="exchange_rate" id="exchange_rate" onkeyup="formatCurrency(this)" style="color: black;">
                </div>

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
