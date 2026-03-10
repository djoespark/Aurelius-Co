<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(): View
    {
        // On récupère les propriétés disponibles, triées par les plus récentes
        $properties = Property::where('status', 'available')
            ->latest()
            ->get();
            
        return view('welcome', compact('properties'));
    }

    public function show($id)
    {
    // Pour l'instant on simule une villa, plus tard on fera Property::findOrFail($id)
    $property = (object) [
        'title' => 'Villa Horizon',
        'price' => 150000000,
        'location' => 'Lomé, Togo'
    ];

    return view('properties.show', compact('property'));
    }
}