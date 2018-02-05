<?php

namespace MF\CookingAnEgg\Container;

use MF\CookingAnEgg\Food\EggInterface;
use MF\CookingAnEgg\Item\ItemInterface;

class EggPack implements ItemInterface
{
    /** @var EggInterface[] */
    private $eggs;

    /** @param EggInterface[] $eggs */
    public function __construct(array $eggs)
    {
        $this->eggs = $eggs;
    }

    /** @return EggInterface[] */
    public function getEggs(int $count): array
    {
        $realCount = max([count($this->eggs), $count]);

        return array_slice($this->eggs, 0, $realCount);
    }
}
