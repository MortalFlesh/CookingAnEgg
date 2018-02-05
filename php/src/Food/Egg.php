<?php

namespace MF\CookingAnEgg\Food;

class Egg implements EggInterface
{
    public function getRaw(): string
    {
        return 'egg';
    }
}
