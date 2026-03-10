@props(['price' => 0])

<div 
x-data="{ 
    open: false, 
    contribution: 20,
    price: {{ $price ?? 0 }},
    get notaryFees() { return Math.round(this.price * 0.08) },
    get contributionAmount() { return Math.round((this.price * this.contribution) / 100) },
    get loanAmount() { return Math.round((this.price + this.notaryFees) - this.contributionAmount) }
}"
x-effect="document.body.classList.toggle('overflow-hidden', open)"
class="relative">

    <!-- Bouton -->
    <button 
        @click="open = true"
        type="button"
        class="fixed right-0 top-1/2 -rotate-90 translate-x-12 z-50 bg-gold text-night px-10 py-5 uppercase tracking-[0.5em] text-[10px] font-bold shadow-2xl border-l border-white/10 hover:bg-silk transition-all duration-700">
        Structure Financière
    </button>

    <!-- Drawer -->
    <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex justify-end">

        <!-- Overlay -->
        <div 
            x-show="open"
            x-transition.opacity.duration.700ms
            @click="open = false"
            class="absolute inset-0 bg-night/80 backdrop-blur-md">
        </div>

        <!-- Panel -->
        <div 
            x-show="open"
            x-transition:enter="transition transform duration-700"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition transform duration-500"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="relative w-full max-w-[520px] bg-night border-l border-gold/10 p-16 flex flex-col justify-between shadow-[-50px_0_100px_rgba(0,0,0,0.8)]">

            <div class="space-y-20">

                <!-- Titre -->
                <div class="flex justify-between items-center">
                    <h2 class="font-serif text-gold text-4xl italic tracking-tight">
                        Simulation
                    </h2>

                    <button 
                        @click="open = false"
                        class="text-gold/40 hover:text-gold transition-colors">
                        ✕
                    </button>
                </div>

                <!-- Slider -->
                <div class="space-y-16">

                    <div class="space-y-8">

                        <div class="flex justify-between items-end">
                            <span class="text-silk/30 text-[10px] uppercase tracking-[0.3em]">
                                Apport Personnel
                            </span>

                            <span 
                                class="text-gold font-serif text-4xl"
                                x-text="contribution + '%'">
                            </span>
                        </div>

                        <input 
                            type="range"
                            x-model="contribution"
                            min="10"
                            max="60"
                            step="5"
                            class="w-full h-[2px] bg-gold/20 appearance-none accent-gold cursor-pointer">
                    </div>

                    <!-- Calculs -->
                    <div class="space-y-6 pt-10 border-t border-gold/5 text-silk">

                        <div class="flex justify-between text-[11px] uppercase tracking-tighter">
                            <span class="text-silk/40 italic font-serif normal-case">
                                Prix du bien
                            </span>

                            <span x-text="new Intl.NumberFormat('fr-FR').format(price) + ' XOF'"></span>
                        </div>

                        <div class="flex justify-between text-[11px] uppercase tracking-tighter">
                            <span class="text-silk/40 italic font-serif normal-case">
                                Frais d'acquisition (8%)
                            </span>

                            <span x-text="new Intl.NumberFormat('fr-FR').format(notaryFees) + ' XOF'"></span>
                        </div>

                        <div class="flex justify-between text-[11px] uppercase tracking-tighter">
                            <span class="text-silk/40 italic font-serif normal-case">
                                Apport en capital
                            </span>

                            <span x-text="new Intl.NumberFormat('fr-FR').format(contributionAmount) + ' XOF'"></span>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Résultat -->
            <div class="bg-gold/5 p-8 border border-gold/10 mt-auto">
                <p class="text-gold/40 text-[9px] uppercase tracking-[0.5em] mb-4 font-bold">Besoin de Financement</p>
    
            <div class="flex items-baseline gap-2 flex-wrap">
               <p class="text-gold text-4xl md:text-5xl font-serif italic leading-none" 
                  x-text="new Intl.NumberFormat('fr-FR').format(loanAmount)">
               </p>
               <p class="text-gold/60 text-[10px] uppercase tracking-widest">XOF</p>
            </div>
    
               <p class="text-[8px] text-silk/20 uppercase mt-4 tracking-widest italic">
                   * Estimation incluant prix du bien et frais d'acquisition
                </p>
            </div>

        </div>

    </div>

</div>