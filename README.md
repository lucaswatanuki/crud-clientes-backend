# CRUD Clientes

Esse projeto foi desenvolvido usando PHP.

## Pré-requisitos

Antes de rodar o projeto, certifique-se de que tenha uma instância de banco de dados MySQL funcional. A estrutura de tabelas encontra-se dentro do arquivo database.sql.

## Conexão com banco de dados

Configure as variáveis de ambiente (PHPStorm possui essa configuração) para se conectar com as credenciais do seu banco de dados local.
<br><br>
Também é possível substituir as variáveis de ambiente de maneira "hardcoded" pelo arquivo conexao.php, onde você incluirá as credenciais necessárias para conexão com o seu banco local.

## Observações

Configure o seu servidor web para rodar o projeto na porta local 8080, tendo em vista que o frontend desenvolvido (https://github.com/lucaswatanuki/crud-clientes-frontend) está apontando para essa porta ao rodar em modo de desenvolvimento.

## Heroku

A aplicação completa está hospedada no heroku, caso deseje visualizar o sistema, acesse: https://crud-clientes-frontend.herokuapp.com/