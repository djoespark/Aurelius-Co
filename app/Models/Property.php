<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;            // Import indispensable
use Spatie\MediaLibrary\InteractsWithMedia; // Import indispensable
use Spatie\Image\Enums\Fit;                 // Pour le redimensionnement
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use InteractsWithMedia; // Permet au modèle d'utiliser les médias

    protected $fillable = [
        'title', 
        'slug', 
        'description_poetic', 
        'price', 
        'currency', 
        'is_off_market', 
        'city', 
        'district', 
        'surface_m2', 
        'rooms', 
        'status', 
        'amenities'
    ];

    protected $casts = [
        'amenities' => 'array',
        'is_off_market' => 'boolean',
        'surface_m2' => 'decimal:2',
    ];

    /**
     * Configuration de l'optimisation des images (Etape 5)
     * Spatie va générer ces versions automatiquement à l'upload.
     */
    public function registerMediaConversions(Media $media = null): void
    {
        // Version miniature pour l'admin
        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();

        // Version HD optimisée pour le site Web (Format WebP)
        $this->addMediaConversion('optimized')
            ->format('webp')
            ->quality(80)
            ->withResponsiveImages()
            ->nonQueued();
    }

    /**
     * Accessor pour afficher le prix en FCFA proprement.
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->price, 0, ',', ' ') . ' FCFA',
        );
    }
}