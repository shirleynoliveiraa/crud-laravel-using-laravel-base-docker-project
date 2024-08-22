# Laravel Docker Project

Este projeto é uma aplicação Laravel configurada para rodar em um ambiente Docker. Este README fornece instruções para configurar, construir, e executar o projeto em um ambiente local.

## Pré-requisitos

Antes de começar, certifique-se de ter o seguinte instalado na sua máquina:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Make](https://www.gnu.org/software/make/) (opcional, mas recomendado para usar os comandos facilitados)

## Configuração Inicial

### 1. Clone o repositório

Clone o repositório do projeto para a sua máquina local e abra o diretorio do projeto:

```
git clone https://github.com/shirleynoliveiraa/crud-laravel-using-laravel-base-docker-project.git

cd crud-laravel-using-laravel-base-docker-project
```

### 2. Copie o arquivo .env.example para .env dentro da pasta laravel-app:
```
make setup-env
```
Ou manualmente:
```
cp ./laravel-app/.env.example ./laravel-app/.env
```

### 3. Construa e inicie os containers Docker:
```
make setup
```

Isso executará os seguintes passos:

- make build: Compila as imagens Docker sem usar cache.
- make up: Inicia os containers em modo "detached" (em segundo plano).
- make composer-update: Atualiza as dependências do Composer.

### 4. Execute as migrações e os seeders para configurar o banco de dados:
```
make data
```

### 5. Agora você pode acessar a aplicação
```
http://localhost:9000
```

## Comandos Úteis
### Para parar os containers sem removê-los:
```
make stop
```

### Para limpar tudo (containers, volumes, imagens, cache, etc.) e reiniciar o projeto do zero:
```
make reset
```

## Estrutura do Projeto
- laravel-app: Contém o código-fonte da aplicação Laravel.
- docker-compose.yml: Define a configuração dos serviços Docker.
- Dockerfile: Contém as configurações do docker
- Makefile: Automatiza a execução dos comandos mais comuns.


## Troubleshooting
### Se encontrar problemas de permissões, tente rodar os seguintes comandos:
```
sudo chown -R $USER:$USER ./laravel-app
```

