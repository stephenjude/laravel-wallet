<?php

namespace Stephenjude\Wallet\Commands;

use Illuminate\Console\Command;

class WalletCommand extends Command
{
    public $signature = 'wallet';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
