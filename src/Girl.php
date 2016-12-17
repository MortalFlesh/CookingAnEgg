<?php

namespace MF\CookingAnEgg;

use MF\CookingAnEgg\Food\Cake;
use MF\CookingAnEgg\Item\Present;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterStyleStack;
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
        $this->voice = new SymfonyStyle(new ArgvInput(), new ConsoleOutput());
    }

    public function speak(string $somethingReallyImportant): void
    {
        $this->voice->text(sprintf('%s says: "%s"', $this->getName('Im speaking'), $somethingReallyImportant));
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
