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
        $girl = new Girl('Adin');
        $girl->speak("I'm hungry, I'm going to cook some eggs.");

        $cookedEggs = $girl->cook(function () use ($girl): Enjoyable {
            $girl->speak("I'm getting eggs from fridge.");

            /** @var EggPack $eggPack */
            $eggPack = $this->fridge->get(EggPack::class);
            $eggs = $eggPack->getEggs(2);

            $girl->speak(sprintf('I have %d eggs now.', count($eggs)));

            $girl->speak("I'm putting eggs to cup.");

            /** @var Cup $cup */
            $cup = $this->shelf->get(Cup::class);
            foreach ($eggs as $egg) {
                $cup->put($egg);
            }

            $girl->speak("I'm adding some salt to the cup.");
            /** @var Salt $salt */
            $salt = $this->shelf->get(Salt::class);
            $cup->put($salt);

            /** @var Oil $oil */
            $oil = $this->shelf->get(Oil::class);

            $girl->speak("I'm getting a pan.");
            /** @var Pan $pan */
            $pan = $this->shelf->get(Pan::class);

            $girl->speak("I'm adding oil to pan.");
            $pan->put($oil);

            $girl->speak("I'm putting a pan on the heater.");
            $this->cooker->putOnHeater(1, $pan);

            $girl->speak("I'm turning on the heater.");
            $this->cooker->turnOnHeater(1);

            $girl->speak("I'm adding cup content to the pan.");
            $pan->put($cup->getContent());

            $girl->speak("I'm waiting till it's done.");
            $girl->wait(5);

            $girl->speak("I'm turning off the heater.");
            $this->cooker->turnOffHeater(1);

            $girl->speak("I'm removing a pan from heater.");
            $pan = $this->cooker->getFromHeater(1);

            $girl->speak("I'm getting cooked eggs.");

            return $pan->getContent();
        });

        $girl->speak("I'm enjoying cooked eggs.");
        $girl->enjoy($cookedEggs);
    }
}
