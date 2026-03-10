<?php

namespace App\Filament\Admin\Resources\Properties;

use App\Models\Property;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Admin\Resources\Properties\Schemas\PropertyForm; // Ton schéma séparé
use App\Filament\Admin\Resources\Properties\Pages;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return PropertyForm::configure($schema);
    }
    
    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('gallery')
                ->label('Aperçu')
                ->collection('properties_gallery')
                ->circular()
                ->stacked(),

            Tables\Columns\TextColumn::make('title')
                ->label('Désignation')
                ->searchable()
                ->sortable()
                ->description(fn ($record) => "Localisation : {$record->city}, {$record->district}"),

            Tables\Columns\TextColumn::make('surface_m2')
                ->label('Surface')
                ->suffix(' m²')
                ->sortable(),

            Tables\Columns\TextColumn::make('rooms')
                ->label('Pièces')
                ->badge(),

            Tables\Columns\TextColumn::make('price')
                ->label('Prix')
                ->money('XOF')
                ->color('success')
                ->weight('bold'),

            Tables\Columns\TextColumn::make('status')
                ->label('Statut')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'available' => 'success',
                    'sold' => 'danger',
                    'reserved' => 'warning',
                    default => 'gray',
                }),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'available' => 'Disponible',
                    'sold' => 'Vendu',
                    'reserved' => 'Réservé',
                ]),
        ])
        ->actions([
            // Bouton Voir (Oeil bleu)
            ViewAction::make()
                ->iconButton()
                ->color('info')
                ->tooltip('Voir les détails complets'),

            // Bouton Modifier (Crayon ambre)
            EditAction::make()
               ->iconButton()
               ->color('warning')
               ->tooltip('Modifier cette propriété'),

            // Bouton Supprimer (Poubelle rouge + Confirmation)
            DeleteAction::make()
               ->iconButton()
               ->color('danger')
               ->tooltip('Supprimer définitivement')
               ->modalHeading('Suppression irrémédiable')
               ->modalDescription('Attention : cette action supprimera la propriété ainsi que toute la galerie photo 4K associée. Confirmez-vous ?')
               ->modalSubmitActionLabel('Oui, supprimer tout'),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([
               BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}