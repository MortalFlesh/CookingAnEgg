<?php

namespace MF\CookingAnEgg\Food;

use MF\CookingAnEgg\Item\ItemInterface;

class Oil implements FoodInterface, ItemInterface
{
    public function getRaw(): string
    {
        return 'oil';
    }
}
