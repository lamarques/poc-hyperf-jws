# Documento de Decisão - Geração de JWS para PIX Dinâmico

## Objetivo

Avaliar alternativas e justificar a arquitetura e stack escolhida para a geração/validação de JWS em endpoints de QRCode dinâmico do PIX conforme especificação BACEN.

## Alternativas Consideradas

| Alternativa             | Prós                                                        | Contras                                   |
|-------------------------|-------------------------------------------------------------|-------------------------------------------|
| **PHP + Hyperf + Swoole**  | Já na stack, performance, fácil integração                | Complexidade adicional do Swoole           |
| **PHP puro + Slim**     | Simplicidade, fácil prototipação                            | Menos performático para alto volume        |
| **NodeJS + Express**    | Ecossistema JWT maduro, exemplos BACEN                      | Stack diferente, curva de aprendizado      |
| **Go + net/http**       | Performance e uso em fintechs                               | Stack diferente, curva de aprendizado      |

## Decisão

Optou-se por **PHP + Hyperf + Swoole** para alinhar com a stack existente e por permitir fácil evolução para produção.

## Pontos de Atenção

- Uso de certificado ICP-Brasil para produção (aqui, autoassinado para POC)
- Validação cruzada em outros ambientes (Node, Go) recomendada para interoperabilidade

## Próximos Passos

- Implementar exemplos de validação
- Testar interoperabilidade