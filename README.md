# PF
Programação Funcional

Conversor de Moedas
Este é um conversor de moedas simples desenvolvido em PHP, HTML e CSS. O objetivo é permitir que o usuário converta um valor entre duas moedas usando uma taxa de câmbio fornecida. O projeto utiliza conceitos de programação funcional, incluindo funções puras, imutabilidade e funções de ordem superior.

Funcionalidades
Entrada de Valor: O usuário pode inserir o valor que deseja converter.
Seleção de Moedas: O usuário seleciona as moedas de origem e destino para a conversão.
Taxa de Câmbio: O usuário fornece a taxa de câmbio para realizar a conversão.
Validação de Entrada: O programa valida se o valor inserido é numérico e positivo.
Conversão de Moeda: O programa realiza a conversão usando funções puras e exibe o valor convertido.
Conceitos de Programação Funcional Aplicados
Funções Puras:

A função convertCurrency realiza a conversão do valor com a taxa de câmbio e é uma função pura, pois não altera o estado externo nem modifica variáveis globais.
A função validateInput verifica a validade do valor inserido e também é uma função pura, retornando true ou false sem modificar variáveis externas.
Imutabilidade:

As variáveis de entrada, como amount, from_currency, to_currency e exchange_rate, são tratadas como imutáveis. A função convertCurrency cria um novo valor convertido sem alterar o valor inicial.
Funções de Ordem Superior:

validateInput e convertCurrency são reutilizadas como funções independentes, o que permite compor e reutilizar essas funções para diferentes cenários.
Pré-requisitos
Para executar este projeto, é necessário um servidor que suporte PHP (por exemplo, XAMPP).

Instruções de Execução
Faça o download do código-fonte ou clone o repositório:

bash
Copiar código
git clone https://github.com/viniciusdaveigaa/PF.git
Coloque os arquivos em um servidor PHP (pasta htdocs do XAMPP, por exemplo).

Abra o navegador e acesse http://localhost/PF/index.php.

Estrutura do Projeto
index.php: Contém o HTML e o PHP para lógica de conversão.
style.css: Arquivo de estilos para formatar a interface com fundo preto e botões azuis.
Exemplo de Uso
Entrada: 100 USD para EUR com taxa de câmbio de 0.85.
Saída: Valor convertido: 85.00 EUR.