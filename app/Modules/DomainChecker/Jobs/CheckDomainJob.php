<?php

namespace App\Modules\DomainChecker\Jobs;

use App\Modules\DomainChecker\Models\Domain;
use App\Modules\DomainChecker\Models\DomainCheck;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDomainJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Domain $domain) {}

    public function handle(): void
    {
        $start = microtime(true);
        try {
            $response = Http::send($this->domain->method, $this->domain->url);
            $responseTime = (microtime(true) - $start) * 1000;
            DomainCheck::create([
                'domain_id' => $this->domain->id,
                'http_code' => $response->status(),
                'response_time' => (int) $responseTime,
            ]);
        } catch (\Exception $e) {
            DomainCheck::create([
                'domain_id' => $this->domain->id,
                'error_message' => $e->getMessage(),
            ]);
        }
    }
}
