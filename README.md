PF - Conversor de Moedas
Este é um conversor de moedas simples desenvolvido em PHP, HTML e CSS. Ele permite ao usuário converter valores entre diferentes moedas usando taxas de câmbio predefinidas ou personalizadas. O projeto incorpora conceitos de programação funcional, como funções puras, imutabilidade e funções de ordem superior.

Funcionalidades
Entrada de Dados: Permite ao usuário inserir o valor que deseja converter.
Seleção de Moedas: Oferece uma lista de moedas para o usuário escolher a moeda de origem e destino.
Taxa de Câmbio: Aplica uma taxa de câmbio predefinida para cada par de moedas, além de permitir que o usuário insira uma taxa personalizada, se preferir.
Validação de Entrada: Verifica se o valor inserido é numérico e positivo antes de realizar a conversão.
Conversão de Moeda: Utiliza uma função pura para realizar a conversão e exibe o valor convertido ao usuário.
Histórico de Conversões: Armazena um histórico das conversões realizadas na sessão, permitindo que o usuário visualize e limpe o histórico.
Conceitos de Programação Funcional Aplicados
Funções Puras:

converterMoeda: Calcula o valor convertido sem modificar o estado externo ou variáveis globais.
validateInput: Valida o valor inserido e retorna true ou false, garantindo pureza na lógica de validação.
Imutabilidade:

As variáveis de entrada, como amount, from_currency, to_currency e exchange_rate, são tratadas como imutáveis. A função converterMoeda cria um novo valor convertido, sem alterar o valor original.
Funções de Ordem Superior:

A função array_map é usada para formatar valores no histórico, assegurando que o estado não seja alterado diretamente.
Pré-requisitos
Para executar este projeto, é necessário um servidor PHP, como o XAMPP.

Instruções de Execução
Faça o download do código-fonte ou clone o repositório:
bash
Copiar código
git clone https://github.com/viniciusdaveigaa/PF.git
Coloque os arquivos no diretório adequado para um servidor PHP (por exemplo, htdocs no XAMPP).
Abra o navegador e acesse http://localhost/PF/index.php.
Estrutura do Projeto
index.php: Contém o HTML e a lógica PHP para realizar a conversão e gerenciar o histórico.
style.css: Arquivo de estilos que define o layout da interface, com um fundo preto e botões azuis para uma aparência visual moderna e atraente.
Exemplo de Uso
Entrada: 100 USD para EUR com uma taxa de câmbio de 0.85.
Saída: Valor convertido: 85.00 EUR.

O único problema é que eu decidi não fazer uma integração com uma API para que os valores das moedas sejam atualizados em tempo real.