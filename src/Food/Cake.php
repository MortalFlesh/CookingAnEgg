<?php

namespace MF\CookingAnEgg\Food;

class Cake implements CandyInterface
{
    public function enjoy()
    {
    }

    public function getRaw(): string
    {
        return 'cake';
    }
}
