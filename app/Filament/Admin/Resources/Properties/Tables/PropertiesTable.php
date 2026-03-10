<?php

namespace App\Filament\Admin\Resources\Properties\Tables;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn; // Import indispensable
use Filament\Tables\Table;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. L'image de la villa (Prestige)
                SpatieMediaLibraryImageColumn::make('gallery')
                    ->label('Aperçu')
                    ->collection('properties_gallery')
                    ->circular(),

                TextColumn::make('title')
                    ->label('Désignation')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->city), // Affiche la ville sous le titre

                // 2. Formatage prix FCFA
                TextColumn::make('price')
                    ->label('Prix')
                    ->money('XOF')
                    ->sortable()
                    ->color('success')
                    ->weight('bold'),

                // 3. Indicateur Off-Market stylisé
                IconColumn::make('is_off_market')
                    ->label('Confidentiel')
                    ->boolean()
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open')
                    ->color(fn ($state) => $state ? 'warning' : 'gray'),

                TextColumn::make('surface_m2')
                    ->label('Surf. (m²)')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('rooms')
                    ->label('Suites')
                    ->sortable(),

                // 4. Badges de statut
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'reserved' => 'warning',
                        'sold' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                // On pourra ajouter des filtres ici plus tard
            ])
            ->Actions([
                EditAction::make(),
            ])
            ->bulkActions([ // Correction : c'est bulkActions et non toolbarActions pour le BulkGroup
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}