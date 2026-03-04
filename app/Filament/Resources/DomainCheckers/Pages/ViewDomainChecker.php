<?php

namespace App\Filament\Resources\DomainCheckers\Pages;

use App\Filament\Resources\DomainCheckers\DomainCheckerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDomainChecker extends ViewRecord
{
    protected static string $resource = DomainCheckerResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
