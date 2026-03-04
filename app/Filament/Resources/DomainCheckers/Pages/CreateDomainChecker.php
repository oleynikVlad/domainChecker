<?php

namespace App\Filament\Resources\DomainCheckers\Pages;

use App\Filament\Resources\DomainCheckers\DomainCheckerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDomainChecker extends CreateRecord
{
    protected static string $resource = DomainCheckerResource::class;
    protected function getHeaderActions(): array
    {
        return [];
    }
}
