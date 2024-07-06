
#  CAMPANHA RIMA

  

## Descrição

Um website básico utilizado pela https://grupoconstrufacil.com.br em uma
campanha que concedia condições exclusivos a funcionários da 
**RIMA industrial**  

  

## Tecnologias Utilizadas

  

-  **Linguagem de Programação**: PHP 8.2.4

-  **Banco de Dados**: MySQL.

-  **Bibliotecas principais**: coffeecode/datalayer ,coffeecode/router.

  
  

## Funcionalidades Principais


-  **Gerar cupom de desconto**: Solicita um cadastro básico de usuário
e gera cupom de desconto para o cliente usar na loja

-  **Listagem de clientes**: Uma rota autenticada que lista os clientes que cadastraram na promoção para receberem ofertas via WhatsApp


## Configuração e Instalação

  

1.  **Clone o repositório**:

```sh

git clone https://github.com/VictorSnt/campanha_rima.git

cd campanha_rima

```

2.  **Instale as Dependências**:

```sh

composer install

```

3.  **Configure as variáveis de ambiente**:

Crie um arquivo `.env` baseado no arquivo `.env.example` e configure as variáveis necessárias.

## Uso

Ao clonar o repositório acesse http://localhost/ativar_desconto e apos 
o primeiro cadastro faça o teste das funcionalidades