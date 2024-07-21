## Biblioteca LANCE para futebol

> Essa biblioteca usa como base a API publica da SofaScore

## Instalação via composer

```bash
 composer require luannsr12/lance
```

#### Listar os campeonatos
 
```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Tournament;

    $tournament = new Tournament();

    $list = $tournament->list();

    echo '<pre>';
    var_dump($list);

```

#### Procurar torneio por nome

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Tournament;

    $tournament = new Tournament();

    $search = $tournament->search("Brasileirão Série A");

    echo '<pre>';
    var_dump($search);

```

#### Recuperar torneio pelo 'id'

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Tournament;

    $tournament = new Tournament();

    $campeonato = $tournament->get(7); // id torneio / id temporada

    $logo = $campeonato->getLogo(); // logo campeonato
    $name = $campeonato->getName(); // nome campeonato
    $slug = $campeonato->getSlug(); // slug campeonato
    $color = $campeonato->getColors(); // cor primaria e secondaria (object)->primary, (object)->secondary
    $current_champion = $campeonato->getCurrentChampion(); // Atual campeão
    $seasons = $campeonato->getSeasons(); // todas as temporadas
    $teams = $campeonato->getTeams(); // todos os clubes participantes. Caso não tenha resultado, retorna clubes da temprada anterior
    $all_data = $campeonato->tournament; // todos os dados do campenato


    echo "<img src='{$logo}' />";

```