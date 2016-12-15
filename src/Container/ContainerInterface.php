<?php

namespace MF\CookingAnEgg\Container;

use MF\CookingAnEgg\Item\ItemInterface;

interface ContainerInterface
{
    public function get(string $itemType): ItemInterface;

    public function put(string $itemType, ItemInterface $item): void;
}
