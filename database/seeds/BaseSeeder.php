<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    public function createProgressBar($text, $amount = 0)
    {
        $bar = $this->command->getOutput()->createProgressBar($amount);
        $bar->setFormat('  %message:15s% %current%/%max% [%bar%] %percent:2s%%  %elapsed:6s% / %estimated:-6s% Remaining %remaining:6s%');
        $bar->setMessage($text);

        return $bar;
    }
}
