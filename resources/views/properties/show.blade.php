<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Propriété | Aurelius & Co</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-night text-silk selection:bg-gold selection:text-night antialiased overflow-x-hidden">

    <main class="min-h-screen p-20 flex flex-col items-center justify-center relative">
        <div class="max-w-4xl text-center space-y-8 z-10">
            <h1 class="font-serif text-7xl text-gold italic animate-fade-up">
                {{ $property->title ?? 'Villa Horizon' }}
            </h1>
            <p class="text-2xl tracking-[0.3em] font-light uppercase text-silk/60">
                {{ $property->location ?? 'Lomé, Togo' }}
            </p>
            <div class="h-[1px] w-40 bg-gold/30 mx-auto"></div>
            <p class="text-4xl font-serif text-gold">
                {{ number_format($property->price, 0, ',', ' ') }} XOF
            </p>
        </div>

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-gold/5 via-transparent to-transparent"></div>
    </main>

    <livewire:investment-calculator :price="$property->price"/>

    <livewire:concierge-bubble />

    @livewireScripts
</body>
</html>