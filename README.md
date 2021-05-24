# Plugin

Plugin feito como parte de requisito para vaga de desenvolvedor laravel

## Installation

Use o instalador de pacotes [composer](https://getcomposer.org/) para instalar o pacote plugin.

```bash
composer require ronan/plugin
```

## Usage
Para uma instalação [Laravel](https://laravel.com/):

No arquivo config/app.php acrescente dentro de providers:
```python
'providers' => [
.
.
.
ronannc\plugin\PluginServiceProvider::class,
]
```
Depois execute o comando:
```python
php artisan migrate
```

Pronto, plugin esta pronto para ser usado.

Voce pode usar a rota /config para visualizar as configurações(headers -> client-key, client-code) já cadastradas.

A rota /client retorna o resultado da requisição em api-sandbox.fpay.me/clientes. Voce pode usar os filtros na tela como parâmetros da requisição.

A rota /plots-sale retorna o resultado da requisição em api-sandbox.fpay.me/vendas. Voce pode usar os filtros na tela como parâmetros da requisição.

É fornecido um menu superior para facilitar a navegação pelas telas.

## License
[MIT](https://choosealicense.com/licenses/mit/)
