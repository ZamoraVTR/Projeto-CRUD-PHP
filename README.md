# Documentação do Projeto: Aplicação PHP CRUD

## Visão Geral

Este projeto consiste em uma aplicação PHP que realiza operações CRUD (Criar, Ler, Atualizar, Deletar) seguindo a arquitetura MVC (Model-View-Controller). A aplicação permite aos usuários gerenciar uma lista de usuários, incluindo nomes, emails e cores associadas.

## Sumário

1. [Início Rápido](#início-rápido)
    - [Pré-requisitos](#pré-requisitos)
    - [Instalação](#instalação)
2. [Estrutura do Projeto](#estrutura-do-projeto)
    - [Controladores](#controladores)
    - [Models](#models)
    - [Views](#views)
3. [Utilização](#utilização)
    - [Criar um Usuário](#criar-um-usuário)
    - [Editar um Usuário](#editar-um-usuário)
    - [Excluir um Usuário](#excluir-um-usuário)
4. [Testes](#testes)
5. [Dependências](#dependências)


## Início Rápido

### Pré-requisitos

- PHP (>= 7.0)
- SQLite

### Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/ZamoraVTR/Projeto-CRUD-PHP
    ```

2. Configure o banco de dados SQLite:

    ```bash
    cd projeto-crud-php
    touch database/db.sqlite
    ```

3. Execute a aplicação:

    ```bash
    php -S 0.0.0.0:7070
    ```

4. Abra o navegador:

    Acesse [http://localhost:7070](http://localhost:7070)

## Estrutura do Projeto

### Controladores

- **UserController.php**: Gerencia ações relacionadas a usuários.

### Models

- **Connection.php**: Realiza a conexão com o banco de dados.

- **ColorModel.php**: Modelagem das operações relacionadas a cores.

- **UserModel.php**: Modelagem das operações relacionadas a usuários.

### Views

- **edit.php**: Página para editar informações de um usuário.

- **index.php**: Página principal que lista os usuários.

## Utilização

### Criar um Usuário

- Preencha o formulário na página principal com o nome, e-mail e cores desejadas.

### Editar um Usuário

- Clique no botão "Editar" ao lado do usuário na lista para modificar suas informações.

### Excluir um Usuário

- Clique no botão "Excluir" ao lado do usuário na lista para remover o registro.

## Testes

Este projeto inclui testes unitários básicos para verificar a funcionalidade central das classes `Connection`, `UserModel` e `ColorModel`. Para executar os testes, siga as instruções abaixo:

1. Certifique-se de ter o PHP instalado no seu sistema.

2. Navegue até o diretório onde o arquivo `Tests.php` está localizado.

3. Execute o comando:

    ```bash
    php Tests.php
    ```

4. Observe as mensagens de saída no terminal para verificar se os testes foram bem-sucedidos ou se houve falhas.

Esses testes são uma base inicial e podem ser expandidos à medida que o projeto evolui.

## Dependências

- Bootstrap (front-end)
- jQuery (front-end)
