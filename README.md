### 🔧 Instalação e Execução

Passo-a-passo para instalar e executar a aplicação:

```
Backend:
1 - Execute o comando: composer install;
2 - Execute o comando: composer require fakerphp/faker para instalar o faker no seu projeto
3 - Execute o comando: composer require doctrine/orm para instalar a biblioteca orm do doctrine
4 - Execute o comando: composer require doctrine/doctrine-bundle para instalar o DoctrineBundle possibilitando a integração entre Doctrine ORM e o framework Symfony
5 - Execute o comando: composer require symfony/orm-pack para instalar um conjunto de pacotes que facilita a integração do doctrine ORM com o Symfony também. (opcional)
6 - Execute o comando: composer require tecnickcom/tcpdf para instalar a biblioteca tcpdf capaz de gerar os PDF´s na aplicação
7 - Execute o comando: symfony serve;
8 - Execute o comando: php bin/console make:migration para criar a migração;
9 - Execute o comando: php bin/console doctrine:migrations:migrate para executar a aplicação;
10 - Execute o comando: php bin/console doctrine:fixtures:load para popular as tabelas cda_siatu e contribuinte_siatu criadas;
11 - Com o Postman devidamente instalado e aberto, crie um endpoint com a seguinte url: https://localhost:8000/api/sync-data usando o método POST para que os dados sejam sincronizados com as tabelas cda_supp e contribuinte_supp
12 - Para gerar um pdf de uma cda específica, basta criar e acessar um novo endpoint com a seguinte url: https://localhost:8000/export/pdf/id-da-cda utilizando o método GET;
13 - Execute o comando: composer require nelmio/cors-bundle para instalar a dependência do cors possibilitando a conversa entre o Frontend e o Backend.

Foi implementado na Api uma automatização no processo de sincronização de dados entre tabelas, nas quais a partir de um horário específico, a rota de sincronia é chamada copiando os dados das tabelas de origem para as tabelas de destino.

Expressão Cron:
Para instalar e executar a biblioteca que interpreta o comando específico basta seguir os passos abaixo:
1 - Execute o comando: composer require dragonmantank/cron-expression para instalar a biblioteca que interpreta as expressões cron;
2 - Execute o comando: composer require symfony/console se vc não tiver com ele instalado no projeto ainda;
3 - Execute o comando a seguir para verificar se o comando configurado funciona corretamente: php bin/console app:sync-data;
4 - Abra o crontab do usuário com o comando: "crontab -e" e escolha um editor da lista;
5 - Adicione a linha com a CronExpression: 2 11 * * * /usr/bin/php /caminho/para/symfony-projeto/bin/console app:sync-data(essa cron expression executa as 11:02 da manhã por exemplo), salve as alterações e feche o arquivo;
6 - Para verificar os cron jobs ativos basta executar o seguinte comando: "crontab -l". Isso listará todos os cron jobs configurados para o usuário atual;
7 - Execute o comando: grep CRON /var/log/syslog para filtrar todas as entradas de cron;
8 - Depois que o cron job for executado, você poderá acompanhar a saída do log que será algo assim: Oct 12 11:02:01 my-computer CRON[12345]: (your-username) CMD (/usr/bin/php /caminho/para/symfony/bin/console app:sync-data);
9 - Para garantir que o cron job está funcionando corretamente, você pode executar manualmente o seguinte comando: /usr/bin/php /caminho/para/symfony/bin/console app:sync-data.

Frontend:
1 - Execute o comando: npm install -g @angular/cli caso você não possua o cli do angular instalado;
2 - Execute o comando: ng add @ngrx/store-devtools para instalar essa dependência no package.json;
3 - Execute o comando: npm start para executar o servidor do Frontend;
4 - (Opcional) execute o comando: ng version para verificar a versão do cli do Angular instalado na sua máquina.
```