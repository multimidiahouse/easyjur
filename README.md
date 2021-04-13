## Instalação

- Primeiro Passo
Insira os dados de configuração do banco de dados no arquivo *base.php* dentro da pasta */models*. Neste arquivo temos as constantes de configuração do banco de dados MySQL. As constantes são:

 $DRIVER
 Por padrão deixamos definido como *mysql*
 
 $HOST
 Edite essa constante inserindo o domínio e a porta de conexão com o servidor MySQL. Exemplo: localhost:3306
 
 $BASE
 Edite essa constante inserindo o nome do banco de dados que deverá ser criado e utilizado para armazenar as informações do sistema de cadastro. Exemplo: easyjur
 
 $USER
 Edite essa constante inserindo o usuário do banco de dados. Exemplo: root
 
 $PASS
 Edite essa constante inserindo a senha do banco de dados.
 
- Próximo Passo
Execute o comando *php -S localhost:8000* para iniciar o servidor web embutido e em seguida abra o seu navegador e digite (http://localhost:8000) na barra de endereços.

## Pré Requisitos

PHP 7.3
MySQL 8.0