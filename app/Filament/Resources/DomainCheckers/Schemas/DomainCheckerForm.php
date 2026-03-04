<?php

namespace App\Filament\Resources\DomainCheckers\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DomainCheckerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('domain_id')
                    ->relationship('domain', 'title')
                    ->disabled(),
                TextInput::make('http_code')
                    ->disabled()
                    ->placeholder('HTTP status code 200/400/500')
                    ->numeric(),
                TextInput::make('response_time')
                    ->disabled()
                    ->placeholder('Response time (in milliseconds)')
                    ->numeric(),
                TextInput::make('error_message')
                    ->placeholder('Error message')
                    ->disabled()
                    ->numeric()
            ]);
    }
}
