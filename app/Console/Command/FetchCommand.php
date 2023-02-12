<?php

namespace App\Console\Command;

use App\Support\Path\AppPath;
use Symfony\Component\Console\Output\OutputInterface;
use Latte\Engine as Latte;
use Takemo101\Egg\Console\Command\EggCommand;
use Takemo101\Egg\Support\Filesystem\LocalSystem;

final class FetchCommand extends EggCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('fetch');
    }

    public function handle()
    {
        return self::SUCCESS;
    }
}
