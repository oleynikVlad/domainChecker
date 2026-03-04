<?php

namespace App\Filament\Resources\DomainCheckers\Pages;

use App\Filament\Resources\DomainCheckers\DomainCheckerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDomainCheckers extends ListRecords
{
    protected static string $resource = DomainCheckerResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
