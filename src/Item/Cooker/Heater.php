<?php

namespace MF\CookingAnEgg\Item\Cooker;

use MF\CookingAnEgg\HeatableInterface;

class Heater
{
    /** @var HeatableInterface */
    private $heatable;

    /** @var bool */
    private $isTurnedOn = false;

    public function put(HeatableInterface $heatable): void
    {
        $this->heatable = $heatable;
    }

    public function getHeatable(): HeatableInterface
    {
        return $this->heatable;
    }

    public function turnOn()
    {
        $this->isTurnedOn = true;
    }

    public function turnOff()
    {
        $this->isTurnedOn = false;
    }

    private function heat()
    {
        if (!empty($this->heatable) && $this->isTurnedOn) {
            $this->heatable->heatUp();
        }
    }
}
