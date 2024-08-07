# Hestia

:brazil: Deusa do coração, da bondade e da família.

:us: Greek god of hearth and family.

![alt text](./family.gif)

## Objetivo / Goal

:brazil: Um projeto opensource para indexação de ongs com objetivo de ser regional, possibilitando ongs serem
cadastradas, encontradas e ganharem visibilidade para usuários que buscam serviços que elas podem oferecer.

:us: An opensource project to index all regional NGOs that cares about people or animals, and make the access of them
more easy.

## Como Usar / How to Use

### Cadastrar usuários

*POST* - `/auth/register`

### Aceitar - Recusar usuários

*POST* - `/users/authorize`

### Buscar ongs X KMs distancia

*GET* - `/ongs`

## Como testar

```bash
php artisan migrate --seed
```

Para preencher o banco de dados com algumas ongs com endereços da região sul do país e assim você pode testar usando uma
coordenada próxima ou distante.
