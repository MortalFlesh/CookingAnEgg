<?php

namespace MF\CookingAnEgg;

use MF\CookingAnEgg\Container\EggPack;
use MF\CookingAnEgg\Container\Fridge;
use MF\CookingAnEgg\Container\Shelf;
use MF\CookingAnEgg\Food\Oil;
use MF\CookingAnEgg\Food\Spice\Salt;
use MF\CookingAnEgg\Item\Cooker\Cooker;
use MF\CookingAnEgg\Item\Cup;
use MF\CookingAnEgg\Item\Pan;

class Home
{
    /** @var Fridge */
    private $fridge;

    /** @var Shelf */
    private $shelf;

    /** @var Cooker */
    private $cooker;

    /**
     * @param Fridge $fridge
     * @param Shelf $shelf
     * @param Cooker $cooker
     */
    public function __construct(Fridge $fridge, Shelf $shelf, Cooker $cooker)
    {
        $this->fridge = $fridge;
        $this->shelf = $shelf;
        $this->cooker = $cooker;
    }

    public function sometimeGirlCooksEggs(): void
    {
        $girl = new Girl('name');

        $cookedEggs = $girl->cook(function (): Enjoyable {
            /** @var EggPack $eggPack */
            $eggPack = $this->fridge->get(EggPack::class);
            $eggs = $eggPack->getEggs(2);

            /** @var Cup $cup */
            $cup = $this->shelf->get(Cup::class);
            foreach ($eggs as $egg) {
                $cup->put($egg);
            }

            /** @var Salt $salt */
            $salt = $this->shelf->get(Salt::class);
            $cup->put($salt);

            /** @var Oil $oil */
            $oil = $this->shelf->get(Oil::class);

            /** @var Pan $pan */
            $pan = $this->shelf->get(Pan::class);
            $pan->put($oil);

            $this->cooker->putOnHeater(1, $pan);
            $this->cooker->turnOnHeater(1);

            $pan->put($cup->getContent());

            sleep(5 * 60 * 60);

            $this->cooker->turnOffHeater(1);
            $pan = $this->cooker->getFromHeater(1);

            return $pan->getContent();
        });

        $girl->enjoy($cookedEggs);
    }
}
