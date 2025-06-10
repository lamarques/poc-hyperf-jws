<?php
// Endpoint para GET /pix?token=<pixUrlAccessToken> que retorna um JWS assinado
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;

// Carrega a chave privada para assinar o JWS
$privateKey = file_get_contents(__DIR__ . '/../certs/certs/private.pem');

// Simula a extração do token da URL (?token=...)
$pixUrlAccessToken = $_GET['token'] ?? 'fake-uuid-1234';

// Monta o payload conforme exemplo BACEN
$payload = [
    "calendario" => [
        "criacao" => gmdate("Y-m-d\TH:i:s\Z"),
        "apresentacao" => gmdate("Y-m-d\TH:i:s\Z"),
        "expiracao" => "3600"
    ],
    "txid" => $pixUrlAccessToken,
    "revisao" => "1",
    "status" => "ATIVA",
    "valor" => [
        "original" => "500.00"
    ],
    "chave" => "chave-exemplo",
    "solicitacaoPagador" => "Informar CPF/CNPJ do pagador",
    "infoAdicionais" => [
        [
            "nome" => "campo1",
            "valor" => "valor1"
        ]
    ]
];

// Cabeçalho JWS conforme BACEN (exemplo simplificado)
$header = [
    'alg' => 'RS256',
    'typ' => 'JWT',
    'kid' => '2025-06-10'
];

// Gera o JWS
$jws = JWT::encode($payload, $privateKey, 'RS256', null, $header);

// Responde como application/jose
header('Content-Type: application/jose');
echo $jws;