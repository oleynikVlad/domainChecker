<?php

namespace App\Modules\DomainChecker\Commands;

use App\Modules\DomainChecker\Jobs\CheckDomainJob;
use App\Modules\DomainChecker\Models\Domain;
use Illuminate\Console\Command;

class CheckDomainsCommand extends Command
{
    protected $signature = 'domains:check';
    protected $description = 'Check all domains by schedule';

    public function handle(): void
    {
        Domain::chunk(50, function ($domains) {
            foreach ($domains as $domain) {
                CheckDomainJob::dispatch($domain);
            }
        });
    }
}
