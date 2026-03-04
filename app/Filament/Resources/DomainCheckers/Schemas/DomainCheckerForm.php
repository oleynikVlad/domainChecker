<?php

namespace App\Filament\Resources\DomainCheckers\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Novadaemon\FilamentPrettyJson\Form\PrettyJsonField;

class DomainCheckerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Info')
                    ->schema([
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
                        Textarea::make('error_message')
                            ->rows(3)
                            ->placeholder('Error message')
                            ->disabled(),
                        Textarea::make('body')
                            ->rows(15)
                    ]),
                Section::make('Debugging')
                    ->schema([
                        PrettyJsonField::make('result')
                    ])
            ]);
    }
}
