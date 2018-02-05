<?php

namespace MF\CookingAnEgg\Food\Spice;

use MF\CookingAnEgg\Item\ItemInterface;

class Salt implements SpiceInterface, ItemInterface
{
    public function getRaw(): string
    {
        return 'salt';
    }
}
