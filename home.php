<?php

use MF\CookingAnEgg\Container\{
    EggPack, Fridge, Shelf
};
use MF\CookingAnEgg\Food\{
    Egg, Oil, Spice\Salt
};
use MF\CookingAnEgg\Home;
use MF\CookingAnEgg\Item\{
    Cooker\Cooker, Cup, Pan
};

require_once __DIR__ . '/vendor/autoload.php';

$fridge = new Fridge(
    new EggPack([
        new Egg(),
        new Egg(),
        new Egg(),
        new Egg(),
    ])
);
$shelf = new Shelf(
    new Cup(),
    new Pan(),
    new Salt(),
    new Oil()
);

$cooker = new Cooker(4);

$home = new Home($fridge, $shelf, $cooker);
$home->sometimeGirlCooksEggs();
