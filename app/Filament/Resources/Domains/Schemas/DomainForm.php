<?php

namespace App\Filament\Resources\Domains\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;

class DomainForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('url')
                    ->required()
                    ->placeholder("https://example.com")
                    ->url(),
                TextInput::make('title')
                    ->required()
                    ->placeholder("Name of the domain"),
                Select::make('method')
                    ->options([
                        'GET' => 'GET',
                        'HEAD' => 'HEAD',
                    ])
                    ->required(),
            ]);
    }
}
