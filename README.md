# POC - Geração de JWS para QRCode PIX Dinâmico com Hyperf/PHP

## Descrição

Esta POC demonstra como gerar e validar um JWS (JSON Web Signature) a partir de um endpoint que simula a resposta exigida pelo padrão do BACEN para consulta de QRCode dinâmico do PIX.

## Stack Utilizada

- **PHP 8.2**
- **Hyperf** (framework)
- **Swoole** (servidor assíncrono)
- **firebase/php-jwt** (assinatura/validação JWS)
- **Docker/Docker Compose**

---

## Como rodar

1. Gere as chaves (apenas na primeira vez):

    ```bash
    bash certs/generate-certs.sh
    ```

2. Suba o ambiente Docker:

    ```bash
    docker-compose up --build
    ```

3. Faça uma requisição de teste para obter um JWS:

    ```bash
    curl -X GET 'http://localhost:9501/pix?token=<SEU_UUID_AQUI>' -H 'accept: application/jose'
    ```

    O retorno será um JWS (ex: `eyJhbGciOi...`).

---

## Como validar o JWS

### Validação via script PHP

1. Salve o JWS retornado em uma variável ou arquivo.
2. Execute:

    ```bash
    php tools/validate_jws.php "<JWS_AQUI>"
    ```

    Saída esperada:
    ```
    JWS VÁLIDO!
    Payload:
    stdClass Object
    (
        [calendario] => stdClass Object
            (
                ...
            )
        ...
    )
    ```


