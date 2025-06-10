#!/bin/bash
# Gera um certificado autoassinado para uso na POC (RS256)
# Gera private.pem (chave privada) e public.pem (chave pública)
mkdir -p certs
openssl genpkey -algorithm RSA -out certs/private.pem -pkeyopt rsa_keygen_bits:2048
openssl rsa -pubout -in certs/private.pem -out certs/public.pem
echo "Chaves geradas em certs/private.pem e certs/public.pem"