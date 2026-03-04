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
            $debugData = [
                'request' => [
                    'url'    => $this->domain->url,
                    'method' => $this->domain->method,

                ],
                'response' => [
                    'status'  => $response->status(),
                    'reason'  => $response->reason(),
                    'headers' => $response->headers(),
                ],
                'info' => $response->handlerStats(),
            ];

            DomainCheck::create([
                'domain_id' => $this->domain->id,
                'http_code' => $response->getStatusCode(),
                'result' => $debugData,
                'response_time' => (int) $responseTime,
                'body'  => $response->json() ?? $response->body(),
            ]);
        } catch (\Exception $e) {
            DomainCheck::create([
                'domain_id' => $this->domain->id,
                'error_message' => $e->getMessage(),
                'http_code' => $e->getCode(),
            ]);
        }
    }
}
