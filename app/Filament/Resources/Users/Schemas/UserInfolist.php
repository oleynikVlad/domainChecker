<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email'),
                TextEntry::make('created_at')
                    ->dateTime('Y-m-d h:m')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime('Y-m-d h:m')
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime('Y-m-d h:m')
                    ->visible(fn (User $record): bool => $record->trashed()),
            ]);
    }
}
