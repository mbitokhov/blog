<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

abstract class BaseCommand extends Command
{
    public function createProgressBar($text, $amount = 0)
    {
        $bar = $this->output->createProgressBar($amount);
        $bar->setFormat('  %message:15s% %current%/%max% [%bar%] %percent:2s%%  %elapsed:6s% / %estimated:-6s% Remaining %remaining:6s%');
        $bar->setMessage($text);

        return $bar;
    }

}
