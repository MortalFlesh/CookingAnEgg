<?php

namespace MF\CookingAnEgg\Food;

use MF\CookingAnEgg\Enjoyable;

class Food implements FoodInterface, Enjoyable
{
    /** @var FoodInterface */
    private $food;

    public function addFood(FoodInterface $food): void
    {
        $this->food += $food;
    }

    public function enjoy()
    {
    }
}
