### Requisitos

Será necessário ter instalado na máquina:
- [Laragon](https://laragon.org/download/).
- Banco de dados MySql.

### Instalação
- Clone o projeto no diretório `www` do Laragon.
- Crie uma base no MySql (`l5_database`).

Abra o terminal no diretório do projeto e execute o comando abaixo:
```bash
composer install
```
Copie o arquivo `.env.example` e renomeie para `.env`. E preencha os dados abaixo:

```bash
DB_DATABASE=l5_database
DB_USERNAME=usuário
DB_PASSWORD=senha
```
Execute o comando abaixo para criar as tabelas no banco para a aplicação
```bash
php artisan migrate
```

Execute o comando abaixo para rodar a api. Precisa ser na porta informada.
```bash
php -S localhost:8000 -t public
```
