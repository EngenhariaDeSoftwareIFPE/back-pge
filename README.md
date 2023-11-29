<div align='center'>
    <img src='public/pge2.png'>
</div>

# Portal de Gerenciamento de Estágios - PGE

O Portal de Gerenciamento de Estágio (PGE) é uma plataforma web revolucionária que automatiza o processo de gerenciamento de estágios. Ele capacita os estagiários a carregar documentos e comprovantes essenciais, tornando todo o processo mais eficiente. Essa abordagem inovadora simplifica o fluxo de trabalho, tornando mais fácil para os coordenadores de estágio e professores orientadores acompanharem o progresso, ao mesmo tempo em que facilita a validação final pelo diretor geral de estágios. O Sistema PGE representa um avanço significativo na automatização de todo o processo de estágio no IFPE - Campus Belo Jardim, abrangendo os cursos de Licenciatura em Música, Técnico em Agropecuária e Técnico em Agroindústria.

<br>

## Pré-requisitos

Certifique-se de ter os seguintes requisitos instalados em sua máquina:

- PHP
- Composer
- Banco de dados (por exemplo, MySQL)

<br>

## Instalação

<br>

1. Clone o repositório:

    ```bash
    git clone https://github.com/EngenhariaDeSoftwareIFPE/back-pge.git
    ```

2. Instale as dependências do Composer:

    ```bash
    composer install
    ```

3. Copie o arquivo de configuração do ambiente:

    ```bash
    cp .env.example .env
    ```

4. Configure as variáveis de ambiente no arquivo `.env` com as informações adequadas, incluindo a configuração do banco de dados.

5. Gere a chave de aplicativo:

    ```bash
    php artisan key:generate
    ```

6. Execute as migrações do banco de dados:

    ```bash
    php artisan migrate
    ```

7. Inicie o servidor de desenvolvimento:

    ```bash
    php artisan serve
    ```

<br>

A API estará executando em [http://localhost:8000](http://localhost:8000).

<br>

## Uso

Para melhor visualização do uso e do funcionamento da API, tanto quanto suas rotas, consulte a documentação técnica feita pelo Swagger.

<div align='right'>
    <br><br><br>
    <img src='public/pge1.png'>
</div>
