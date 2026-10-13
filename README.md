# Desafio de Controle de Estoque

Projeto desenvolvido como um **desafio prático de programação**, com o objetivo de exercitar a manipulação de arquivos JSON utilizando PHP.

O desafio consiste em realizar movimentações de entrada e saída de produtos em estoque, atualizar as quantidades disponíveis e registrar um histórico das operações realizadas.

## 📌 Objetivo

O principal objetivo foi praticar conceitos de desenvolvimento utilizando **PHP e JSON**, trabalhando com leitura, alteração e gravação de dados sem a utilização de banco de dados.

## ⚙️ Funcionalidades

O projeto permite:

- Ler produtos armazenados em um arquivo JSON;
- Selecionar um produto;
- Registrar entrada de produtos no estoque;
- Registrar saída de produtos;
- Validar se existe quantidade suficiente antes de realizar uma saída;
- Atualizar automaticamente o estoque;
- Registrar o estoque anterior e o estoque final;
- Armazenar um histórico das movimentações;
- Registrar data e hora da movimentação.

## 📄 Estrutura dos dados

O arquivo JSON utilizado no desafio possui informações relacionadas a:

- Vendas;
- Produtos em estoque;
- Histórico de movimentações.

Exemplo de produto:

```json
{
    "codigoProduto": 101,
    "descricaoProduto": "Caneta Azul",
    "estoque": 160
}
```

Exemplo de movimentação:

```json
{
    "codigoProduto": 101,
    "descricaoProduto": "Caneta Azul",
    "tipoMovimentacao": "Entrada",
    "quantidadeMovimentada": 10,
    "estoqueAnterior": 150,
    "estoqueFinal": 160
}
```

## 💻 Tecnologias utilizadas

- PHP
- JSON
- HTML
- CSS
- JavaScript
- jQuery
- Bootstrap

## 🧠 Conceitos praticados

Durante o desafio foram utilizados conceitos como:

- Leitura de arquivos;
- Manipulação de JSON;
- Arrays em PHP;
- Estruturas condicionais;
- Estruturas de repetição;
- Formulários HTML;
- Requisições POST;
- Validação de dados;
- Manipulação de estoque;
- Registro de histórico;
- Escrita e atualização de arquivos.

## ▶️ Como executar

É necessário possuir um ambiente com suporte a PHP, como:

- XAMPP;
- WampServer;
- Servidor PHP local.

Clone o repositório:

```bash
git clone URL-DO-REPOSITORIO
```

Depois coloque o projeto em um ambiente PHP e acesse pelo navegador.

Exemplo utilizando XAMPP:

```text
C:\xampp\htdocs\nome-do-projeto
```

Depois acesse:

```text
http://localhost/nome-do-projeto
```

## 🎯 Contexto

Este projeto não foi desenvolvido como um sistema completo de gestão de estoque.

Ele foi criado como um **desafio de programação**, com foco em praticar a leitura e manipulação de dados armazenados em JSON utilizando PHP.

## 👨‍💻 Autor

**Vitor Hugo**

Estudante de **Ciência da Computação**.
