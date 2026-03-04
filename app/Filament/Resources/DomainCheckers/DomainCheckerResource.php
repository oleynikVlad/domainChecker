<?php

namespace App\Filament\Resources\DomainCheckers;

use App\Filament\Resources\DomainCheckers\Pages\CreateDomainChecker;
use App\Filament\Resources\DomainCheckers\Pages\EditDomainChecker;
use App\Filament\Resources\DomainCheckers\Pages\ListDomainCheckers;
use App\Filament\Resources\DomainCheckers\Pages\ViewDomainChecker;
use App\Filament\Resources\DomainCheckers\Schemas\DomainCheckerForm;
use App\Filament\Resources\DomainCheckers\Schemas\DomainCheckerInfolist;
use App\Filament\Resources\DomainCheckers\Tables\DomainCheckersTable;
use App\Modules\DomainChecker\Models\DomainCheck;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DomainCheckerResource extends Resource
{
    protected static ?string $model = DomainCheck::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'checker';

    public static function form(Schema $schema): Schema
    {
        return DomainCheckerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DomainCheckerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DomainCheckersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDomainCheckers::route('/'),
            'view' => ViewDomainChecker::route('/{record}'),
        ];
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
       return false;
    }
    public static function canCreate(): bool
    {
        return false;
    }
}
