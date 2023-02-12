<?php

use App\Console\Command\FetchCommand;
use Takemo101\Egg\Console\Command\VersionCommand;
use Takemo101\Egg\Console\Commands;

return function (Commands $commands) {
    $commands->add(
        VersionCommand::class,
        FetchCommand::class,
    );
};
