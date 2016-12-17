<?php

namespace MF\CookingAnEgg;

use MF\CookingAnEgg\Food\Cake;
use MF\CookingAnEgg\Food\FoodInterface;
use MF\CookingAnEgg\Item\Present;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

class Girl
{
    /** @var string */
    private $name;

    /** @var int */
    private $age;

    /** @var SymfonyStyle */
    private $voice;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->age = 0;
        $this->voice = new SymfonyStyle(new ArgvInput(), new ConsoleOutput());
    }

    public function speak(string $somethingReallyImportant): void
    {
        $this->voice->text(sprintf('%s says: "%s"', $this->getName('Im speaking'), $somethingReallyImportant));
        sleep(1);
    }

    public function wait(int $seconds): void
    {
        $this->voice->progressStart($seconds);
        for ($i = 0; $i < $seconds; $i++) {
            sleep(1);
            $this->voice->progressAdvance();
        }
        $this->voice->progressFinish();
    }

    /**
     * @param string|Money $reallyGoodReason
     * @return string
     */
    public function getName($reallyGoodReason): string
    {
        return $reallyGoodReason ? $this->name : 'Fuck off!';
    }

    /**
     * Age is private getter - you simply don't ask a girl for age
     *
     * @return int
     */
    private function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param Present[] $presents
     * @param Cake $cake
     */
    public function birthday(array $presents, Cake $cake): void
    {
        foreach ($presents as $present) {
            $this->enjoy($present);
        }
        $this->enjoy($cake);

        $this->age++;
    }

    public function enjoy(Enjoyable $somethingGood): void
    {
        $somethingGood->enjoy();

        if ($somethingGood instanceof FoodInterface) {
            $this->speak('Yummy');
        }
    }

    /**
     * @param callable :Enjoyable $cookingProcess
     * @return Enjoyable
     */
    public function cook(callable $cookingProcess)
    {
        return $cookingProcess();
    }
}
