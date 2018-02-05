<?php

namespace MF\CookingAnEgg\Container;

use MF\CookingAnEgg\Item\ItemInterface;

class Fridge implements ContainerInterface
{
    /**
     * Expects just one item of the specific type
     *
     * @var array|ItemInterface[]
     */
    private $content = [];

    public function __construct(ItemInterface ...$items)
    {
        $this->content = $items;
    }

    public function get(string $itemType): ItemInterface
    {
        foreach ($this->content as $index => $item) {
            if ($item instanceof $itemType) {
                unset($this->content[$index]);

                return $item;
            }
        }

        return null;
    }

    public function put(string $itemType, ItemInterface $item): void
    {
        $this->content[$itemType] = $item;
    }
}
