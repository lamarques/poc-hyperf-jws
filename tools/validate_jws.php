<?php
// Script para validar um JWS gerado pela POC usando a chave pública.
// Uso: php tools/validate_jws.php <jws>

if ($argc < 2) {
    echo "Uso: php tools/validate_jws.php <jws>\n";
    exit(1);
}

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$jws = $argv[1];

// Carrega a chave pública
$publicKey = file_get_contents(__DIR__ . '/../certs/public.pem');

try {
    $decoded = JWT::decode($jws, new Key($publicKey, 'RS256'));
    echo "JWS VÁLIDO!\nPayload:\n";
    print_r($decoded);
} catch (Exception $e) {
    echo "JWS INVÁLIDO: " . $e->getMessage() . "\n";
    exit(2);
}