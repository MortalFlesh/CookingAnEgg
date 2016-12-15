<?php

namespace MF\CookingAnEgg\Container;

use MF\CookingAnEgg\Item\ItemInterface;

class Shelf implements ContainerInterface
{
    /**
     * Expects just one item of the specific type
     *
     * @var ItemInterface[]
     */
    private $items;

    /**
     * @param ItemInterface[] $items
     */
    public function __construct(ItemInterface ...$items)
    {
        $this->items = $items;
    }

    public function get(string $itemType): ItemInterface
    {
        foreach ($this->items as $index => $item) {
            if ($item instanceof $itemType) {
                unset($this->items[$index]);

                return $item;
            }
        }

        return null;
    }

    public function put(string $itemType, ItemInterface $item): void
    {
        $this->items[$itemType] = $item;
    }
}
