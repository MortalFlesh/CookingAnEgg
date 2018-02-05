<?php

namespace MF\CookingAnEgg\Item;

use MF\CookingAnEgg\Food\Food;
use MF\CookingAnEgg\Food\FoodInterface;

class Cup implements ItemInterface
{
    /** @var FoodInterface[] */
    private $content = [];

    public function put(FoodInterface $food): void
    {
        $this->content[] = $food;
    }

    public function getContent(): Food
    {
        $food = new Food();

        foreach ($this->content as $part) {
            $food->mixWith($part);
        }

        return $food;
    }
}
