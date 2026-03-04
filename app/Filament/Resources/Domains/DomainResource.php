<?php

namespace App\Filament\Resources\Domains;

use App\Filament\Resources\Domains\Pages\CreateDomain;
use App\Filament\Resources\Domains\Pages\EditDomain;
use App\Filament\Resources\Domains\Pages\ListDomains;
use App\Filament\Resources\Domains\Schemas\DomainForm;
use App\Filament\Resources\Domains\Tables\DomainsTable;
use App\Modules\DomainChecker\Models\Domain;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DomainResource extends Resource
{
    protected static ?string $model = Domain::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'domain';

    public static function form(Schema $schema): Schema
    {
        return DomainForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DomainsTable::configure($table);
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
            'index' => ListDomains::route('/'),
            'create' => CreateDomain::route('/create'),
            'edit' => EditDomain::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (!Auth::user()->is_super_admin) {
            $query->where('user_id', Auth::id());
        }

        return $query;
    }
    public static function canView($record): bool
    {
        if (auth()->user()?->is_super_admin) {
            return true;
        }

        return $record->user_id === auth()->id();
    }

    public static function canEdit($record): bool
    {
        if (auth()->user()?->is_super_admin) {
            return true;
        }

        return $record->user_id === auth()->id();
    }

    public static function canDelete($record): bool
    {
        if (auth()->user()?->is_super_admin) {
            return true;
        }

        return $record->user_id === auth()->id();
    }
}
