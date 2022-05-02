### Requisitos

Será necessário ter instalado na máquina:
- [Aplicação do projeto de teste](https://github.com/ejuniorls/teste-app-l5).
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

### Rotas da API - Endpoints

#### Listar todos os contatos
`GET` http://localhost:8000/api/contacts

#### Listar um contato pelo id
`GET` http://localhost:8000/api/contacts/1

#### Criar contato
`POST` http://localhost:8080/api/contacts

Body - json
```bash
{
"name": "André José",
"email": "andre@jose.com",
"phone": "987098234",
"cpf": "09923472839"
}
```
#### Atualizar contato
`PUT` http://localhost:8080/api/contacts/3

Body - json
```bash
{
"name": "André José",
"email": "andre@jose.com",
"phone": "987098234",
"cpf": "09923472839"
}
```
#### Excluir contato
`DELETE` http://localhost:8080/api/contacts/1
