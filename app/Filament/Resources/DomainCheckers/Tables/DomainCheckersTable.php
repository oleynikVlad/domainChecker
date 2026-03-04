<?php

namespace App\Filament\Resources\DomainCheckers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DomainCheckersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('domain.title')->label('Domain name'),
                TextColumn::make('http_code')->label('HTTP status code'),
                TextColumn::make('response_time')->label('Response time (ms)'),
                TextColumn::make('created_at')->label('Check date')->dateTime('Y-m-d h:m')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
