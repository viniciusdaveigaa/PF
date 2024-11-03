# PF
PF - Conversor de Moedas
Este é um conversor de moedas simples desenvolvido em PHP, HTML e CSS, com o objetivo de permitir ao usuário converter valores entre diferentes moedas usando taxas de câmbio predefinidas ou personalizadas. Este projeto incorpora conceitos de programação funcional, incluindo funções puras, imutabilidade e funções de ordem superior.

Funcionalidades
Entrada de Valor: O usuário pode inserir o valor que deseja converter.
Seleção de Moedas: O usuário seleciona as moedas de origem e destino para a conversão a partir de uma lista de opções.
Taxa de Câmbio: O programa oferece taxas de câmbio predefinidas, mas o usuário também pode fornecer uma taxa personalizada para a conversão.
Validação de Entrada: O programa valida se o valor inserido é numérico e positivo.
Conversão de Moeda: Realiza a conversão utilizando funções puras e exibe o valor convertido.
Histórico de Conversões: Mantém um histórico de conversões realizadas, permitindo limpar o histórico quando desejado.
Conceitos de Programação Funcional Aplicados
Funções Puras:

converterMoeda: realiza a conversão do valor com a taxa de câmbio e é uma função pura, pois não altera o estado externo nem modifica variáveis globais.
validateInput: verifica a validade do valor inserido e também é uma função pura, retornando true ou false sem modificar variáveis externas.
Imutabilidade:

As variáveis de entrada, como amount, from_currency, to_currency e exchange_rate, são tratadas como imutáveis. A função converterMoeda gera um novo valor convertido sem modificar o valor inicial.
Funções de Ordem Superior:

array_map é utilizado para formatar os valores no histórico de conversões de forma imutável.
Pré-requisitos
Para executar este projeto, é necessário um servidor que suporte PHP, como o XAMPP.

Instruções de Execução
Faça o download do código-fonte ou clone o repositório:
bash
Copiar código
git clone https://github.com/viniciusdaveigaa/PF.git
Coloque os arquivos em um servidor PHP (pasta htdocs do XAMPP, por exemplo).
Abra o navegador e acesse http://localhost/PF/index.php.
Estrutura do Projeto
index.php: Contém o HTML e o PHP para a lógica de conversão e histórico.
style.css: Arquivo de estilos que formata a interface com fundo preto e botões azuis para uma aparência moderna e atraente.