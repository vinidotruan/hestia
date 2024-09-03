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

### Dependências

Tenha certeza que todas as depedências estão instaladas, a princípio você só vai precisar rodar esse comando.
Mas lembre-se de ter uma base de dados instalada e configurar o .env corretamente.

```bash
composer install
```
## Como testar

```bash
php artisan migrate --seed
```

Para preencher o banco de dados com algumas ongs com endereços da região sul do país e assim você pode testar usando uma
coordenada próxima ou distante.

### Endpoints

Para consultar os endpoints você tem dois caminhos, um deles usando `php artisan route:list` ou pode ir até `localhost:8000/request-docs` onde você terá uma melhor visão de todos os endpoints da aplicação.

# TODO 
- Signup
- Account Settings
- Account pictures
- Singular page - ongs
- Busca por tags de servicos prestados
- Listar servicos prestados
