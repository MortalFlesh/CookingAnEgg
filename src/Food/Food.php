<?php

namespace MF\CookingAnEgg\Food;

class Food implements FoodInterface
{
    /** @var FoodInterface */
    private $food;

    public function addFood(FoodInterface $food): void
    {
        $this->food += $food;
    }
}
