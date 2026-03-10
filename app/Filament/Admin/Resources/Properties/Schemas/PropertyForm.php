<?php

namespace App\Filament\Admin\Resources\Properties\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            
            TextInput::make('title')
                ->label('Désignation')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
            
            TextInput::make('slug')
                ->label('URL (Slug)')
                ->required()
                ->unique('properties', 'slug', ignoreRecord: true)
                ->readOnly(),

            RichEditor::make('description_poetic')
                ->label('Description de prestige')
                ->required(),

            TextInput::make('price')
                ->label('Prix')
                ->required()
                ->numeric()
                ->prefix('FCFA'),

            TextInput::make('surface_m2')
                ->label('Surface (m²)')
                ->required()
                ->numeric(),

            TextInput::make('rooms')
                ->label('Nombre de pièces')
                ->required()
                ->numeric(),

            TextInput::make('city')
                ->label('Ville')
                ->required(),

            TextInput::make('district')
                ->label('Quartier'),

            Select::make('status')
                ->label('Statut du bien')
                ->options([
                    'available' => 'Disponible',
                    'sold' => 'Vendu',
                    'reserved' => 'Réservé'
                ])
                ->default('available')
                ->required(),

            Toggle::make('is_off_market')
                ->label('Vente confidentielle (Off-Market)'),

            TagsInput::make('amenities')
                ->label('Équipements (Piscine, Garage, etc.)')
                ->placeholder('Tapez et appuyez sur Entrée')
                ->separator(','),
            
            SpatieMediaLibraryFileUpload::make('gallery')
                ->label('Galerie Photos 4K')
                ->collection('properties_gallery')
                ->multiple()
                ->reorderable()
                ->imageEditor()
                ->disk('public')
                ->visibility('public'),
        ]);
    }
}