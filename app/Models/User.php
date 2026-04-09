<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cette méthode autorise l'accès au panel Filament.
     * En retournant 'true', tu débloques l'erreur 403.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Pour le moment, on autorise tout utilisateur enregistré
        // Tu pourras restreindre à ton email plus tard pour la sécurité
        return true;
    }
}