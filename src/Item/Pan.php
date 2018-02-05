<?php

namespace MF\CookingAnEgg\Item;

use MF\CookingAnEgg\Food\Food;
use MF\CookingAnEgg\Food\FoodInterface;
use MF\CookingAnEgg\HeatableInterface;

class Pan implements HeatableInterface, ItemInterface
{
    /** @var FoodInterface[] */
    private $content = [];

    public function put(FoodInterface $oil): void
    {
        $this->content[] = $oil;
    }

    public function heatUp()
    {
        $this->content = array_map(function (FoodInterface $food) {
            // todo: heats up food -> food should implement HeatableInterface
            // $food->heatUp();

            return $food;
        }, $this->content);
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
