<?php
use Livewire\Volt\Component;

new class extends Component {
    public function getWhatsappUrlProperty()
    {
        $text = urlencode("Bonjour Marc, je souhaite discuter de mon projet d'investissement sur Aurelius & Co.");
        return "https://wa.me/22897630690?text=$text"; 
    }
}; ?>

<div x-data="chatMarc()" 
     class="fixed bottom-8 left-8 z-[100] font-sans">
    
    <button x-show="!open" 
            @click="toggle()"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-90 translate-y-4"
            class="flex items-center gap-4 bg-night/95 backdrop-blur-xl border border-gold/30 p-2 pr-6 rounded-full shadow-[0_20px_50px_rgba(0,0,0,0.4)] group">
        <div class="w-12 h-12 rounded-full border border-gold/50 flex items-center justify-center bg-gold/10 overflow-hidden relative">
            <span class="text-gold font-serif text-xl italic">M</span>
            <div class="absolute bottom-0 right-2 w-2 h-2 bg-green-500 rounded-full border border-night animate-pulse"></div>
        </div>
        <span class="text-silk text-sm font-light tracking-wide uppercase group-hover:text-gold transition-colors">Parler avec Marc</span>
    </button>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-10"
         @click.away="open = false"
         class="w-80 bg-night border border-gold/20 rounded-2xl shadow-[0_30px_60px_rgba(0,0,0,0.6)] overflow-hidden">
        
        <div class="bg-gold/5 p-4 border-b border-gold/10 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full border border-gold/30 flex items-center justify-center bg-night">
                    <span class="text-gold font-serif text-xs">M</span>
                </div>
                <span class="text-gold font-serif italic">Marc d'Aurelius</span>
            </div>
            <button @click="open = false" class="text-silk/30 hover:text-gold">×</button>
        </div>

        <div class="h-64 p-4 overflow-y-auto space-y-4 bg-night/50" id="chat-container">
            <template x-for="msg in messages" :key="msg.id">
                <div :class="msg.from === 'marc' ? 'flex justify-start' : 'flex justify-end'">
                    <div :class="msg.from === 'marc' 
                        ? 'bg-gold/10 text-silk border border-gold/5' 
                        : 'bg-gold text-night'" 
                        class="max-w-[85%] p-3 rounded-xl text-xs leading-relaxed tracking-wide shadow-sm">
                        <span x-text="msg.text"></span>
                    </div>
                </div>
            </template>
        </div>

        <div class="p-4 bg-gold/5 border-t border-gold/10">
            <a href="{{ $this->whatsappUrl }}" target="_blank" 
               class="block w-full bg-gold text-night text-center py-3 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-silk transition-all shadow-lg">
                Continuer sur WhatsApp
            </a>
        </div>
    </div>
</div>

<script>
function chatMarc() {
    return {
        open: false,
        messages: [
            {id: 1, text: "Bienvenue. Je suis Marc, fondateur d'Aurelius & Co.", from: "marc"},
            {id: 2, text: "Je vous accompagne personnellement dans votre recherche de prestige à Lomé.", from: "marc"},
            {id: 3, text: "Souhaitez-vous une analyse privée de ce bien ?", from: "marc"}
        ],
        toggle() {
            this.open = !this.open;
            if(this.open) {
                setTimeout(() => {
                    const container = document.querySelector("#chat-container");
                    container.scrollTop = container.scrollHeight;
                }, 100);
            }
        }
    }
}
</script>