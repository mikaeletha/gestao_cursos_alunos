A seguir estão as instruções para rodar o projeto em diferentes ambientes. 

Requisitos de Sistema
Antes de começar, verifique se você tem os seguintes programas instalados:
    * PHP (versão 7.4 ou superior)
    * MySQL ou MariaDB
    * Apache ou Nginx (se não estiver usando o servidor embutido do PHP)
    * Git (para clonar o repositório)

Passo 1: Clonar o Repositório
Passo 2: Configuração do Banco de Dados
    * Importar o banco de dados
        Dentro do diretório do projeto, você encontrará um arquivo chamado dump.sql. Este arquivo contém as queries necessárias para criar e popular as tabelas do banco de dados.
        Execute o arquivo dump.sql no seu banco de dados MySQL ou MariaDB. 
    * Configurar o arquivo de conexão:
        Verifique a configuração de conexão do banco de dados no arquivo PHP responsável pela conexão com o banco em app/config/Database.php. Assegure-se de que os parâmetros como host, usuário, senha e banco de dados estão corretos.
Passo 3: Acessando a Aplicação
    Depois de configurar o ambiente e o banco de dados, acesse a aplicação