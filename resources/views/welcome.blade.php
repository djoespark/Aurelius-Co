<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aurelius & Co. | Immobilier d'Héritage</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-night antialiased overflow-x-hidden">

    <header class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-night/60 z-10"></div>
            <video autoplay muted loop playsinline preload="auto" 
                   poster="{{ asset('images/hero-poster.jpg') }}" 
                   class="w-full h-full object-cover opacity-40">
                <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="relative z-20 text-center px-6">
            <div class="animate-fade-up">
                <h1 class="font-serif text-gold text-6xl md:text-8xl lg:text-9xl mb-4 tracking-tighter text-shadow-gold">
                    Aurelius & Co.
                </h1>
                <div class="w-20 h-[1px] bg-gold/40 mx-auto mb-8"></div>
                <p class="font-sans text-silk text-xs md:text-sm uppercase tracking-[0.5em] font-light max-w-xl mx-auto leading-relaxed opacity-80">
                    L'immobilier n'est pas une transaction, <br>
                    <span class="italic font-serif text-2xl mt-4 block normal-case tracking-normal">c'est un héritage.</span>
                </p>
            </div>
        </div>

        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3 opacity-60">
            <span class="font-sans text-gold text-[9px] uppercase tracking-[0.3em]">Défiler</span>
            <div class="w-[1px] h-16 bg-gradient-to-b from-gold to-transparent"></div>
        </div>
    </header>

    <section class="py-32 px-6 max-w-4xl mx-auto text-center">
        <h2 class="font-serif text-gold text-3xl md:text-4xl mb-6">L'Exclusivité à l'état pur.</h2>
        <p class="font-sans text-silk/70 leading-loose font-light italic">
            Chaque pierre a une histoire, chaque vue est un privilège. Aurelius & Co. sélectionne pour vous les domaines les plus confidentiels de la côte et des capitales.
        </p>
    </section>

    <section class="bg-night py-24 px-6 border-t border-gold/10">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                
                @forelse($properties as $property)
                    <div class="group">
                        <div class="relative aspect-[3/4] overflow-hidden bg-zinc-900 rounded-sm shadow-2xl border border-white/5">
                            <img src="{{ $property->getFirstMediaUrl('properties_gallery') }}" 
                                 alt="{{ $property->title }}"
                                 class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110 opacity-80 group-hover:opacity-100">
                            
                            <div class="absolute bottom-0 left-0 w-full p-8 bg-gradient-to-t from-night to-transparent">
                                <p class="font-serif text-gold text-lg italic tracking-wide">
                                    {{ number_format($property->price, 0, ',', ' ') }} XOF
                                </p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <span class="font-sans text-gold/60 text-[10px] uppercase tracking-[0.4em]">{{ $property->city }}</span>
                            <h3 class="font-serif text-silk text-base md:text-lg mt-1 group-hover:text-gold transition-colors duration-500 line-clamp-1">
                                {{ $property->title }}
                            </h3>
                           <div class="mt-3 flex gap-4 text-silk/40 font-sans text-[9px] uppercase tracking-widest border-t border-gold/10 pt-3">
                                <span>
                                    <strong class="text-silk">{{ $property->rooms }}</strong> Chambres
                                </span>

                                <span>
                                    <strong class="text-silk">{{ $property->surface_m2 }}</strong> m²
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-silk/30 font-sans italic col-span-2 text-center">Nos domaines sont actuellement tous sous offre confidentielle.</p>
                @endforelse

            </div>
        </div>
    </section>

    <footer class="py-20 text-center border-t border-gold/5">
        <p class="font-serif text-gold/30 text-sm">© {{ date('Y') }} Aurelius & Co. Patrimoine</p>
    </footer>

    {{-- <x-finance-calculator :price="$properties->first()->price ?? 0" /> --}}

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Bulle de Marc Luxe -->
   {{-- <div x-data="chatMarc()" style="position:fixed; bottom:20px; right:20px; z-index:999;" class="font-sans"> </div> --}}

  <!-- Bulle fermée -->
  <div @click="toggle()" 
       style="
          background: var(--color-gold); 
          color: var(--color-night); 
          padding:12px 20px; 
          border-radius:50px; 
          cursor:pointer; 
          font-family: var(--font-serif);
          box-shadow: 0 4px 15px rgba(0,0,0,0.4);
          transition: transform 0.3s ease;
        "
       @mouseenter="hover = true" @mouseleave="hover = false"
       :style="hover ? 'transform: scale(1.05)' : ''">
    💬 Marc est là pour vous aider !
  </div>

  <!-- Chat ouvert -->
  <div x-show="open" x-transition
       style="
          margin-top:10px; 
          width:280px; 
          max-height:350px; 
          background: var(--color-silk); 
          color: var(--color-night); 
          border-radius:15px; 
          padding:12px; 
          overflow-y:auto; 
          box-shadow: 0 8px 30px rgba(0,0,0,0.5);
          font-family: var(--font-sans);
       ">
    
    <!-- Messages -->
    <div class="space-y-2">
      <template x-for="msg in messages" :key="msg.id">
        <div :style="msg.from==='marc' ? 'background:#f9f0d7;color:#0a0a0b;padding:6px 10px;border-radius:10px;align-self:flex-start;' 
                                     : 'background:#e0e0e0;color:#0a0a0b;padding:6px 10px;border-radius:10px;align-self:flex-end;'">
          <span x-text="msg.text"></span>
        </div>
      </template>
    </div>

    <!-- Champ d'envoi -->
    <div style="margin-top:10px; display:flex; gap:6px;">
      <input type="text" placeholder="Écrivez un message..." x-model="userInput" 
             @keydown.enter="sendMessage()"
             style="flex:1; padding:6px; border-radius:8px; border:1px solid var(--color-gold); outline:none;">
      <button @click="sendMessage()" 
              style="padding:6px 12px; border-radius:8px; background:var(--color-gold); color:var(--color-night); border:none; cursor:pointer;">
        Envoyer
      </button>
    </div>

  </div>
</div>

<!-- Alpine.js -->

<script>
function chatMarc() {
    return {
        open: false,
        hover: false,
        userInput: '',
        messages: [],
        initialMessages: [
            "Salut ! Je suis Marc 👋",
            "Vous cherchez un service rapide ?",
            "Je peux vous guider pas à pas !"
        ],
        toggle() {
            this.open = !this.open;
            if(this.open && this.messages.length === 0){
                this.showStory();
            }
        },
        showStory() {
            let i = 0;
            let interval = setInterval(() => {
                if(i >= this.initialMessages.length) {
                    clearInterval(interval);
                    return;
                }
                this.messages.push({id: Date.now()+i, text: this.initialMessages[i], from:'marc'});
                this.scrollToBottom();
                i++;
            }, 800); // messages toutes les 0.8s
        },
        sendMessage() {
            if(this.userInput.trim()==='') return;
            this.messages.push({id: Date.now(), text:this.userInput, from:'user'});
            this.userInput='';
            this.scrollToBottom();

            // Réponse automatique de Marc
            setTimeout(() => {
                this.messages.push({id: Date.now()+1, text:"Super ! Je note ça. 😉", from:'marc'});
                this.scrollToBottom();
            }, 1000);
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const container = document.querySelector("[x-data='chatMarc()'] div[style*='overflow-y:auto']");
                if(container) container.scrollTop = container.scrollHeight;
            });
        }
    }
}
</script>
</body>
</html>