<?php

namespace MF\CookingAnEgg\Food;

use MF\CookingAnEgg\Enjoyable;

class Food implements FoodInterface, Enjoyable
{
    /** @var string */
    private $mixed;

    public function mixWith(FoodInterface $food): void
    {
        $this->mixed .= '+' . $food->getRaw();
    }

    public function enjoy()
    {
    }

    public function getRaw(): string
    {
        return $this->mixed;
    }
}
