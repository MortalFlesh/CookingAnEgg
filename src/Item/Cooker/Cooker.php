<?php

namespace MF\CookingAnEgg\Item\Cooker;

use MF\CookingAnEgg\HeatableInterface;

class Cooker
{
    /** @var Heater[] */
    private $heaters;

    public function __construct(int $numberOfPlaces)
    {
        for ($i = 0; $i < $numberOfPlaces; $i++) {
            $this->heaters[$i] = new Heater();
        }
    }

    public function putOnHeater(int $position, HeatableInterface $item): void
    {
        $this->heaters[$position]->put($item);
    }

    public function getFromHeater(int $position): HeatableInterface
    {
        $this->heaters[$position]->getHeatable();
    }

    public function turnOnHeater(int $position): void
    {
        $this->heaters[$position]->turnOn();
    }

    public function turnOffHeater(int $position): void
    {
        $this->heaters[$position]->turnOff();
    }
}
