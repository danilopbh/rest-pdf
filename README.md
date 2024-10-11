### 🔧 Instalação e Execução

Passo-a-passo para instalar e executar a aplicação:

```
1 - execute o comando: composer install;
2 - execute o comando: symfony serve;
3 - execute o comando: php bin/console make:migration para criar a migração;
4 - execute o comando: php bin/console doctrine:migrations:migrate para executar a aplicação;
5 - execute o comando: php bin/console doctrine:fixtures:load para popular as tabelas cda_siatu e contribuinte_siatu criadas;
6 - com o Postman devidamente instalado e aberto, crie um endpoint com a seguinte url: https://localhost:8000/api/sync-data usando o método POST para que os dados sejam sincronizados com as tabelas cda_supp e contribuinte_supp
7 - para gerar um pdf de uma cda específica, basta criar e acessar um novo endpoint com a seguinte url: https://localhost:8000/export/pdf/id-da-cda utilizando o método GET
```