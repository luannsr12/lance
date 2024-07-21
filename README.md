## Biblioteca LANCE para futebol

> Essa biblioteca usa como base a API publica da SofaScore

## Instalação via composer

```bash
 composer require luannsr12/lance
```

#### Listar os torneios
 
```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Torneios;

    $torneios = new Torneios();

    $list = $torneios->list();

    echo '<pre>';
    var_dump($list);

```

#### Procurar torneio por nome

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Torneios;

    $torneios = new Torneios();

    $search = $torneios->search("Brasileirão Série A");

    echo '<pre>';
    var_dump($search);

```

#### Recuperar torneio pelo 'id'

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Torneios;

    $torneios = new Torneios();

    $result = $torneios->get(325); // get by id

    echo '<pre>';
    var_dump($result);

```

#### Logo do torneio

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Torneios;

    $torneios = new Torneios();

    $result = $torneios->getLogo(325); // get logo by id

    if($result !== NULL){
        echo "<img src='{$result}' />";
    }

```
