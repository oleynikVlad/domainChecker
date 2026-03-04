<?php

namespace App\Filament\Widgets;

use App\Modules\DomainChecker\Models\Domain;
use App\Modules\DomainChecker\Models\DomainCheck;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Рахуємо дані за останні 24 години
        $last24Hours = now()->subDay();

        $totalChecks = DomainCheck::where('created_at', '>=', $last24Hours)->count();

        $successfulChecks = DomainCheck::where('created_at', '>=', $last24Hours)
            ->where('http_code', '<', 400)
            ->count();

        $failedChecks = DomainCheck::where('created_at', '>=', $last24Hours)
            ->where('http_code', '>=', 400)
            ->count();

        $avgTime = DomainCheck::where('created_at', '>=', $last24Hours)
            ->avg('response_time') ?? 0;

        $amountOfDomains = Domain::count();
        return [
            Stat::make('Checks (24h)', $totalChecks)
                ->description('Total number of requests')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),

            Stat::make('Successful', $successfulChecks)
                ->description('Available domains')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Failures', $failedChecks)
                ->description('Sites down or returning errors')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color($failedChecks > 0 ? 'danger' : 'gray'),

            Stat::make('Avg. Response Time', number_format($avgTime, 2) . ' ms')
                ->description('Server reaction speed')
                ->descriptionIcon('heroicon-m-bolt')
                ->color('warning'),

            Stat::make('Total Number of Domains', $amountOfDomains . ' domains')
                ->description('Amount of domains')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
