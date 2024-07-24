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

#### Procurar campeonato por nome

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Tournament;

    $tournament = new Tournament();

    $search = $tournament->search("Brasileirão Série A");

    echo '<pre>';
    var_dump($search);

```

#### Recuperar campeonato pelo 'id'

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Tournament;

    $tournament = new Tournament();

    $campeonato = $tournament->get(7); // id campeonato / id temporada

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

#### Recuperar time pelo 'id'
É possível usar cada função ser usar o get antes. Basta passar o id do clube como parametro nas funções.

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Team;

    $team = new Team();

    $clube = $team->get(1957); // id clube

    $id       = $clube->getId();
    $logo     = $clube->getLogo(); // $team->getLogo(1957, 'small');
    $name     = $clube->getName(); // $team->getName(1957);
    $nameCode = $clube->getNameCode();
    $fullName = $clube->getFullName();
    $colors   = $clube->getColors();
    $manager  = $clube->getManager();
    $locale   = $clube->getLocale();
    $stadium  = $clube->getStadium();
    $country  = $clube->getCountry();
    $nextGame = $team->nextEvent();
    $lastGame = $team->lastEvent();
    $allNextGames = $team->getNextEvents();
    $allLastGames = $team->getLastEvents();
 
    echo $name;
   
```

#### Recuperar evento/jogo pelo 'id'
É possível usar cada função ser usar o get antes. Basta passar o id do evento como parametro nas funções.

```php
<?php 

    require_once 'vendor/autoload.php';

    use Lance\Sofascore\Events;

    $events = new Events();

    $event = $events->get(12117159); // id evento 'jogo'

    $id       = $event->getId();
    $homeTeam = $event->getHomeTeam(); // time da casa
    $awayTeam = $event->getAwayTeam(); // time visitante
    $tournament = $event->getTournament(); // campeonato 
    $referee = $event->getReferee(); // arbitro da partida 
    $locale = $event->getLocale(); // local da partida
    $stadium = $event->getStadium(); // stadio
    $status = $event->getStatus();  // status da partida
    $startDate = $event->getStartDate(); // data de inicio da partida
    $homeScore = $event->homeScore(); // gols time da casa
    $awayScore = $event->awayScore(); // gols time visitante

    echo '<pre>';
    var_dump($event->getStartDate());
   
```