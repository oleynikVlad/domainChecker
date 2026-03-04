<?php

namespace App\Filament\Resources\DomainCheckers\Pages;

use App\Filament\Resources\DomainCheckers\DomainCheckerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDomainChecker extends EditRecord
{
    protected static string $resource = DomainCheckerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
